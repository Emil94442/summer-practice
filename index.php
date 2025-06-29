<?php
    session_start();
    include("./connect/database.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header("Location: " . $_SERVER['REQUEST_URI']);
    }

    function truncateText($text, $maxLength = 100) {
        if (strlen($text) > $maxLength) {
            $text = substr($text, 0, $maxLength);
            return "{$text}...";
        }
        return $text;
    }
    
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        * {
  box-sizing: border-box;
}
        .form-group {
      margin-bottom: 15px;
    }

    label {
        text-align: left;
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"] {
      width: 100%;
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
    }

    .form-text {
      font-size: 12px;
      color: #6c757d;
      margin-top: 5px;
    }

    .form-check {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }

    .form-check input[type="checkbox"] {
      margin-right: 10px;
    }

    .btn {
      padding: 8px 20px;
      font-size: 14px;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn-update-post {
      padding: 8px 20px;
      font-size: 14px;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #0056b3;
    }

        table {
            max-width: 1300px;
            margin-top: 20px;
            min-width: 11px;
        }
        th {
            background-color: #333333;
            color: white;
            padding: 10px;
        }
        td {
            position: relative;
            background-color: #b2b2b2;
            padding: 10px;
            
        }

        td:nth-child(3) {
            word-wrap: break-word; /* Перенос длинных слов */
            word-break: break-all;  /* Перенос при любом символе */
            white-space: normal; 
        }

        .register-panel {
            display: flex;
            justify-content: space-between;
        }
        .register-panel button {
            padding: 10px;
        }



        /* Стиль для затемнения фона */
        .modal {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;

            justify-content: center; /* по горизонтали */
            align-items: center;     /* по вертикали */
        }

        /* Стиль для контента модального окна */
        .modal-content {
            background-color: white;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            border-radius: 8px;
        }

        /* Стиль для кнопки закрытия */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-login {
            position: relative;
            bottom: 20px;
        }

        .two-forms {
            display: flex;
        }

        .log-b {
            position: relative;
            right: 5px;
        }
        .user-info-panel {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .create-post-button {
            margin: 10px 0 10px 10px;
        }


        /* Стиль для второго модального окна (создание поста) */
        .modal-create {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;

            justify-content: center; /* по горизонтали */
            align-items: center;     /* по вертикали */
        }

        .modal-content-create {
            background-color: white;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            border-radius: 8px;
        }

        .close-create {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: relative;
            top: -5px;
        }

        .close-create:hover,
        .close-create:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-update {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;

            justify-content: center; /* по горизонтали */
            align-items: center;     /* по вертикали */
        }

        .modal-content-update {
            background-color: white;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            border-radius: 8px;
        }

        .close-update {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: relative;
            top: -5px;
        }

        .close-update:hover,
        .close-update:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .name-bg {
            background-color: black;
            padding: 20px 20px;
            border-radius: 90%;
        }

        .two-forms {
            margin-top: 15px;
        }

        .edited-body {
            font-weight: 800;
        }

        .navigation-buttons.off {
            display: none;
        }

        .text-button {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
        }

        .full-bg {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 0;
            border-radius: 6px; /* если хочешь скругление */
        }

        .full-bg.view {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: green;
            z-index: 0;
            border-radius: 6px; /* если хочешь скругление */
        }

        

        .full-bg.update {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: blue;
            z-index: 0;
            border-radius: 6px; /* если хочешь скругление */
        }

        .full-bg.delete {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: red;
            z-index: 0;
            border-radius: 6px; /* если хочешь скругление */
        }

        .button-view:hover {
            cursor: pointer;
        }

        .button-update:hover {
            cursor: pointer;
        }

        .button-delete:hover {
            cursor: pointer;
        }

        .nav-btns {
            display: flex; 
            justify-content:space-around; 
            font-size: 24px; 
        }

        .nav-view {
            position: relative; /* Обязательно! */
            background-color: green;
            color: white;
            padding: 10px;
            border-radius: 3px;
            
        }

        .nav-update {
            background-color: blue;
            color: white;
            padding: 10px;
            border-radius: 3px;
        }

        .nav-delete {
            background-color: red;
            color: white;
            padding: 10px;
            border-radius: 3px;
        }

        .error-login.none {
            display: none;
        }

        .error-login {
            color: red;
        }

        .error-create.none {
            display: none;
        }

        .error-create {
            color: red;
        }

        .error-update.none {
            display: none;
        }

        .error-update {
            color: orange;
        }

    </style>
</head>
<body>

    <h1 id="errorLogin" style="text-align: center; color: red; display:none">
          Не удалось войти, пожалуйста попробуйте снова.
    </h1>
    
    <div class="register-panel">
        <?php
            // $LoginUser = mysqli_query($conn, "SELECT * FROM login_user");
            // $LoginUser = mysqli_fetch_assoc($LoginUser);

            if (isset($_SESSION["login_user"])) {
                $userGet = mysqli_query($conn, "SELECT * FROM users WHERE id = {$_SESSION["login_user"]["id"]}");
                $userGet = mysqli_fetch_assoc($userGet);
                ?>
                   <div class="create-post-button">
                        <button>создать пост</button>
                   </div>
            <?php
            }?>
        <div class="user-info-panel">
             <?php
                 
     
                 if (isset($_SESSION["login_user"])) {
                     $LoginUser = $_SESSION["login_user"];

                     $userGet = mysqli_query($conn, "SELECT * FROM users WHERE id = {$LoginUser["id"]}");
                     $userGet = mysqli_fetch_assoc($userGet);
                     ?>
                     <div class="name-bg">
                       <p style="font-size: 24px; font-weight:900; color:white; margin: 5px 0  "><?= $userGet["username"]?></p>
                     </div>
                     <div class="two-forms">
                        <form action="logout.php" method="post" class="form-logout">
                             <button type="submit" name="Logout" class="log-b">Выйти</button>
                        </form>
                        <form action="profile.php" method="post">
                             <button type="submit" name="Profile">Профиль</button>
                        </form>
                     </div>
                     
                
             <?php
             } else {?>
                  <button id="openModalBtn">Войти</button>
             <?php
             }?>
        </div>
    </div>

    <!-- Модальное окно -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span><br>
            <form action="./connect/login.php" method="post" class="form-login">
                <h2>Login</h2>
                <label for="username">username</label> 
                <input type="text" name="username" id="username" placeholder="Enter username"><br><br>
                <label for="password">password</label> 
                
                
                <input type="text" name="password" id="password" placeholder="Enter password"><br><br>
                <p class="error-login none"></p>
                <button type="submit" class="btn" id="clickedForm">Enter</button>
            </form>
        </div>
    </div>


    <!-- Модальное окно для создания поста-->
    <div id="myModal-create" class="modal-create">
        <div class="modal-content-create">
            <!-- <span class="close-create">&times;</span><br>
            <form action="./connect/create-post.php" method="post">
                <h2>Create post</h2>
                title:
                <input type="text" name="title" id="title"><br><br>
                body:
                
                <input type="text" name="body" id="body"><br><br>
                <input type="submit" name="enter-create" value="Enter" id="clickedForm-create">
            </form> -->
            <span class="close-create">&times;</span><br>
            <form action="./connect/create-post.php" method="post">
                <h2>Creating post</h2>
                <div class="form-group">
                    <label>title</label>
                    <input type="text" name="title" id="title" placeholder="enter title">
                </div>

                <div class="form-group">
                    <label>body</label>
                    <input type="text" name="body" id="body" placeholder="enter body">
                </div>

                <p class="error-create none"></p>

                <button type="submit" class="btn" id="btn-create-post">Create</button>
            </form>
        </div>
    </div>


    <div id="myModal-update" class="modal-update">
        <div class="modal-content-update">
            <span class="close-update">&times;</span><br>
            <form action="./update.php" method="post">
                <h2>Updating post</h2>
                <p class="id-changing-post"></p>
                <input type="hidden" name="id" id="updating-post-id" value="">
                <div class="form-group">
                    <label>title</label>
                    <input type="text" name="title" id="title-update" placeholder="New title">
                </div>

                <div class="form-group">
                    <label>body</label>
                    <input type="text" name="body" id="body-update" placeholder="New body">
                </div>

                <p class="error-update none">trgd</p>

                <button type="submit" class="btn-update-post">Update</button>
            </form>
        </div>
    </div>



    <table>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>body</th>
            <th>Author</th>
        </tr>
        <?php
            $result = mysqli_query($conn, "SELECT * FROM posts");

            
            while ($row = mysqli_fetch_assoc($result)) {
                   $user_id = $row["user_id"];
                   $user = mysqli_query($conn, "SELECT * FROM users WHERE id = $user_id");
                   $user = mysqli_fetch_assoc($user);

                   $addedTd = false;
                   $isChanged = $row["changed"];
                ?>
                <tr id="<?= $row["id"]?>">
                    <td><?= $row["id"]?></td>
                    <td class="td-title"><?= $row["title"]?></td>
                    <td class="td-body"><?= $row["body"]?> <?php if ($isChanged == "true") {?>
                        <b><i class="edited-body">(edited)</i></b><br>
                        <div class="dfv">d</div>
                    <?php
                }?></td>
                    <td><?= $user["username"]?></td>
                    <td class="added-from-php">
                        <!-- <a style="color: green;" href="detail.php?id=<?= $row["id"]?>">view</a> -->
                         <div class="id"><?= $row["id"]?></div>
                         <div class="button-view">
                            <div class="full-bg view"></div>
                            <div class="text-button view">
                                view
                            </div>
                         </div>
                    </td>
                    <?php if (isset($LoginUser)) {?>
                        <?php if ($userGet["role"] == "Создатель" || $userGet["role"] == "Модератор") {?>
                            <?php if ($userGet["role"] != "Создатель" && $user["role"] == "Создатель" || $userGet["role"] != "Создатель" && $user["role"] == "Модератор") {?>

                            <?php
                            } else {?>
                                <td class="added-from-php">
                                    <!-- <a style="color: blue; " href="update.php?id=<?= $row["id"] ?>">update</a> -->
                                    <div class="id-other-btns"><?= $row["id"]?></div>
                                    <div class="button-update">
                                        <div class="full-bg update"></div>
                                        <div class="text-button update">
                                            update
                                        </div>
                                    </div>
                                </td>
                                <td class="added-from-php">
                                    <!-- <a style="color: red ;" href="./connect/delete-post.php?id=<?= $row["id"] ?>">delete</a> -->
                                    <div class="button-delete">
                                        <div class="full-bg delete"></div>
                                        <div class="text-button delete">
                                            delete
                                        </div>
                                    </div>
                                </td>
                            <?php
                            } if ($userGet["id"] == $user["id"] && $userGet["role"] != "Создатель") {?>
                                <td class="added-from-php">
                                    <!-- <a style="color: blue; " href="update.php?id=<?= $row["id"] ?>">update</a> -->
                                    <div class="id-other-btns"><?= $row["id"]?></div>
                                    <div class="button-update">
                                        <div class="full-bg update"></div>
                                        <div class="text-button update">
                                            update
                                        </div>
                                    </div>
                                </td>
                                <td class="added-from-php">
                                    <!-- <a style="color: red ;" href="./connect/delete-post.php?id=<?= $row["id"] ?>">delete</a> -->
                                    <div class="button-delete">
                                        <div class="full-bg delete"></div>
                                        <div class="text-button delete">
                                            delete
                                        </div>
                                    </div>
                                </td>
                            <?php
                              }} if ($userGet["id"] == $user["id"] && $userGet["role"] == "Пользователь") {?>
                                <td class="added-from-php">
                                    <!-- <a style="color: blue; " href="update.php?id=<?= $row["id"] ?>">update</a> -->
                                    <div class="id-other-btns"><?= $row["id"]?></div>
                                    <div class="button-update">
                                        <div class="full-bg update"></div>
                                        <div class="text-button update">
                                            update
                                        </div>
                                    </div>
                                </td>
                                <td class="added-from-php">
                                    <!-- <a style="color: red ;" href="./connect/delete-post.php?id=<?= $row["id"] ?>">delete</a> -->
                                    <div class="button-delete">
                                        <div class="full-bg delete"></div>
                                        <div class="text-button delete">
                                            delete
                                        </div>
                                    </div>
                                </td>
                            <?php
                            } ?>

                        
                        
                    <?php
                    }?>
                    
                </tr>
                <tr class="navigation-buttons off">
                    <td colspan="4" >
                        <div class="nav-btns">
                            <!-- <a href="detail.php?id=<?= $row["id"]?>" style="color: green;">view</a> -->
                             <div class="nav-view">
                                <!-- <div class="id"><?= $row["id"]?></div>
                                    <div class="button-view">
                                        <div class="full-bg view"></div>
                                        <div class="text-button view">
                                            view
                                        </div>
                                   </div> -->
                                   view
                            </div>
                            
                            <?php if (isset($LoginUser)) {?>
                                <?php if ($userGet["role"] == "Создатель" || $userGet["role"] == "Модератор") {?>
                                    <?php if ($userGet["role"] != "Создатель" && $user["role"] == "Создатель" || $userGet["role"] != "Создатель" && $user["role"] == "Модератор") {?>

                                    <?php
                                    } else {?>
                                        <div class="nav-update">
                                <!-- <div class="id"><?= $row["id"]?></div>
                                    <div class="button-view">
                                        <div class="full-bg view"></div>
                                        <div class="text-button view">
                                            view
                                        </div>
                                   </div> -->
                                   update
                            </div>
                            <div class="nav-delete">
                                <!-- <div class="id"><?= $row["id"]?></div>
                                    <div class="button-view">
                                        <div class="full-bg view"></div>
                                        <div class="text-button view">
                                            view
                                        </div>
                                   </div> -->
                                   delete
                            </div>
                                    <?php
                                    } if ($userGet["id"] == $user["id"] && $userGet["role"] != "Создатель") { ?>
                                        <div class="nav-update">
                                            <!-- <div class="id"><?= $row["id"]?></div>
                                                <div class="button-view">
                                                    <div class="full-bg view"></div>
                                                    <div class="text-button view">
                                                        view
                                                    </div>
                                            </div> -->
                                            update
                                        </div>
                                        <div class="nav-delete">
                                            <!-- <div class="id"><?= $row["id"]?></div>
                                                <div class="button-view">
                                                    <div class="full-bg view"></div>
                                                    <div class="text-button view">
                                                        view
                                                    </div>
                                            </div> -->
                                            delete
                                        </div>
                                    <?php
                                    }?>

                                <?php
                                } if ($userGet["id"] == $user["id"] && $userGet["role"] == "Пользователь") {?>
                                    <div class="nav-update">
                                <!-- <div class="id"><?= $row["id"]?></div>
                                    <div class="button-view">
                                        <div class="full-bg view"></div>
                                        <div class="text-button view">
                                            view
                                        </div>
                                   </div> -->
                                   update
                            </div>
                            <div class="nav-delete">
                                <!-- <div class="id"><?= $row["id"]?></div>
                                    <div class="button-view">
                                        <div class="full-bg view"></div>
                                        <div class="text-button view">
                                            view
                                        </div>
                                   </div> -->
                                   delete
                            </div>
                                <?php
                                }?>
                        
                            <?php
                            }?>
                            
                        </div>
                    </td>
                </tr>
        <?php
        }?>

        

        
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    // Получаем элементы
    var modal = document.getElementById("myModal");
    var openBtn = document.getElementById("openModalBtn");
    var closeBtn = document.getElementsByClassName("close")[0];
    var clickedForm = document.getElementById("clickedForm");
    var errorLogin = document.getElementById("errorLogin");

    const idChangingPost = document.querySelector(".id-changing-post");

    const btnUpdatePost = document.querySelector(".btn-update-post");
    


    var modalCreate = document.getElementById("myModal-create");
    var modalUpdate = document.getElementById("myModal-update");

    var openBtnCreate = document.querySelector(".create-post-button");
    var closeBtnTwo = document.querySelector(".close-create");
    var closeBtnThree = document.querySelector(".close-update");
    var clickedFormCreate = document.getElementById("clickedForm-create");

    const buttonView = document.querySelectorAll(".button-view");
    const fullBgView = document.querySelectorAll(".full-bg.view");
    const textButtonView = document.querySelectorAll(".text-button.view");

    const buttonUpdate = document.querySelectorAll(".button-update");
    const fullBgUpdate = document.querySelectorAll(".full-bg.update");
    const textButtonUpdate = document.querySelectorAll(".text-button.update");

    const buttonDelete = document.querySelectorAll(".button-delete");
    const fullBgDelete = document.querySelectorAll(".full-bg.delete");

    const IDs = document.querySelectorAll(".id");
    const IDs_other_btns = document.querySelectorAll(".id-other-btns");

    const navBtns = document.querySelectorAll('.nav-btns');

    const navViews = document.querySelectorAll(".nav-view");
    const navUpdates = document.querySelectorAll(".nav-update");
    const navDelete = document.querySelectorAll(".nav-delete");

    const addedFromPhp = document.querySelectorAll(".added-from-php")
    const navigationButtons = document.querySelectorAll(".navigation-buttons")

    const btnCreatePost = document.querySelector("#btn-create-post");

    const titleUpdate = document.querySelector("#title-update")
    const bodyUpdate = document.querySelector("#body-update")
    
    

    console.log(IDs)

    



    // buttonView.addEventListener('mouseenter', () => {
    //     // Действие при наведении курсора (аналог :hover)
    //     console.log('Навелись мышкой');
    //     fullBgView.style.backgroundColor = '#14d852';
    // });

    // textButtonView.addEventListener('mouseenter', () => {
    //     // Действие при наведении курсора (аналог :hover)
    //     console.log('Навелись мышкой на text-btn');
    //     fullBgView.style.backgroundColor = '#14d852';
    // });

    // buttonView.addEventListener('mouseleave', () => {
    //     // Действие при уходе курсора
    //     console.log('Курсор ушёл');
    //     fullBgView.style.backgroundColor = 'green';
    // });

    // Открытие модального окна при клике на кнопку

    if (openBtn) {
        openBtn.onclick = function() {
        modal.style.display = "flex";
        }
    }

    if (closeBtn) {
        closeBtn.onclick = function() {
        modal.style.display = "none";
        $(".error-login").addClass("none");
        $("input[name='username']").val("")
        $("input[name='password']").val("")
        }
    }

    if (closeBtnTwo) {
        closeBtnTwo.onclick = function() {
            modalCreate.style.display = "none";
        }
    }

    if (closeBtnThree) {
        closeBtnThree.onclick = function() {
            modalUpdate.style.display = "none";
        }
    }
    
    window.addEventListener("mousedown", () => {
        if (event.target == modal) {
        

            modal.style.display = "none";
            $("input[name='username']").val("")
            $("input[name='password']").val("")
            $(".error-login").addClass("none");

        }
        if (event.target == modalCreate) {
            modalCreate.style.display = "none";
        }
        if (event.target == modalUpdate) {
            modalUpdate.style.display = "none";
        }
    })

    window.onclick = function(event) {
    // Проверка на клик вне содержимого модального окна
    
}

    if (openBtnCreate != null) {
        openBtnCreate.onclick = function() {
            modalCreate.style.display = "flex";
        }
    }



    function validationModals(inputs, keyNames, errorTag, type, url, redirect) {
        if (inputs.length !== keyNames.length) {
            console.error("Количество инпутов и ключей должно совпадать");
            return;
        }

        let data = {};

        for (let i = 0; i < inputs.length; i++) {
            data[keyNames[i]] = inputs[i].val(); // val() из jQuery
        }

        $.ajax({
            type: type,
            url: url,
            dataType: "json",
            data: data,
            success(data) {
                if (data.status) {
                    console.log("post-create is true")
                    document.location.href = redirect;
                } else {
                    console.log("post-create is false")
                    errorTag.removeClass("none").text(data.message);
                }
            },
        });
    }




    clickedForm.addEventListener("click", e => {
        e.preventDefault()
        const username = $("input[name='username']");
        const password = $("input[name='password']");
        const errorLogin = $(".error-login");

        validationModals([username, password], ["username", "password"], errorLogin, "POST", "./connect/login.php", "./");
    })

    btnCreatePost.addEventListener("click", e => {
        e.preventDefault()
        const title = $("input[name='title']");
        const body = $("input[name='body']");
        const errorCreate = $(".error-create");

        validationModals([title, body], ["title", "body"], errorCreate, "POST", "./connect/create-post.php", "./");
    })

    
    let navWithAloneBtn = []


    navBtns.forEach(el => {
        if (el.childElementCount === 1) {
            navWithAloneBtn.push(el);
        }
    })

    navWithAloneBtn.forEach(el => {
        let navView = el.children[0];
        console.log(navView)
        navView.style.right = "6px"
    })




    /////////////////////////////////////
    

    

    function truncateText(text, maxLength = 100) {
        if (text.length > maxLength) {
            return text.slice(0, maxLength) + '...';
        }
        return text;
    }


    

    
    

    

    function updateRightPosition() {

    const tdBody = document.querySelectorAll(".td-body")

    console.log(tdBody)

		let currentWidth = document.documentElement.clientWidth;
        let maxLength = 100;

        if (currentWidth < 320) maxLength = 30;
        else if (currentWidth < 350) maxLength = 50;
        else if (currentWidth < 400) maxLength = 70;
        else maxLength = 100;


        tdBody.forEach(el => {
            if (!el.dataset.originalText) {
                el.dataset.originalText = el.textContent;
            }

            let originalText = el.dataset.originalText;
            const isEdited = originalText.includes("(edited)");
            let cleanText = originalText.replace("(edited)", "").trim();

            if (isEdited) {
                //let text = el.textContent.replace('(edited)', '').trim();

                // Здесь можешь вызывать свою функцию truncateText, если нужно
                text = truncateText(cleanText, maxLength);

                // Добавляем отформатированную вставку
                el.innerHTML = `${text} <b><i>(edited)</i></b>`;
            } else {
                el.textContent = truncateText(cleanText, maxLength);
            }
            
        });




        if (currentWidth < 769) {


            addedFromPhp.forEach(el => {
                el.style.display = "none";
            })

            navigationButtons.forEach(el => {
                el.classList.remove('off');
            })

            //uncommentTableRows()
        } else if (currentWidth >= 769) {
            addedFromPhp.forEach(el => {
                el.style.display = "table-cell";
            })

            navigationButtons.forEach(el => {
                el.classList.add('off');
            })
        }

        // if (currentWidth < 565) {
        //     tdBody.forEach(el => {
        //         el.textContent = truncateText(el.textContent, 70);
        //     });
        // } 
        // if (currentWidth < 520) {
        //     tdBody.forEach(el => {
        //         el.textContent = truncateText(el.textContent, 50);
        //     });
        // }
        // if (currentWidth < 490) {
        //     tdBody.forEach(el => {
        //         el.textContent = truncateText(el.textContent, 30);
        //     });
        // }




        // if (currentWidth < 400) {
        //     tdBody.forEach(el => {
        //         if (el.textContent.includes("(edited)")) {
        //             let text = el.textContent.replace('(edited)', '').trim();

        //             // Здесь можешь вызывать свою функцию truncateText, если нужно
        //             text = truncateText(text, 70);

        //             // Добавляем отформатированную вставку
        //             el.innerHTML = `${text} <b><i>(edited)</i></b>`;
        //         } else {
        //             el.textContent = truncateText(el.textContent, 70);
        //         }
        //     });
        // }

        // if (currentWidth < 350) {
        //     tdBody.forEach(el => {
        //         if (el.textContent.includes("(edited)")) {
        //             let text = el.textContent.replace('(edited)', '').trim();

        //             // Здесь можешь вызывать свою функцию truncateText, если нужно
        //             text = truncateText(text, 50);

        //             // Добавляем отформатированную вставку
        //             el.innerHTML = `${text} <b><i>(edited)</i></b>`;
        //         }
        //         else {
        //             el.textContent = truncateText(el.textContent, 50);
        //         }
        //     });
        // }

        // if (currentWidth < 320) {
        //     tdBody.forEach(el => {
        //         if (el.textContent.includes("(edited)")) {
        //             let text = el.textContent.replace('(edited)', '').trim();

        //             // Здесь можешь вызывать свою функцию truncateText, если нужно
        //             text = truncateText(text, 30);

        //             // Добавляем отформатированную вставку
        //             el.innerHTML = `${text} <b><i>(edited)</i></b>`;
        //         }
        //         else {
        //             el.textContent = truncateText(el.textContent, 30);
        //         }
        //     });
        // }
    }
updateRightPosition()

    function hoveringButtons() {
        let forHoveringButtons = [];
        const BigScreenBtns = window.getComputedStyle(addedFromPhp[0]).display;
        

        for (let i = 0; i < buttonView.length; i++) {
            

            if (BigScreenBtns == "none") {
                let arr = [];
                arr.push(navViews[i])
                arr.push(IDs[i])

                forHoveringButtons.push([...arr]);
            } else {
                let arr = [];
                arr.push(buttonView[i])
                arr.push(fullBgView[i])
                arr.push(IDs[i])

                forHoveringButtons.push([...arr]);
            }

            
            
        }

        for (let i = 0; i < buttonUpdate.length; i++) {

            let arr = [];
            if (BigScreenBtns == "none") {
                
                arr.push(navUpdates[i])
                arr.push(IDs_other_btns[i])

                forHoveringButtons.push([...arr]);
            } else {
                arr.push(buttonUpdate[i])
                arr.push(fullBgUpdate[i])
                arr.push(IDs_other_btns[i])

                forHoveringButtons.push([...arr]);
            }

            
            
        }

        for (let i = 0; i < buttonDelete.length; i++) {

            let arr = [];
            if (BigScreenBtns == "none") {

                arr.push(navDelete[i])
                arr.push(IDs_other_btns[i])

                forHoveringButtons.push([...arr]);
            } else {
                arr.push(buttonDelete[i])
                arr.push(fullBgDelete[i])
                arr.push(IDs_other_btns[i])

                forHoveringButtons.push([...arr]);
            }
        }

        

        console.log(forHoveringButtons)

        


        forHoveringButtons.forEach(elem => {

            if (BigScreenBtns == "none") {
                const btn = elem[0]
                const id = elem[1];

                id.style.display = "none"
                btn.style.cursor = "pointer"


                if (elem[0].classList[0] === "nav-view") {

                    btn.addEventListener("click", () => {
                        document.location.href = "detail.php?id=" + id.textContent
                    })

                } else if (elem[0].classList[0] === "nav-update") {

                    btn.addEventListener("click", () => {

                        // document.location.href = "update.php?id=" + id.textContent
                        modalUpdate.style.display = "flex";
                        idChangingPost.textContent = "id - " + id.textContent;
                        btnUpdatePost.addEventListener("click", () => {
                            document.getElementById("updating-post-id").value = id.textContent;
                        })
                    })

                } else {

                    btn.addEventListener("click", () => {
                        document.location.href = "./connect/delete-post.php?id=" + id.textContent
                    })

                }
            } 
            
            else {
                const btn = elem[0]
                const Bg = elem[1];
                const id = elem[2];

                id.style.display = "none"

                console.log(id)


                if (elem[0].classList[0] === "button-view") {
                    btn.addEventListener('mouseenter', () => {
                        // Действие при наведении курсора (аналог :hover)
                        console.log('Навелись мышкой');
                        Bg.style.backgroundColor = '#14d852';
                    });

                    btn.addEventListener('mouseleave', () => {
                        // Действие при уходе курсора
                        console.log('Курсор ушёл');
                        Bg.style.backgroundColor = 'green';
                    });

                    btn.addEventListener("click", () => {
                        document.location.href = "detail.php?id=" + id.textContent
                    })
                } else if (elem[0].classList[0] === "button-update") {
                    btn.addEventListener('mouseenter', () => {
                        // Действие при наведении курсора (аналог :hover)
                        console.log('Навелись мышкой');
                        Bg.style.backgroundColor = '#17acf2';
                    });

                    btn.addEventListener('mouseleave', () => {
                        // Действие при уходе курсора
                        console.log('Курсор ушёл');
                        Bg.style.backgroundColor = 'blue';
                    });

                    btn.addEventListener("click", () => {

                        // document.location.href = "update.php?id=" + id.textContent
                        modalUpdate.style.display = "flex";
                        idChangingPost.textContent = "id - " + id.textContent;

                        const trPost = document.getElementById(id.textContent);
                        const tdTitle = trPost.querySelector(".td-title");
                        const tdBody = trPost.querySelector(".td-body");

                        
                        let tdBodyWithoutEdited = tdBody.textContent;

                        if (tdBodyWithoutEdited.includes("(edited)")) {
                            tdBodyWithoutEdited = tdBodyWithoutEdited.replace(" (edited)", "")
                        }
                        
                        titleUpdate.value = tdTitle.textContent;
                        bodyUpdate.value = tdBodyWithoutEdited;

                        btnUpdatePost.addEventListener("click", (e) => {
   

                            

                            document.getElementById("updating-post-id").value = id.textContent;
                        })
                    })
                } else {
                    btn.addEventListener('mouseenter', () => {
                        // Действие при наведении курсора (аналог :hover)
                        console.log('Навелись мышкой');
                        Bg.style.backgroundColor = '#ff6c6c';
                    });

                    btn.addEventListener('mouseleave', () => {
                        // Действие при уходе курсора
                        console.log('Курсор ушёл');
                        Bg.style.backgroundColor = 'red';
                    });

                    btn.addEventListener("click", () => {
                        document.location.href = "./connect/delete-post.php?id=" + id.textContent
                    })
                }
            }
        })
    }

    hoveringButtons()

    window.addEventListener("resize", () => {
        updateRightPosition()
        hoveringButtons()
    })


   
    
    
    

    // Вызываем функцию

    // Закрытие модального окна при клике вне его
    
</script>
</body>
</html>
