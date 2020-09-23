<?php
    require_once('./conn.php');    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>看口雷留言板-帳號註冊</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--RWD-->
        <meta name="description" content="給熱愛看口雷的提督留言討論的地方">
        <meta name="author" content="AKIHA">
        <link rel="stylesheet" href="./normalize.css">
        <link rel="stylesheet" href="./style.css">        
    </head>
    <body>
        <nav class="sign-in">
            <form method="get">
                <a href="./index.php">回到留言板</a>
            </form>
            
        </nav>
        <main class="BG">            
            <img src="./202006Event.gif"/>
            <h1>看口雷留言板-帳號註冊</h1>
            <section class="comment-input">
                <form method="post" action="./handle_register.php">
                    <input type="text" name="account" data-value="register" placeholder="請輸入註冊帳號" />
                    <input type="password" name="password" data-value="register" placeholder="請輸入註冊密碼" />
                    <input type="text" name="nickname" placeholder="請輸入留言板使用暱稱" />
                    <input type="submit" value="註冊" />
                    <?PHP
                        if(!empty($_GET['error'])) { // 先判斷是否有回傳參數
                            switch ($_GET['error']){
                                case '1':
                                    echo '<div class="error" >記得要輸入資料唷~</div>';
                                    break;
                                case '2':
                                    echo '<div class="error" >留言發送有誤，請聯絡管理員檢查伺服器</div>';
                                    break;
                                case '3':
                                    echo '<div class="error" >帳號重複囉！請換其他帳號試試</div>';
                                    break;
                            }
                        }
                    ?>
                </form>
            </section>
        </main>
        <footer class="footer__bottom">
            Copyright © 2020 看口雷 All Rights Reserved. 版權所有。賣勾靠北！
        </footer>
    </body>
</html>