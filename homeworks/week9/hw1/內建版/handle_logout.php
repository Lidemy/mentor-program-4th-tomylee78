<?php
    session_start();
    //setcookie('token', '', time() - 1 ); // 手工版
    session_destroy(); // 清除session資料
    header('Location: ./index.php');
?>