<?php

session_start();
include("./database.php");

$username = $_POST["username"];
$password = $_POST["password"];
header("Content-Type: application/json");


    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");

    if (mysqli_num_rows($result) < 1) {
        $res = [
            "status" => false,
            "message" => "Incorrect login and password!"
        ];
        echo json_encode($res);
    } else {
        $result = mysqli_fetch_assoc($result);

        //mysqli_query($conn, "INSERT INTO login_user (user_id) VALUES ({$result["id"]})");
    
        $_SESSION["login_user"] = [
            "id" => $result["id"],
            "username" => $result["username"],
            "role" => $result["role"],
            "reg_date" => $result["reg_date"]
        ];
    
        $res = [
            "status" => true,
            "message" => "guest entered!"
        ];
        echo json_encode($res);
    }
    
    

    
    





?>