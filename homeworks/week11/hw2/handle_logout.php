<?php
    session_start();
    session_destroy(); // �M��session���
    header('Location: ./index.php');
?>