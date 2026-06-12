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

    // ── Registratie ───────────────────────────────────────────────────────────

    /**
     * Valideert de invoer en maakt de gebruiker aan als alles klopt.
     * Geeft de errors array terug zodat de controller hem in de flash kan zetten.
     *
     * @return array  Leeg bij succes, anders [veld => vertaalsleutel]
     */
    public function signupUser(): array
    {
        $errors = $this->validateRegister();

        if (!empty($errors)) {
            return $errors;
        }

        $this->create();
        return [];
    }

    
       /**
     * Valideert alle registratievelden.
     * Foutcodes verwijzen naar sleutels in $formHandlingTranslations.
     *
     * @return array  [veldnaam => vertaalsleutel]
     */
    public function validateRegister(): array
    {
        $errors = [];

        // 1. Verplichte velden leeg?
        if (empty($this->company_name) || empty($this->email) ||
            empty($this->password)     || empty($this->confirmPwd)) {
            $errors['empty'] = 'err_required';
        }

        // 2. E-mailformaat
        if ($this->email !== '' && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'err_email';
        }

        // 3. Wachtwoordsterkte: min. 8 tekens, 1 hoofdletter, 1 cijfer
        if ($this->password !== '' &&
            !preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $this->password)) {
            $errors['password'] = 'err_password';
        }

        // 4. Wachtwoord bevestiging
        if ($this->password !== '' && $this->confirmPwd !== '' &&
            $this->password !== $this->confirmPwd) {
            $errors['confirm'] = 'err_confirm';
        }

        return $errors;
    }

    // createUser is currently a placeholder method, but should be the method that passes user data to the database
    public function create()
    {
         $hashedPwd = password_hash($this->password, PASSWORD_DEFAULT);

        $pdo = Database::getConnection();

        $stmt = $pdo->prepare('
            INSERT INTO users (company_name, email, password_hash, role_id)
            VALUES (:company_name, :email, :password_hash, :role_id)
        ');

        $stmt->execute([
            'company_name'  => $this->company_name,
            'email'         => $this->email,
            'password_hash' => $hashedPwd,
            'role_id'       => $this->role_id,
        ]);
    }

    // ── Login ─────────────────────────────────────────────────────────────────

    /**
     * Valideert het loginformulier op formaat (geen DB-aanroep).
     *
     * @param  string $email
     * @param  string $password
     * @return array  [veldnaam => vertaalsleutel]
     */
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


    /**
     * Zoekt een gebruiker op e-mailadres en verifieert het wachtwoord.
     * Geeft de gebruikersrij terug bij succes, of null bij mislukking.
     *
     * Bewust één vage foutmelding voor beide gevallen (e-mail/wachtwoord),
     * zodat aanvallers niet kunnen raden of een adres bestaat.
     *
     * @return array|null  Gebruikersrij of null
     */
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

    // ── Wachtwoord vergeten ───────────────────────────────────────────────────

    /**
     * Valideert het forgot-password formulier.
     *
     * @param  string $email
     * @return array  [veldnaam => vertaalsleutel]
     */
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

    /**
     * Maakt een reset-token aan en slaat de SHA-256 hash op in
     * de tabel password_reset_tokens. Geeft het plaintext token terug
     * zodat de controller het per e-mail kan versturen.
     *
     * Geeft null terug als het e-mailadres niet bestaat — maar de controller
     * toont altijd dezelfde succesboodschap (geen gebruikersenumeration).
     *
     * @return string|null  Plaintext token of null
     */
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

    // ── Wachtwoord resetten ───────────────────────────────────────────────────

    /**
     * Valideert het reset-password formulier.
     * Controleert ook of het token geldig en niet verlopen is.
     *
     * @param  string $email
     * @param  string $token    Plaintext token uit de URL
     * @param  string $password
     * @param  string $confirm
     * @return array  [veldnaam => vertaalsleutel]
     */
    public function validateResetPassword(
        string $email,
        string $token,
        string $password,
        string $confirm
    ): array {
        $errors = [];

        // Token eerst controleren — als het ongeldig is heeft de rest geen zin
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

    /**
     * Controleert of het token bestaat en nog niet verlopen is.
     * Geeft de token-rij terug (inclusief user_id en token_id) of null.
     *
     * @return array|null
     */
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
     * Slaat het nieuwe gehashte wachtwoord op voor de gegeven user_id.
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
     * Verwijdert het gebruikte reset-token zodat het niet opnieuw gebruikt kan worden.
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

    // ── Hulpfunctie ───────────────────────────────────────────────────────────

    /**
     * Zoekt een gebruiker op e-mailadres.
     * Gebruikt door loginUser(), createResetToken() en validateResetToken().
     *
     * @return array|null  Volledige gebruikersrij of null
     */
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
