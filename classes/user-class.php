<?php

class User
{
    // public $id;
    private $company_name;
    private $email;
    private $password;
    private $confirmPwd;
    // public $phone;

    public $role_id;
    public $created_at;
    public $updated_at;

    public function __construct($company_name, $email, $password, $confirmPwd)
    {

        $this->company_name = $company_name;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPwd = $confirmPwd;
    }

    public function signupUser()
    {
        //runs error methods before creating user
        if($this->emptyInput() == false) {
            header("location: ../register.php?error=emptyinput");
            exit();
        }
        if($this->invalidCompName() == false) {
            header("location: ../register.php?error=invalidname");
            exit();
        }
        if($this->invalidEmail() == false) {
            header("location: ../register.php?error=invalidemail");
            exit();
        }
        if($this->pwdConfirmed() == false) {
            header("location: ../register.php?error=passwordnomatch");
            exit();
        }

        $this->createUser($this->company_name, $this->email, $this->password);
    }

    // createUser is currently a placeholder method, but should be the method that passes user data to the database
    private function createUser($company_name, $email, $hashedPwd)
    {
        $hashedPwd = password_hash($hashedPwd, PASSWORD_DEFAULT);
        var_dump($company_name, $email, $hashedPwd);
        
        // code to verify User object is made and Pwd is hashed:
        // die("died after creation");
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
    private function pwdConfirmed() {
        if($this->password !== $this->confirmPwd) {
            $result = false;
        }
        else  {
            $result = true;
        }
        return $result;
    }

    private function getRoleID() {

    }

}
    
      
    // public function create() {

    // }

    // public function read() {
        
    // }

    // public function update() {
        
    // }

    // public function delete() {
        
    // }

    // public function validatePassword() {

    // }

    // public function hashPassword() {

    // }

    // public function findByEmail() {

    // }

    // public function updatePassword() {

    // }
    
    // public function getAllCompanyNames() {

    // }
