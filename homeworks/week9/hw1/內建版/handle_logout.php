<?php
    session_start();
    //setcookie('token', '', time() - 1 ); // ��u��
    session_destroy(); // �M��session���
    header('Location: ./index.php');
?>