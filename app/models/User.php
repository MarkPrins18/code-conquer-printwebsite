<?php

class User
{
    private $company_name;
    private $email;
    private $password;
    private $confirmPwd;

    public $role_id;
    public $created_at;
    public $updated_at;

    public function __construct($company_name, $email, $password, $confirmPwd)
    {
        $this->company_name = $company_name;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPwd = $confirmPwd;
        $this->role_id = 2;
    }

    
    public function signupUser(): array
    {
        $errors = $this->validateRegister();

        if (!empty($errors)) {
            return $errors;
        }

        $this->create();
        return [];
    }


    public function validateRegister(): array
    {
        $errors = [];

        // 1. Required fields empty?
        if (empty($this->company_name) || empty($this->email) ||
            empty($this->password)     || empty($this->confirmPwd)) {
            $errors['empty'] = 'err_required';
        }

        // 2. E-mail format
        if ($this->email !== '' && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'err_email';
        }

        // 3. Password strength: min. 8 characters, 1 uppercase letter, 1 number
        if ($this->password !== '' &&
            !preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $this->password)) {
            $errors['password'] = 'err_password';
        }

        // 4. Password confirmation
        if ($this->password !== '' && $this->confirmPwd !== '' &&
            $this->password !== $this->confirmPwd) {
            $errors['confirm'] = 'err_confirm';
        }

        return $errors;
    }

    // createUser is currently a placeholder method, but should be the method that passes user data to the database
    public function create(): void
{
        $hashedPwd = password_hash($this->password, PASSWORD_DEFAULT);

        $pdo = Database::getConnection();

        // First, look up the kvk number via the company name
        $stmt = $pdo->prepare('
            SELECT kvk FROM companies WHERE name = :name LIMIT 1
        ');
        $stmt->execute(['name' => $this->company_name]);
        $kvk = $stmt->fetchColumn();

        if (!$kvk) {
            throw new Exception('Bedrijfsnaam niet gevonden in de database.');
        }

        $stmt = $pdo->prepare('
            INSERT INTO users (kvk, role_code, email, password_hash)
            VALUES (:kvk, :role_code, :email, :password_hash)
        ');

        $stmt->execute([
            'kvk'           => $kvk,
            'role_code'     => 'USER',
            'email'         => $this->email,
            'password_hash' => $hashedPwd,
         ]);
    }



    public function validateLogin(string $email, string $password): array
    {
        $errors = [];

        if ($email === '' || $password === '') {
            $errors['empty'] = 'err_required';
        }

        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'err_email';
        }

        return $errors;
    }


    public function loginUser(string $email, string $password): ?array
    {
        $user = $this->findByEmail($email);

        if (!$user) {
            return null;
        }

        if (!password_verify($password, $user['password_hash'])) {
            return null;
        }

        return $user;
    }

    
    public function validateForgotPassword(string $email): array
    {
        $errors = [];

        if ($email === '') {
            $errors['empty'] = 'err_required';
        }

        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'err_email';
        }

        return $errors;
    }

    public function createResetToken(string $email): ?string
    {
        $user = $this->findByEmail($email);

        if (!$user) {
            return null;
        }

        $token     = bin2hex(random_bytes(32));
        $tokenHash = hash('sha256', $token);

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('
            INSERT INTO password_reset_tokens
                (user_id, token_hash, expires_at)
            VALUES
                (:user_id, :token_hash, DATE_ADD(NOW(), INTERVAL 1 HOUR))
        ');

        $stmt->execute([
            'user_id'    => $user['user_id'],
            'token_hash' => $tokenHash,
        ]);

        return $token;
    }

    
    /**
     * @param  string $email
     * @param  string $token    
     * @param  string $password
     * @param  string $confirm
     */
    public function validateResetPassword(
        string $email,
        string $token,
        string $password,
        string $confirm
    ): array {
        $errors = [];

        // Check if the token is valid and not expired
        if (!$this->validateResetToken($email, $token)) {
            $errors['token'] = 'err_token_due';
            return $errors;
        }

        if ($password === '' || $confirm === '') {
            $errors['empty'] = 'err_required';
        }

        if ($password !== '' && !preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $errors['password'] = 'err_password';
        }

        if ($password !== '' && $confirm !== '' && $password !== $confirm) {
            $errors['confirm'] = 'err_confirm';
        }

        return $errors;
    }

    
    public function validateResetToken(string $email, string $token): ?array
    {
        $tokenHash = hash('sha256', $token);

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('
            SELECT prt.*, u.email
            FROM   password_reset_tokens prt
            INNER JOIN users u ON u.user_id = prt.user_id
            WHERE  u.email          = :email
              AND  prt.token_hash   = :token_hash
              AND  prt.expires_at   > NOW()
            LIMIT 1
        ');

        $stmt->execute([
            'email'      => $email,
            'token_hash' => $tokenHash,
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    /**
     * Saves the new hashed password for the given user_id.
     */
    public function resetPassword(int $userId, string $password): void
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('
            UPDATE users
            SET    password_hash = :password_hash
            WHERE  user_id       = :user_id
        ');

        $stmt->execute([
            'password_hash' => $passwordHash,
            'user_id'       => $userId,
        ]);
    }

    /**
     * Deletes the used reset token so it can't be used again.
     */
    public function deleteResetToken(int $tokenId): void
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('
            DELETE FROM password_reset_tokens
            WHERE  token_id = :token_id
        ');

        $stmt->execute(['token_id' => $tokenId]);
    }


    public function findByEmail(string $email): ?array
    {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('
            SELECT *
            FROM   users
            WHERE  email = :email
            LIMIT 1
        ');

        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }
}
