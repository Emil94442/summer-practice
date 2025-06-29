<?php
session_start();

include("./connect/database.php");

if (isset($_POST["Logout"])) {
    unset($_SESSION["login_user"]);
    header("Location: ./");
 }

?>