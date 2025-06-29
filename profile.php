<?php
   session_start();
   include("./connect/database.php");

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     header("Location: " . $_SERVER["REQUEST_URI"]);
   }

   /*
   echo "<pre>";
   print_r($_SERVER);
   echo "</pre>";*/

   $login_user = $_SESSION["login_user"];

   $user = mysqli_query($conn, "SELECT * FROM users WHERE id = {$login_user["id"]}");
   $user = mysqli_fetch_array($user, MYSQLI_ASSOC)

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

        .added-from-php {
            position: relative;
            background-color: #b2b2b2;
            padding: 10px;
            
        }

        .id {
            display: none;
        }

        .posts-table th {
            background-color: #333333;
            color: white;
            padding: 10px;
        }
        .posts-table td {
            background-color: #b2b2b2;
            padding: 10px;
        }

        .posts-table td:nth-child(3) {
            word-wrap: break-word; /* Перенос длинных слов */
            word-break: break-all;  /* Перенос при любом символе */
            white-space: normal; 
        }

        .posts-table {
            max-width: 900px;
        }

        .tables {
            display: flex;
            justify-content: space-between;
            align-items: flex-start; 
            padding-right: 20px;
        }
        .users-table th {
             border: 3px solid black;
             padding: 5px;
             font-size: 20px;
        }
        .users-table {
            border-collapse: collapse;
            margin-top: 10px;
        }
        .users-table td {
             border: 3px solid black;
             font-size: 20px;
             padding: 5px;
        }

        .title-of-tables {
            display: flex;
            justify-content: space-between;
            padding: 0 130px 0 50px;
        }

        .title-of-tables.admin-style {
            padding: 0 140px 0 50px;
        }

        .title-of-tables h2 {
            border: 3px solid black;
            padding: 10px;
            background-color: black;
            color: orange;
        }

        .user-profile-panel {
            display: flex;
            flex-direction: column;
        }

        .user-profile-panel .btn-for-main-people {
            align-self: center;

        }
        .btn-for-main-people {
            width: 100%;
            display: flex;
            justify-content: space-around;
            
        }

        .btn-for-main-people button {
            padding: 5px 10px;
        }


        /* Стиль для затемнения фона */
        .modal {
            display: none; /* Изначально скрыто */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        /* Стиль для контента модального окна */
        .modal-content {
            background-color: white;
            margin: 15% auto;
            min-height: 10px;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
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
        


        /* Стиль для затемнения фона */
        .modal-v2 {
            display: none; /* Изначально скрыто */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        /* Стиль для контента модального окна */
        .modal-content-v2 {
            background-color: white;
            margin: 15% auto;
            min-height: 10px;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        /* Стиль для кнопки закрытия */
        .close-v2 {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            
        }

        .close-v2:hover,
        .close-v2:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #create-user-btn {
            margin-top: 15px;
        }

        #update-user-btn {
            
            margin: 15px 20px 0 20px;
        }

        #delete-user-btn {
            margin-top: 15px;
        }


        /* Стиль для затемнения фона */
        .modal-v3 {
            display: none; /* Изначально скрыто */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        /* Стиль для контента модального окна */
        .modal-content-v3 {
            background-color: white;
            margin: 15% auto;
            min-height: 10px;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        /* Стиль для кнопки закрытия */
        .close-v3 {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            
        }

        .close-v3:hover,
        .close-v3:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


        /* Стиль для затемнения фона */
        .modal-v4 {
            display: none; /* Изначально скрыто */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        /* Стиль для контента модального окна */
        .modal-content-v4 {
            background-color: white;
            margin: 15% auto;
            min-height: 10px;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        /* Стиль для кнопки закрытия */
        .close-v4 {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            
        }

        .close-v4:hover,
        .close-v4:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


        /* Стиль для затемнения фона */
        .modal-v5 {
            display: none; /* Изначально скрыто */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        /* Стиль для контента модального окна */
        .modal-content-v5 {
            background-color: white;
            margin: 15% auto;
            min-height: 10px;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        /* Стиль для кнопки закрытия */
        .close-v5 {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            
        }

        .close-v5:hover,
        .close-v5:focus {
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



        .Name-changed-people {
            display: inline;
            margin-left: 25px;
            margin-top: 10px;
        }
        
        .history-item {
            font-size: 20px;
        }

        .history-item p {
            font-weight: bold;
        }

        .changed-action {
            display: inline;
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

        .id-other-btns {
            display: none;
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
        
        
    </style>

</head>
<body>

    <!-- Модальное окно -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span><br><br>
            <form action="./connect/work-user.php" method="post" class="form-login">
                <select name="user">
                    <option hidden value=""></option>
                    <?php
                        $users = mysqli_query($conn, "SELECT * FROM users WHERE role = 'Модератор'");
                        while ($row = mysqli_fetch_array($users, MYSQLI_ASSOC)) {?>
                        <option value="<?= $row["username"]?>"><?= $row["username"]?></option>
                    <?php
                    }?>
                    
                </select> <br><br>
                    <input type="submit" name="sub" value="Убрать">
            </form>
        </div>
    </div>


    <div id="myModal-v2" class="modal">
        <div class="modal-content-v2">
            <span class="close-v2">&times;</span><br><br>
            <form action="./connect/work-user.php" method="post" class="form-login-v2">
                <select name="user">
                    <option hidden value=""></option>
                    <?php
                        $users = mysqli_query($conn, "SELECT * FROM users WHERE role = 'Пользователь'");
                        while ($row = mysqli_fetch_array($users, MYSQLI_ASSOC)) {?>
                        <option value="<?= $row["username"]?>"><?= $row["username"]?></option>
                    <?php
                    }?>
                </select> <br><br>
                    <input type="submit" name="sub" value="Назначить">
            </form>
        </div>
    </div>


    <div id="myModal-v3" class="modal">
        <div class="modal-content-v3">
            <span class="close-v3">&times;</span><br>
            <form action="./connect/work-user.php" method="post">
                <h3>Create a new user</h3>
                username:
                <input type="text" name="username"><br><br>
                password:
                <input type="text" name="password"><br><br>
                <select name="roleToCreate">
                    <?php
                     if ($user["role"] == "Создатель") {?>
                        <option value="Модератор">Модератор</option>
                        <option selected value="Пользователь">Пользователь</option>
                     <?php
                     } else { ?>
                        <option selected value="Пользователь">Пользователь</option>
                     <?php
                     }?>

                    
                    
                </select>
                <input type="submit" name="createUseSubmit" value="Создать пользователя">
            </form>
        </div>
    </div>


    <div id="myModal-v4" class="modal">
        <div class="modal-content-v4">
            <span class="close-v4">&times;</span><br>
            <form action="./connect/work-user.php" method="post">
                <h3>Update user</h3>
                id:
                <input type="number" name="id"><br><br>
                username:
                <input type="text" name="username"><br><br>
                password:
                <input type="text" name="password"><br><br>
                <input type="submit" name="updateUseSubmit" value="обновить">
            </form>
        </div>
    </div>


    <div id="myModal-v5" class="modal">
        <div class="modal-content-v5">
            <span class="close-v5">&times;</span><br>
            <form action="./connect/work-user.php" method="post">
                <h3>Delete user</h3>
                <select name="user">
                    <?php 
                     $users = mysqli_query($conn, "SELECT * FROM users WHERE role = 'Пользователь'");
                     while ($row = mysqli_fetch_assoc($users)) {?>
                        <option value="<?= $row["username"]?>"><?= $row["username"]?></option>
                    <?php
                    }?>
                </select>
                <input type="submit" name="deleteUseSubmit" value="удалить">
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

                <button type="submit" class="btn-update-post">Update</button>
            </form>
        </div>
    </div>


    <h1>Username: <?= $user["username"] ?></h1>
    <h2>role: <?= $user["role"]?></h2>

    <hr>
    <div class="<?= $login_user["role"] === "Модератор" ? 'title-of-tables' : 'title-of-tables admin-style'?>">
        <h2>Твои посты:</h2>
        <?php if ($user["role"] == "Создатель" || $user["role"] == "Модератор") {?>
            <h2>Список пользователей:</h2>
        <?php
        }?>
    </div>
    <div class="tables">
    <table class="posts-table">
        
        <tr>
            <th>id</th>
            <th>title</th>
            <th>body</th>
            <th>Author</th>
        </tr>

        <?php
            $result = mysqli_query($conn, "SELECT * FROM posts WHERE user_id = {$user["id"]}");
            

            if (mysqli_num_rows($result) > 0) {?>
               <?php while ($post = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
                <tr id="<?= $post["id"] ?>">
                    <td><?= $post["id"]?></td>
                    <td class="td-title"><?= $post["title"]?></td>
                    <td class="td-body"><?= $post["body"]?></td>
                    <td><?= $user["username"] ?></td>
                    <td class="added-from-php">
                         <div class="id"><?= $post["id"]?></div>
                         <div class="button-view">
                            <div class="full-bg view"></div>
                            <div class="text-button view">
                                view
                            </div>
                         </div>
                    </td>
                    <td class="added-from-php">
                        <div class="id-other-btns"><?= $post["id"]?></div>
                        <div class="button-update">
                            <div class="full-bg update"></div>
                            <div class="text-button update">
                                update
                            </div>
                        </div>
                    </td>
                    <td class="added-from-php">
                        <div class="button-delete">
                            <div class="full-bg delete"></div>
                            <div class="text-button delete">
                                delete
                            </div>
                        </div>
                    </td>         

                </tr>
               <?php
               }?>
            <?php
           } else {?>
                <tr>
                    <td><h3>Здесь <br>ничего <br>нету...</h3></td>
                </tr>
           <?php
           }?>
        
    </table>

    <?php
            if ($user["role"] == "Создатель" || $user["role"] == "Модератор") {?>
            <div class="user-profile-panel">

                <?php
                    if ($user["role"] == "Создатель") {?>
                        <div class="btn-for-main-people">
                            <button id="openModalBtn">убрать модерку</button>
                            <button id="openModalBtnTwo">назначить модером</button>
                        </div>
                <?php
                } ?>
                <table class="users-table">
                   <tr>
                       <th>id</th>
                       <th>username</th>
                       
                       <th>role</th>
                       <th>reg-date</th>
                   </tr>
                   <?php
                       $result = mysqli_query($conn, "SELECT * FROM users");
                       
           
                       if (mysqli_num_rows($result) > 0) {?>
                          <?php while ($post = mysqli_fetch_array($result, MYSQLI_ASSOC)) {?>
                           <tr>
                               <td><?= $post["id"]?></td>
                               <td><?= $post["username"]?></td>
                               
                               <td><?= $post["role"]?></td>
                               <td><?= $post["reg_date"] ?></td>
                           </tr>
                          <?php
                          }?>
                       <?php
                      } else {?>
                           <tr>
                               <td><h3>Здесь <br>ничего <br>нету...</h3></td>
                           </tr>
                      <?php
                      }?>
                <?php
                }?>

               </table>
               <?php if ($user["role"] == "Создатель") {?>
                <div class="btn-for-main-people">
                    <button id="create-user-btn">создать пользователя</button>
                    <button id="update-user-btn">обновить пользователя</button>
                    <button id="delete-user-btn">удалить пользователя</button>
                </div>
               <?php
               } elseif ($user["role"] == "Модератор") {?>
                <div class="btn-for-main-people">
                    <button id="create-user-btn">создать пользователя</button>
                    <button id="delete-user-btn">удалить пользователя</button>
                </div>
               <?php
               }?>
         </div>    
    </div>
    

   
    

<script>
    // Получаем элементы
    var modal = document.getElementById("myModal");

    var openBtn = document.getElementById("openModalBtn");
    var closeBtn = document.getElementsByClassName("close")[0];
    // if (openBtn) {
    //     openBtn = document.getElementById("openModalBtn");
    //     closeBtn = document.getElementsByClassName("close")[0];
    // }

    var modalV2 = document.getElementById("myModal-v2");


    var closeBtnTwo = document.querySelector(".close-v2");
    var openBtnTwo = document.getElementById("openModalBtnTwo");
    // if (openBtnTwo) {
    //     closeBtnTwo = document.querySelector(".close-v2");
    //     openBtnTwo = document.getElementById("openModalBtnTwo");
    // }
    

    var openBtnTwoV2 = document.getElementById("openModalBtnTwo-v2");

    var createUserBtn = document.getElementById("create-user-btn");
    var modalV3 = document.getElementById("myModal-v3");
    var closeBtnThree = document.querySelector(".close-v3");

    var updateUserBtn = document.getElementById("update-user-btn");
    var modalV4 = document.getElementById("myModal-v4");
    var closeBtnFour = document.querySelector(".close-v4");

    var deleteUserBtn = document.getElementById("delete-user-btn");
    var modalV5 = document.getElementById("myModal-v5");
    var closeBtnFive = document.querySelector(".close-v5");


    ////////// buttons elemebts

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

    const addedFromPhp = document.querySelectorAll(".added-from-php")

    

    ////////////////////////////////////


    const modalUpdate = document.querySelector(".modal-update")

    const closeUpdate = document.querySelector(".close-update")

    const idChangingPost = document.querySelector(".id-changing-post")

    const btnUpdatePost = document.querySelector(".btn-update-post");

    const titleUpdate = document.querySelector("#title-update")
    const bodyUpdate = document.querySelector("#body-update")

    ///////////////////////////////////

    console.log(closeUpdate)

    console.log(openBtnTwoV2)

    closeUpdate.addEventListener("click", () => {
        modalUpdate.style.display = "none"
    })

    window.addEventListener("mousedown", (e) => {
        switch(e.target) {
            case modal:
                modal.style.display = "none"
            case modalV2:
                modalV2.style.display = "none"
            case modalV3:
                modalV3.style.display = "none"
            case modalV4:
                modalV4.style.display = "none"
            case modalV5:
                modalV5.style.display = "none"
            case modalUpdate:
                modalUpdate.style.display = "none"
        }
    })

    if (openBtn && openBtnTwo && createUserBtn && updateUserBtn && deleteUserBtn) {
        openBtn.onclick = function() {
        modal.style.display = "block";

        }

        openBtnTwo.onclick = function() {
        modalV2.style.display = "block";
        }

        createUserBtn.onclick = function() {
            modalV3.style.display = "block";
        }

        updateUserBtn.onclick = function() {
            modalV4.style.display = "block";
        }

        deleteUserBtn.onclick = function() {
            modalV5.style.display = "block";
        }
    } else {

        createUserBtn.onclick = function() {
            modalV3.style.display = "block";
        }


        deleteUserBtn.onclick = function() {
            modalV5.style.display = "block";
        }
    }

    console.log(createUserBtn)

    console.log(deleteUserBtn)
    
    
    if (openBtnTwoV2 && createUserBtn && updateUserBtn && deleteUserBtn) {
        openBtnTwoV2.onclick = function() {
            modalV2.style.display = "block";
        }

        createUserBtn.onclick = function() {
            modalV3.style.display = "block";
        }

        updateUserBtn.onclick = function() {
            modalV4.style.display = "block";
        }

        deleteUserBtn.onclick = function() {
            modalV5.style.display = "block";
        }
    }


    if (closeBtn) {
        closeBtn.onclick = function() {
        modal.style.display = "none";
        }
    }

    if (closeBtnThree) {
        closeBtnThree.onclick = function() {
        modalV3.style.display = "none";
        }
    }

    if (closeBtnTwo) {
        closeBtnTwo.onclick = function() {
        modalV2.style.display = "none";
        }
    }

    if (closeBtnFour) {
        closeBtnFour.onclick = function() {
        modalV4.style.display = "none";
        }
    }

    if (closeBtnFive) {
        closeBtnFive.onclick = function() {
        modalV5.style.display = "none";
        }
    }


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
                btn.style.cursor = "pointer"


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
    
</script>

</body>
</html>





<?php

    
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
                }
                elseif ($_POST["sub"] == "Назначить") {
                    mysqli_query($conn, "UPDATE users SET `role` = 'Модератор' WHERE id = {$result["id"]}");
                    #mysqli_query($conn, "INSERT INTO history (role, user, action) VALUES ('{$user["role"]}', '{$user["username"]}', 'Назначил пользователя {$selected_user} — модератором')");
                }
            }
        }

        if (isset($_POST["createUseSubmit"])) {
            $roleToCreate = $_POST["roleToCreate"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$roleToCreate')");

        }

        if (isset($_POST["updateUseSubmit"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $id = $_POST["id"];

            mysqli_query($conn, "UPDATE users SET username = '$username', password = '$password' WHERE id = $id");
        }

        if (isset($_POST["deleteUseSubmit"])) {
            $selected_user = $_POST["user"];
            mysqli_query($conn, "DELETE FROM users WHERE username = '$selected_user'");
        }
    
?>

