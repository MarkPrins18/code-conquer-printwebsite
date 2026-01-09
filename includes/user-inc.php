<?php

if (isset($_POST["submit"])) {
    $company_name = $_POST["company_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPwd = $_POST["confirm"];

    //instantiate Use- class
    include "../classes/role-class.php";
    include "../classes/user-class.php";
    $registerUser = new User($company_name, $email, $password, $confirmPwd);


    // code to check if the object is created
    // echo "Class instantiated. Dumping object: <br>";
    // var_dump($registerUser);
    // die("<br>Stopped execution to inspect var_dump.");
    
    //run handler
    //$registerUser->signupUser();   //signupUser() return void
    $roleName = $registerUser->signupUser(); //get role name


    //back to front page
    //header("location: ../register.php?object=success"); //without roleName in URL
    header("location: ../register.php?object=success&role=" . urlencode($roleName));
    exit();
}