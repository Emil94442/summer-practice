<?php
    session_start();
    include("./connect/database.php");

    $id = $_GET["id"];
    
    $post = mysqli_query($conn, "SELECT * FROM posts WHERE id = $id");
    $post = mysqli_fetch_array($post, MYSQLI_ASSOC);

    

    $user = mysqli_query($conn, "SELECT * FROM users WHERE id = {$post["user_id"]}");
    $user = mysqli_fetch_assoc($user);

    $login_user = $_SESSION["login_user"] ?? null;

    $getRegisteredUser = null;

    if (isset($login_user)) {
        $getRegisteredUser = mysqli_query($conn, "SELECT * FROM users WHERE id = {$login_user["id"]}");
        $getRegisteredUser = mysqli_fetch_assoc($getRegisteredUser);
    }

    $comments = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = $id");
    $countComments = mysqli_num_rows($comments);


    function timeAgo($datetime) {
        // Преобразуем дату в метку времени Unix
        $commentTime = strtotime($datetime);
        $currentTime = time() + 3600;
    
        $diff = $currentTime - $commentTime;
    
        if ($diff < 1) {
            return "только что";
        } elseif ($diff < 60) {
            return plural_form($diff, 'секунду', 'секунды', 'секунд') . ' назад';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return plural_form($minutes, 'минуту', 'минуты', 'минут') . ' назад';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return plural_form($hours, 'час', 'часа', 'часов') . ' назад';
        } elseif ($diff < 604800) { // до 7 дней
            $days = floor($diff / 86400);
            return plural_form($days, 'день', 'дня', 'дней') . ' назад';
        } elseif ($diff < 2592000) { // до месяца
            $weeks = floor($diff / 604800);
            return plural_form($weeks, 'неделю', 'недели', 'недель') . ' назад';
        } elseif ($diff < 31104000) {
            $months = floor($diff / 2592000);
            return plural_form($months, 'месяц', 'месяца', 'месяцев') . ' назад';
        } else {
            $years = floor($diff / 31104000);
            return plural_form($years, 'год', 'года', 'лет') . ' назад';
        }
    }
    
    
    function plural_form($number, $form1, $form2, $form5) {
        $n = abs($number) % 100;
        $n1 = $n % 10;
    
        if ($n > 10 && $n < 20) return "$number $form5";
        if ($n1 > 1 && $n1 < 5) return "$number $form2";
        if ($form2 == "часа" && $n > 20) return "$number $form2";
        if ($n1 == 1) return "$number $form1";
        return "$number $form5";
    }
    
    
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            padding: 0 7px;
        }

        p {
            font-size: 24px;
        }
        .comment-item-content {
            width: 95%;
            /*border: 2px solid red;*/
        }
        .comment-item-menu {
            /*border: 2px solid red;*/
        }
        .dropdown-item:hover {
            background-color: transparent;
        }

        .update-submit {
            background-color: blue; 
            border: none; 
            color:white; 
            width: 150px; 
            position:relative; 
            right:5px; 
            box-shadow: inset 5px 5px 10px rgba(0, 0, 0, 0.4);
        }

        .update-submit:hover {
            background-color: #389fff;
        }

        .delete-submit {
            background-color: red; 
            border: none; 
            color:white; 
            width: 150px; 
            position:relative; 
            right:5px; 
            box-shadow: inset 5px 5px 10px rgba(0, 0, 0, 0.4);
        }

        .delete-submit:hover {
            background-color: #f97070;
        }

        /* Стиль для затемнения фона */
        .modal {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 10;
    justify-content: center;
    align-items: center;
}


.modal-content {
    background-color: white;
    padding: 20px 20px 30px 20px;
    border: 1px solid #888;
    width: 90%;
    max-width: 400px;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    position: relative;
}



        /* Стиль для кнопки закрытия */
        .close {
            text-align: right;
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

        .info-from-bd {
            text-align: center;
        }

        .arrow-to-back {
            cursor: pointer;
        }

        ul {
            margin-top: 30px;
        }

        @media (max-width: 900px) {
            ul {
                padding-left: 1rem;
            }
        }

        @media (max-width: 530px) {
            ul {
                padding-left: 0.5rem;
            }
        }

        @media (max-width: 380px) {
            ul {
                padding-left: 0rem;
            }
        }

        .comment-button.none {
            background-color:rgba(162, 162, 162, 0.56); 
            border:none; 
            color: black; 
            border-radius: 18px; 
            padding: 5px 10px;
            opacity: 0.7;
            cursor: default;
        }

        .comment-button {
            background-color:rgb(0, 91, 218); 
            color: white; 
            border-radius: 18px; 
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .form-change-comment {
            margin-top: 5px;
        }

        #clickedForm {
            padding: 8px 20px;
            font-size: 16px;
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

   
    <img class="arrow-to-back" src="./imgs/arrow-back.png" alt="" width="60">

    <div class="info-from-bd">
        <p><b>post_id:</b> <?= $post["id"]?></p>
        <p><b>title:</b> <?= $post["title"]?></p>
        <p><b>body:</b> <?= $post["body"]?></p>
        <p><b>Author:</b> <?= $user["username"]?></p>
    </div>
    

    <hr>
    <?php if (isset($login_user)) {?>
        <h2>Добавить коммент</h2>
        <form action="./connect/create-comment.php" method="post">
           <input type="hidden" name="id" value="<?= $id?>">
           <textarea name="body"></textarea><br><br>
           <input type="submit" value="добавить" id="comment-button" class="comment-button none">
        </form><br>
    <hr>
    <?php
    }?>
    
    <?php if ($countComments > 1): ?>
        <h2>Всего <?= $countComments ?> комментариев</h2>
    <?php elseif ($countComments === 1): ?>
        <h2>Всего 1 комментарии</h2>
    <?php else: ?>
        <h2>Комментариев нету</h2>
    <?php endif; ?>

    <ul>
        <?php
          $comments = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = $id");
          while ($comment = mysqli_fetch_assoc($comments)) {
            unset($_POST["id"]);
            $userComment = mysqli_query($conn, "SELECT * FROM users WHERE id = {$comment["user_id"]}");
            $userComment = mysqli_fetch_assoc($userComment);

            $isChanged = $comment["changed"];
    

            ?>
            <li style="border-bottom: 2px solid black; margin-top: 20px; display:flex; justify-content: space-between; width:97%; align-items: center; padding-bottom: 10px;">
                <div class="comment-item-content">
                    <h3><?= $userComment["username"]?> ' <div style="display: inline; font-weight:500; font-size: 18px; color:#717171"><?= timeAgo($comment["date_action"]); ?></div> <?php if ($isChanged == "true") {?>
                       <i style="font-size: 18px;">(edited)</i>
                    <?php
                }?></h3><?= $comment["body"]?>
                </div>

                <?php 
                if (isset($login_user)) {?>
                    <?php if ($login_user["id"] == $comment["user_id"] || $getRegisteredUser["role"] == "Создатель" || $getRegisteredUser["id"] == $user["id"]) {?>
                    <div class="comment-item-menu">
                      <div class="btn-group dropup">
                        <button style="margin-right: 10px;" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          
                        </button>
                        <ul style="background: #717171;" class="dropdown-menu">
                            <li>
                                <a class="dropdown-item">
                                    <button class="update-submit" onclick="openModal(<?= $comment['id'] ?>)" id="updateComModal">Обновления</button>
                                    <!--<input class="update-submit" id="updateComModal" type="submit" value="Обновления">-->
                                </a>
                                
                            </li>
                            <li>
                               <form action="./connect/delete-comment.php" method="post">
                                <a class="dropdown-item">
                                    <input type="hidden" name="id" value="<?= $comment["id"]?>">
                                    <input type="hidden" name="post_id" value="<?= $id?>">
                                    <input class="delete-submit" name="delete" type="submit" value="Удалить">
                                </a>
                                </form>
                            </li>
                        </ul>
                     </div>
                   </div>
                <?php
                }?>
                <?php
                }?>
                
               
                
                    <!-- Модальное окно -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form action="./connect/update-comment.php" method="post" class="form-change-comment">
            <h2>Изменить коммент</h2><br>
            body:
            <!-- Поле для скрытого ID комментария -->
            <input type="hidden" name="id" id="comment-id">
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($id) ?>">
            <input type="text" name="body" id="body"><br><br>
            <input style="margin-top: 10px;" name="update" type="submit" value="обновить" id="clickedForm">
        </form>
    </div>
</div>
                
            </li>
        <?php
        }?>
    </ul>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script>

    const comment_button = document.getElementById("comment-button")
    if (comment_button) {
        comment_button.disabled = true
    }
    

    const textArea = document.querySelector("textarea[name='body']")
    const modals = document.querySelector(".modal")

    console.log(modals)
    
    window.addEventListener("mousedown", (e) => {
        if (e.target == modals) {
            modals.style.display = "none"
        }
    })

    if (textArea) {
        textArea.addEventListener("input", function () {
            if (textArea.value == "") {
                comment_button.disabled = true;
                comment_button.classList.add("none")
            } else {
                comment_button.disabled = false;
                comment_button.classList.remove("none")
            }
        });

        console.log(textArea.value)
    }

    

    function openModal(commentId) {
    document.getElementById('comment-id').value = commentId; // Устанавливаем ID комментария
    document.getElementById('myModal').style.display = 'flex'; // Показываем модальное окно
}

// Закрытие модального окна
function closeModal() {
    document.getElementById('myModal').style.display = 'none'; // Скрываем модальное окно
}

const arrowToBack = document.querySelector(".arrow-to-back")

arrowToBack.addEventListener("click", () => {
    document.location.href = "./";
})

</script>
</body>
</html>
