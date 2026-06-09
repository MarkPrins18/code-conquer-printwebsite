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
}
