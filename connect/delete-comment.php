<?php
    session_start();
    include("database.php");
    $id = $_POST["id"];
    $post_id = $_POST["post_id"];

    if (isset($_POST["delete"])) {
        $login_user = $_SESSION["login_user"];
    
        $userGet = mysqli_query($conn, "SELECT * FROM users WHERE id = {$login_user["id"]}");
        $userGet = mysqli_fetch_assoc($userGet);
    
        $postGet = mysqli_query($conn, "SELECT * FROM posts WHERE id = $post_id");
        $postGet = mysqli_fetch_assoc($postGet);

        $commentGet = mysqli_query($conn, "SELECT * FROM comments WHERE id = $id");
        $commentGet = mysqli_fetch_assoc($commentGet);

        mysqli_query($conn, "DELETE FROM comments WHERE id = $id");
    
        if ($postGet["id"] == $login_user["id"] && $commentGet["id"] == $login_user["id"]) {
            mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Удалил свой комментарии к своему посту с идентификатором: $post_id')");
        } elseif ($postGet["id"] == $login_user["id"]) {
            mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Удалил комментарий пользователя к своему посту с идентификатором: $post_id')");
        } elseif ($commentGet["id"] == $login_user["id"]) {
            mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Удалил свой комментарии к посту с идентификатором: $post_id')");
        }
        else {
            mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Удалил комментарии к посту с идентификатором: $post_id')");
        }
        
    }

    header("Location: ../detail.php?id=" . $post_id);

?>