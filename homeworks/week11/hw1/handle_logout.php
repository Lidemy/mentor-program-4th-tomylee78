<?php
    session_start();
    session_destroy(); // 清除session資料
    header('Location: ./index.php');
?>