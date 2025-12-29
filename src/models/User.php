<?php

class User
{
    private ?int $id = null;
    private string $company_name = '';
    private string $email = '';
    private string $password_hash = '';
    private int $role_id = 2;
    private string $created_at = '';
    private string $updated_at = '';

    private static array $users = [];
    private static int $counter = 1;

    private function __construct()
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public static function create(string $email, string $password, string $confirmPassword, string $company_name): ?self
    {
        $errors = [];
        $old = [];

        $company_name = trim($company_name);
        $email = strtolower(trim($email));
    
        $old['company_name'] = $company_name;
        $old['email'] = $email;

        if (empty($company_name)) {
            $errors['company_name'] = 'Bedrijfsnaam is verplicht';
        }

        if (empty($email)) {
            $errors['email'] = 'E-mailadres is verplicht';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Ongeldig e-mailformaat';
        } elseif (self::findByEmail($email) !== null) {
            $errors['email'] = 'Dit e-mailadres is al geregistreerd';
        }

        if (empty($password)) {
            $errors['password'] = 'Wachtwoord is verplicht';
        } else {
            $passwordError = self::validatePasswordWithMessage($password);
            if ($passwordError !== null) {
                $errors['password'] = $passwordError;
            } elseif ($password !== $confirmPassword) {
                $errors['confirm'] = 'Wachtwoorden komen niet overeen';
            }
        }

        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            $_SESSION['old_input'] = $old;
            return null;
        }

        $user = new self();
        $user->id = self::$counter++;
        $user->company_name = $company_name;
        $user->email = $email;
        $user->password_hash = self::hashPassword($password);
    
        self::$users[] = $user;

        return $user;
    }

    public static function read(int $id): ?self
    {
        foreach (self::$users as $user) {
            if ($user->id === $id) {
                return $user;
            }
        }
        return null;
    }

    public function update(): bool
    {
        return false;
    }

    public function delete(): bool
    {
        return false;
    }

    public static function validatePassword(string $password): bool
    {
        return self::validatePasswordWithMessage($password) === null;
    }

    public static function validatePasswordWithMessage(string $password): ?string
    {
        if (strlen($password) < 8) {
            return 'Wachtwoord moet minimaal 8 tekens bevatten';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return 'Wachtwoord moet een hoofdletter bevatten';
        }
        if (!preg_match('/[a-z]/', $password)) {
            return 'Wachtwoord moet een kleine letter bevatten';
        }
        if (!preg_match('/[0-9]/', $password)) {
            return 'Wachtwoord moet een cijfer bevatten';
        }
        return null;
    }

    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function findByEmail(string $email): ?self
    {
        foreach (self::$users as $user) {
            if ($user->email === strtolower(trim($email))) {
                return $user;
            }
        }
        return null;
    }

    public function updatePassword(string $newPassword): bool
    {
        return false;
    }

    public static function getAllCompanyNames(): array
    {
        return [];
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getRole(): ?Role
    {
        return Role::findById($this->role_id);
    }
}
