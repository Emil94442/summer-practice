<?php
    try {
        $conn = mysqli_connect("localhost:3311", "root", "", "forum_app");
    } catch (mysqli_sql_exception) {
        echo "Could'nt connect!";
    }
?>