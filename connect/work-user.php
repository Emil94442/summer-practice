<?php
   session_start();
   include("database.php");

    $login_user = $_SESSION["login_user"];

    $userGet = mysqli_query($conn, "SELECT * FROM users WHERE id = {$login_user["id"]}");
    $userGet = mysqli_fetch_assoc($userGet);



        if (isset($_POST["sub"])) {
            $selected_user = $_POST["user"];
        
            #echo "<pre>";
            #print_r($selected_user);
            #echo "</pre>";
        
            $result = mysqli_query($conn , "SELECT * FROM users WHERE username = '$selected_user' ");
            $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        
        
            if (isset($result)) {
                if ($_POST["sub"] == "Убрать") {
                    mysqli_query($conn, "UPDATE users SET role = 'Пользователь' WHERE username = '$selected_user'");
                    mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Убрал модерку с пользователя $selected_user')");
                    header("Location: ../profile.php");
                }
                elseif ($_POST["sub"] == "Назначить") {
                    mysqli_query($conn, "UPDATE users SET `role` = 'Модератор' WHERE id = {$result["id"]}");
                    mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Назначил пользователя $selected_user — модератором')");
                    header("Location: ../profile.php");
                }
            }
        }
        
        if (isset($_POST["createUseSubmit"])) {
            $roleToCreate = $_POST["roleToCreate"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        
            try {
                mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$hashPassword', '$roleToCreate')");
                $createdUserId = mysqli_insert_id($conn);
                mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'Создал нового пользователя с id: $createdUserId')");
                header("Location: ../profile.php");
            } catch (mysqli_sql_exception) {
                echo "Произошла ошибка при добавлении пользователя: Заданное имя для создания пользователя уже существует";
            }
            
        
        }
        
        if (isset($_POST["updateUseSubmit"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $id = $_POST["id"];

            try {
                $AllUsers = mysqli_query($conn, "SELECT * FROM users");
                $users = mysqli_fetch_all($AllUsers, MYSQLI_ASSOC);

                $foundId = false;

                foreach ($users as $row) {
                    if ($row["id"] == $id) {
                        mysqli_query($conn, "UPDATE users SET username = '$username', password = '$password' WHERE id = $id");
                        mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'обновил пользователя с id: $id')");
                        $foundId = true;
                        break;
                    }
                }

                if (!$foundId) {
                    echo "Произошла ошибка при обновлении пользователя: id пользователя для обновлении в системе не существует";
                } else {
                    header("Location: ../profile.php");
                }

                
            } catch (mysqli_sql_exception) {
                echo "Произошла ошибка при обновлении пользователя: Заданное имя для обновления пользователя уже существует в базе данных";
    
            }
        }
        
        if (isset($_POST["deleteUseSubmit"])) {
            $selected_user = $_POST["user"];
            mysqli_query($conn, "DELETE FROM users WHERE username = '$selected_user'");
            mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$userGet["role"]}', '{$userGet["username"]}', 'удалил пользователя с именем: $selected_user')");
            header("Location: ../profile.php");
        }
    
   
?>