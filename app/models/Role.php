<?php


class Role {
    public $role_id;
    public $name;

    // Hardcoded roles for POC (will be replaced by DB in future)
    private static $roles = [
        1 => "Admin",
        2 => "standaard",
    ];

    public function __construct($role_id, $name)
    {
        $this->role_id = $role_id;
        $this->name = $name;
    }

    public function create() {

    }

    public function read() {
         // Get role name based on role_id
        if(isset(self::$roles[$this->role_id])) {
            $this->name = self::$roles[$this->role_id];
        } else {
            // Default role name if role_id not found
            $this->name = self::$roles[2];
        }

        return $this;
    }

    public function update() {

    }

    public function delete() {

    }

    public function getAll() {

    }

}
