<?php

class User {
    public $id;
    public $company_name;
    public $email;
    public $password_hash;
    public $phone;

    public $role_id;
    public $created_at;
    public $updated_at;

    public function __construct($id, $company_name, $email, $password_hash, $phone)
    {
        $this->id = $id;
        $this->company_name = $company_name;
        $this->email = $email;
        $this->password_hash = $password_hash;
        $this->phone = $phone;

        //role_id = normale gebruiker.
    }

    public function create() {

    }

    public function read() {
        
    }

    public function update() {
        
    }

    public function delete() {
        
    }

    public function validatePassword() {

    }

    public function hashPassword() {

    }

    public function findByEmail() {

    }

    public function updatePassword() {

    }
    
    public function getAllCompanyNames() {

    }

}


?>