<?php
 
   session_start();
   include("database.php");

    $post_id = $_POST["id"];
    $body = $_POST["body"];
    
    $login_user = $_SESSION["login_user"];

    $userGet = mysqli_query($conn, "SELECT * FROM users WHERE id = {$login_user["id"]}");
    $userGet = mysqli_fetch_assoc($userGet);

    $postGet = mysqli_query($conn, "SELECT * FROM posts WHERE id = $post_id");
    $postGet = mysqli_fetch_assoc($postGet);

    if ($postGet["id"] == $login_user["id"]) {
        mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Добавил комментарии к своему посту с идентификатором: $post_id')");
    } else {
        mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Добавил комментарии к посту с идентификатором: $post_id')");
    }

    mysqli_query($conn, "INSERT INTO comments (body, post_id, user_id) VALUES ('$body', $post_id, {$login_user["id"]})");

    header("Location: ../detail.php?id=" . $post_id)
    
?>