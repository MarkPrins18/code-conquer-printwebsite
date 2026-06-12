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

    public function signupUser(): void
    {
        //runs error methods before creating user
        $errors = $this->validate();

        if (!empty($errors)) {
            return;
        }

        $this->create();
    }

    public function validate(): array
    {
        $errors = [];

        if ($this->emptyInput()) {
            $errors['empty'] = 'Vul alle velden in.';
        }
        if ($this->invalidCompName()) {
            $errors['company_name'] = 'Bedrijfsnaam mag alleen letters en cijfers bevatten.';
        }
        if ($this->invalidEmail()) {
            $errors['email'] = 'Vul een geldig e-mailadres in.';
        }
        if ($this->pwdNotConfirmed()) {
            $errors['password'] = 'Wachtwoorden komen niet overeen.';
        }

        return $errors;
    }

    // createUser is currently a placeholder method, but should be the method that passes user data to the database
    public function create()
    {
        $hashedPwd = password_hash($this->password, PASSWORD_DEFAULT);
        var_dump($this->company_name, $this->email, $hashedPwd, $this->role_id);
    }

    public function loginUser(string $email, string $password): ?array  {
    // zoek de gebruiker op e-mail (prepared statement) -> $row
    if ($row && password_verify($password, $row['password_hash'])) {
        return $row; // inlog klopt!
    }
    return null;     // onbekende gebruiker of fout wachtwoord!
}

    //ERRORS
    //checks if all fields are filled in
    private function emptyInput() {
        if(empty($this->company_name) || empty($this->email) || empty($this->password) || empty($this->confirmPwd)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    // //check company name for valid character input
    private function invalidCompName() {
        if(!preg_match("/^[a-zA-z0-9]*$/", $this->company_name)) {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }

    // // built in email validation method
    private function invalidEmail() {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        else  {
            $result = true;
        }
        return $result;
    }

    // // check password + password confirm = the same
    private function pwdNotConfirmed() {
        if($this->password !== $this->confirmPwd) {
            $result = false;
        }
        else  {
            $result = true;
        }
        return $result;
    }


    public function findByEmail(string $email): ?array {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        SELECT *
        FROM users
        WHERE email = :email
        LIMIT 1
    ");

    $stmt->execute([
        'email' => $email
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
    
    }


    public function createResetToken(string $email): ?string {
    $user = $this->findByEmail($email);

    if (!$user) {
        return null;
    }

    $token = bin2hex(random_bytes(32));

    $tokenHash = hash(
        'sha256',
        $token
    );

    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        INSERT INTO password_reset_tokens
        (
            user_id,
            token_hash,
            expires_at
        )
        VALUES
        (
            :user_id,
            :token_hash,
            DATE_ADD(NOW(), INTERVAL 1 HOUR)
        )
    ");

    $stmt->execute([
        'user_id' => $user['user_id'],
        'token_hash' => $tokenHash
    ]);

    return $token;
    }


    public function validateResetToken(string $email, string $token): ?array {
    $tokenHash = hash(
        'sha256',
        $token
    );

    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        SELECT
        prt.*,
        u.email
    FROM password_reset_tokens prt
    INNER JOIN users u
        ON u.user_id = prt.user_id
    WHERE
        u.email = :email
        AND prt.token_hash = :token_hash
        AND prt.expires_at > NOW()
    LIMIT 1
    ");

$stmt->execute([
    'email'      => $email,
    'token_hash' => $tokenHash
]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ?: null;
    }


    public function resetPassword(int $userId, string $password): void
    {
    $passwordHash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        UPDATE users
        SET password_hash = :password_hash
        WHERE user_id = :user_id
    ");

    $stmt->execute([
        'password_hash' => $passwordHash,
        'user_id' => $userId
    ]);
    }


    public function deleteResetToken(int $tokenId): void
    {
    $pdo = Database::getConnection();

    $stmt = $pdo->prepare("
        DELETE
        FROM password_reset_tokens
        WHERE token_id = :token_id
    ");

    $stmt->execute([
        'token_id' => $tokenId
    ]);
    }
}
