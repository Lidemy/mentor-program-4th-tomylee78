<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-偵測錯誤代碼

    if(!empty($_SESSION['account'])){ // 如果有登入資料
        $account = $_SESSION['account'];
    } else{
        header('Location: ./index.php?error=4'); // 【帳號密碼有誤，請重新輸入】
    }
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
            <section class="wrapper">
                <div class="blog-edit">
                    <div class="blog-edit__title-info">發表文章：</div>
                    <form method="post" action="./handle_add_post.php">
                        
                        <input class="blog-edit__title" name="title" placeholder="請輸入文章標題" />
                        <textarea class="blog-edit__edit-box" name="content"></textarea>
                        <input type="submit" class="blog-edit__post" value="送出文章" />
                    </form>
                </div>
                <?PHP
                if(!empty($_GET['error'])) { // 先判斷是否有回傳參數
                    echo checkCode($_GET['error']);
                }
                ?>
            </section>
        </main>
        <footer class="footer__bottom">
            Copyright © 2020 Who's Blog All Rights Reserved.
        </footer>
    </body>
</html>