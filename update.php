<?php
    session_start();
    include("./connect/database.php");


//    $post_id = null;

//    if (isset($_GET["id"])) {
//        $post_id = $_GET["id"];
//    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $title = $_POST["title"];
            $body = $_POST["body"];

            var_dump($id);

            $login_user = $_SESSION["login_user"];

            $foundUser = mysqli_query($conn, "SELECT * FROM users WHERE id = {$login_user["id"]}");
            $foundUser = mysqli_fetch_assoc($foundUser);

            $isYourPost = mysqli_query($conn, "SELECT * FROM posts WHERE id = {$id}");
            $isYourPost = mysqli_fetch_assoc($isYourPost);

            if ($isYourPost["id"] == $login_user["id"]) {
                mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$foundUser["role"]}', '{$foundUser["username"]}', 'Изменил свой пост с идентификатором: $id')");
            } else {
                mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$foundUser["role"]}', '{$foundUser["username"]}', 'Изменил пост с идентификатором: $id')");
            }

            if (empty($title) && empty($body)) {
                mysqli_query($conn, "UPDATE posts SET title = '{$isYourPost['title']}', body = '{$isYourPost['body']}' WHERE id = $id");
            } elseif (empty($title) && $body !== $isYourPost["body"]) {
                mysqli_query($conn, "UPDATE posts SET title = '{$isYourPost['title']}', body = '$body', changed = 'true' WHERE id = $id");
            } elseif (empty($body) && $title !== $isYourPost["title"]) {
                mysqli_query($conn, "UPDATE posts SET title = '$title', body = '{$isYourPost['body']}', changed = 'true' WHERE id = $id");
            } elseif ($title === $isYourPost["title"] && $body === $isYourPost["body"]) {
                mysqli_query($conn, "UPDATE posts SET title = '$title', body = '$body' WHERE id = $id");
            } elseif (!empty($title) && !empty($body)) {
                if ($title !== $isYourPost["title"] || $body !== $isYourPost["body"]) {
                    mysqli_query($conn, "UPDATE posts SET title = '$title', body = '$body', changed = 'true' WHERE id = $id");
                }
            }

            header("Location: index.php");
    }

?>