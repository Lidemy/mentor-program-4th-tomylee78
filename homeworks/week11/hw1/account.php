<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-偵測錯誤代碼
    $sql = "SELECT * from AKIHA_users where Account = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_SESSION['account']); // 解決SQL Injection的問題
    $result = getSQLData($stmt);
    if($result === false){
        header('Location: ./index.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        if($result===0){ // 如果沒找到東西
            header('Location: ./index.php?error=4'); // 【帳號密碼有誤，請重新輸入】
        }
        else{
            $row = $result->fetch_assoc();
            $account = $row['Account'];
            $nickname = $row['Nickname'];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>看口雷留言板-帳號資料</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--RWD-->
        <meta name="description" content="給熱愛看口雷的提督留言討論的地方">
        <meta name="author" content="AKIHA">
        <link rel="stylesheet" href="./normalize.css">
        <link rel="stylesheet" href="./style.css">
        <script src="./account.js"></script>
    </head>
    <body>
        <nav class="sign-in">
            <form method="get">
                <div class="login-button">
                    <a href="./index.php">回到留言板</a>
                </div>
            </form>
        </nav>
        <main class="BG">            
            <img src="./202006Event.gif"/>
            <h1>看口雷留言板-帳號資料</h1>
            <section class="comment-input">
                <div class="info-box">
                    <label class="info-box__title">帳號</label>
                    <div class="info-box__content-box">
                        <p class="info-box__content"><?PHP echo escape($account) ?></p>
                    </div>
                </div>
                <div class="info-box">
                    <label class="info-box__title">暱稱</label>
                    <div class="info-box__content-box">
                        <p class="info-box__content">
                            <?PHP echo escape($nickname) ?>
                        </p>
                        <button class="edit">編輯</button>
                    </div>
                    <div class="info-box__content-box hide">
                        <form class="info-box__content-box__form" method="post" action="./handle_account1.php">
                            <input type="text" name="nickname" value="<?PHP echo escape($nickname) ?>" />
                            <div class="cancle">取消</div>
                            <input class="submit" type="submit" />
                        </form>
                    </div>
                    <div class="error hide">記得要輸入資料唷~</div>
                    <?PHP
                    if(!empty($_GET['error'])) { // 先判斷是否有回傳參數
                        echo checkCode($_GET['error']);
                    }
                    ?>
                </div>
                <div class="info-box">
                    <label class="info-box__title">密碼</label>
                    <div class="info-box__content-box">
                        <button class="edit" >修改</button>
                    </div>
                    <div class="info-box__content-box hide">
                        <form class="info-box__content-box__form" method="post" action="./handle_account2.php">
                            <input type="password" name="password" />
                            <div class="cancle">取消</div>
                            <input class="submit" type="submit" />
                        </form>
                    </div>
                    <div class="error hide">記得要輸入資料唷~</div>
                    <?PHP
                    if(!empty($_GET['error'])) { // 先判斷是否有回傳參數
                        echo checkCode($_GET['error']);
                    }
                    ?>
                </div>
            </section>
        </main>
        <footer class="footer__bottom">
            Copyright © 2020 看口雷 All Rights Reserved. 版權所有。賣勾靠北！
        </footer>
    </body>
</html>