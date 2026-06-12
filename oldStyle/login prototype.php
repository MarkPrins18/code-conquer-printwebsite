<?php  
require_once __DIR__ . '/config/init.php';

$pdo = Database::getConnection();

if (session_status() === PHP_SESSION_NONE) { //start sessie als er geen sessie is.
     session_start(); 
};

if(isset($_SESSION['user_id']))   // What does this function do?                        
 {    // true then header redirect it to the home page directly 
    header("Location:index.php"); //check location of page.
 }

if(isset($_POST['login']))   // it checks whether the user clicked login button or not 
{
     $user = $_POST['user'];
     $pass = $_POST['pass'];

     //database check voor username en wachtwoord hash.
     //sla waardes op in variabelen.
     $sql = "SELECT `users`.`email`, `password_hash` FROM `users` WHERE `users`.`email` = :email;";

     $stmt = $pdo->prepare($sql);
     $stmt->bindParam(':email', $user);
     $stmt->execute();
     $result = $stmt->fetch();

     echo '<pre>';
    var_dump($result);
      echo '</pre>';

      if($user == $result['email'] && password_verify($pass, $result['password_hash']))
         {
          $sql = "SELECT * FROM `users` WHERE `users`.`email` = :email;";

          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(':email', $user);
          $stmt->execute();
          $result = $stmt->fetch();

          $_SESSION[] = $result;
          
         echo '<script type="text/javascript"> window.open("index.php","_self");</script>';            //  On Successful Login redirects to index.php

        }

        else
        {
            echo "invalid UserName or Password";        
        }
}
 ?>
<html>
<head>

<title> Login Page   </title>

</head>

<body>

<form action="" method="post">

    <table width="200" border="0">
  <tr>
    <td>  UserName</td>
    <td> <input type="text" name="user" > </td>
  </tr>
  <tr>
    <td> PassWord  </td>
    <td><input type="password" name="pass"></td>
  </tr>
  <tr>
    <td> <input type="submit" name="login" value="LOGIN"></td>
    <td></td>
  </tr>
</table>
</form>

</body>
</html>