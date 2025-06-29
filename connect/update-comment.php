<?php

    session_start();
    include("database.php");
    
    if (isset($_POST["update"])) {
        $id = $_POST["id"];
        $post_id = $_POST["post_id"];
        $body = $_POST["body"];
        mysqli_query($conn, "UPDATE comments SET body = '$body', changed = 'true' WHERE id = $id");

        $login_user = $_SESSION["login_user"];
    
        $userGet = mysqli_query($conn, "SELECT * FROM users WHERE id = {$login_user["id"]}");
        $userGet = mysqli_fetch_assoc($userGet);
    
        $postGet = mysqli_query($conn, "SELECT * FROM posts WHERE id = $post_id");
        $postGet = mysqli_fetch_assoc($postGet);

        $commentGet = mysqli_query($conn, "SELECT * FROM comments WHERE id = $id");
        $commentGet = mysqli_fetch_assoc($commentGet);
    
        if ($postGet["id"] == $login_user["id"] && $commentGet["id"] == $login_user["id"]) {
            mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Обновил свой комментарии к своему посту с идентификатором: $post_id')");
        } elseif ($postGet["id"] == $login_user["id"]) {
            mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Обновил комментарий пользователя к своему посту с идентификатором: $post_id')");
        } elseif ($commentGet["id"] == $login_user["id"]) {
            mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Обновил свой комментарии к посту с идентификатором: $post_id')");
        }
        else {
            mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Обновил комментарии к посту с идентификатором: $post_id')");
        }
    

        header("Location: ../detail.php?id=" . $post_id);
    }
    

?>