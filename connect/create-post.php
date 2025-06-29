<?php

session_start();
include("./database.php");
header("Content-Type: application/json");


    $login_user = $_SESSION["login_user"];

    $userGet = mysqli_query($conn, "SELECT * FROM users WHERE id = {$login_user["id"]}");
    $userGet = mysqli_fetch_assoc($userGet);

    $title = $_POST["title"];
    $body = $_POST["body"];

    if (empty($title) && empty($body)) {
        $res = [
            "status" => false,
            "message" => "Enter title and body for post adding"
        ];
        echo json_encode($res);
        exit;
    } elseif (empty($title)) {
        $res = [
            "status" => false,
            "message" => "Enter title for post adding"
        ];
        echo json_encode($res);
        exit;
    } elseif (empty($body)) {
        $res = [
            "status" => false,
            "message" => "Enter body for post adding"
        ];
        echo json_encode($res);
        exit;
    }

    
    
    
    mysqli_query($conn, "INSERT INTO posts (title, body, user_id) VALUES ('$title', '$body', {$login_user["id"]})");
    $newPostId = mysqli_insert_id($conn);
    mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Добавил новый пост с id: $newPostId')");
 
    $res = [
        "status" => true,
    ];

    echo json_encode($res);
    

?>