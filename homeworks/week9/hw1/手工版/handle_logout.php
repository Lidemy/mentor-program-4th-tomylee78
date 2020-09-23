<?php
    setcookie('token', '', time() - 1 );
    header('Location: ./index.php');
?>