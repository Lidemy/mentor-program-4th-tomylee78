<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-偵測錯誤代碼
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>誰的部落格</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--RWD-->
        <meta name="description" content="輕鬆自在紀錄自己的生活點滴">
        <meta name="author" content="AKIHA">
        <link rel="stylesheet" href="./normalize.css">
        <link rel="stylesheet" href="./style.css">        
        <!--<script src="./index.js"></script>-->
    </head>
    <body>
        <nav class="navbar"> <!--帳號登入-->
            <div class="navbar-left">
                <strong class="navbar-left__title" ><a href="./index.php">Who's Blog</a></strong>
                <a class="navbar-left__list" href="./index_all.php">文章列表</a>
                <a class="navbar-left__list">分類專區</a>
                <a class="navbar-left__list">關於我</a>
            </div>
            <div class="navbar-right">
                <?PHP
                if(!empty($account)){ // 如果有登入資料
                ?>
                <a class="navbar-right__list" href="./admin.php">管理後臺</a>
                <a class="navbar-right__list" href="./post_blog.php">發表文章</a>
                <a class="navbar-right__list" href="handle_logout.php">登出</a>
                <?PHP
                } else {
                ?>
                <a class="navbar-right__list" href="./login.php">登入</a>
                <?PHP
                }
                ?>
            </div>
        </nav>
        <main class="BG">
            <section class="welcom-image">
                <strong class="welcom-image__title">存放技術之地</strong>
                <p class="subtitle">Welcome to my blog</p>
            </section>
            <section class="wrapper login-wrapper">
                <div class="blog-login">
                    <div class="blog-login__title">登入頁面</div>
                    <form method="post" action="./handle_login.php">
                        <p class="blog-login__info">帳號</p>
                        <input class="blog-login__input" name="account" />
                        <p class="blog-login__info">密碼</p>
                        <input class="blog-login__input" type="password" name="password" />
                        <input type="submit" class="blog-login__post" value="登入" />
                    </form>
                    <?PHP
                    if(!empty($_GET['error'])) { // 先判斷是否有回傳參數
                        echo checkCode($_GET['error']);
                    }
                    ?>
                </div>
            </section>
        </main>
        <footer class="footer__bottom">
            Copyright © 2020 Who's Blog All Rights Reserved.
        </footer>
    </body>
</html>