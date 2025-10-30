<?php
session_start();
 // Check if the user is logged in and has admin privileges
 if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true){
  //not logged in, show login from
    header('Location: login_form.php');
  exit;
 }
 //user is logged in, show admin content
 ?>

<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/global.css" />
    <link rel="stylesheet" href="assets/css/header-footer.css" />
    <link rel="stylesheet" href="assets/css/admin.css" />
    <script src="assets/js/admin.js" defer></script>
    <title>admin portaal</title>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
  </head>
  <body>
    <!--This code should be put on any page. The pages needs to have extension .php. Html files can't run php code.-->
    <?php include 'layout/header.html' ?>

    <main>

 
 <h1>admin</h1>

    </main>

    <?php include 'layout/footer.html' ?>
  </body>
</html>
