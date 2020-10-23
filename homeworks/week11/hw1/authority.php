<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-偵測錯誤代碼

    // 先確認使用者身分
    $account = $_SESSION['account'];

    $sql = 'SELECT * FROM AKIHA_users WHERE Account = ? and Authority = 1;';
    $stmt = $conn->prepare($sql);    
    $stmt->bind_param('s', $_SESSION['account']); // 解決SQL Injection的問題
    $result = getSQLData($stmt); // 取得資料
    if($result === false || $result === 0){
        header('Location: ./index.php?error=4'); // 【帳號密碼有誤，請重新輸入】
    } 

    $sql = 'SELECT * FROM AKIHA_users;';
    $stmt = $conn->prepare($sql);
    $resault = getSQLData($stmt); // 取得資料
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>看口雷留言板-權限管理</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--RWD-->
        <meta name="description" content="給熱愛看口雷的提督留言討論的地方">
        <meta name="author" content="AKIHA">
        <link rel="stylesheet" href="./normalize.css">
        <link rel="stylesheet" href="./style.css">
        <script src="./authority.js"></script>
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
            <h1>看口雷留言板-權限管理</h1>
            <section class="comment-input">
                 <?php
                    while($row = $resault->fetch_assoc()){
                        $authority = $row['Authority']; // 暫存該名使用者的權限
                 ?>
                        <div class="info-box">
                            <label class="info-box__title">帳號：<span><?PHP echo escape($row['Account']) ?></span></label>
                            <div class="info-box__content-box">
                                <p class="info-box__content">
                                    權限：
                                    <?PHP 
                                       if($authority===1){
                                           echo '管理員';
                                       }else if($authority===2){
                                           echo '路人';

                                       }else if($authority===3){
                                           echo '水桶仔';
                                       }
                                   ?>                                    
                                </p>
                                <button class="edit">編輯</button>
                            </div>
                            <div class="info-box__content-box hide">
                                <select class="select-authority">
                                    <option value="1" <?PHP $authority === 1 ? print_r ('selected') : '';?>>管理員</option>
                                    <option value="2" <?PHP $authority === 2 ? print_r ('selected') : '';?>>路人</option>
                                    <option value="3" <?PHP $authority === 3 ? print_r ('selected') : '';?>>水桶仔</option>
                                </select>
                                <div class="cancle authority">取消</div>
                                <div class="submit authority">提交</div>
                            </div>
                            <div class="error hide">記得要輸入資料唷~</div>
                            <?PHP
                                if(!empty($_GET['error'])) { // 先判斷是否有回傳參數
                                    echo checkCode($_GET['error']);
                                }
                            ?>
                        </div>
                <?php
                    }
                ?>
            </section>
        </main>
        <footer class="footer__bottom">
            Copyright © 2020 看口雷 All Rights Reserved. 版權所有。賣勾靠北！
        </footer>
    </body>
</html>