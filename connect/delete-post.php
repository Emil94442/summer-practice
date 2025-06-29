<?php
    session_start();
    include("database.php");
    $post_id = $_GET["id"];

    $login_user = $_SESSION["login_user"];

    $userGet = mysqli_query($conn, "SELECT * FROM users WHERE id = {$login_user["id"]}");
    $userGet = mysqli_fetch_assoc($userGet);

    $postGet = mysqli_query($conn, "SELECT * FROM posts WHERE id = $post_id");
    $postGet = mysqli_fetch_assoc($postGet);

    var_dump($postGet);

    if ($postGet["user_id"] == $login_user["id"]) {
        mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Удалил свой пост с идентификатором: $post_id')");
    } else {
        mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Удалил пост с идентификатором: $post_id')");
    }
    
    mysqli_query($conn, "DELETE FROM posts WHERE id = $post_id");
    
    header("Location: ../");

?>