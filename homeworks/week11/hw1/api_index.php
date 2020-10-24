<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-偵測錯誤代碼

    // 先取得留言總比數

    $sql = 'SELECT COUNT(Content) as Count  FROM AKIHA_comment WHERE IsDeleted = 0;';
    $stmt = $conn->prepare($sql);
    $result = getSQLData($stmt); // 取得資料
    if($result === false || $result === 0){
        header('Location: ./index.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        $row = $result->fetch_assoc();
        $count = $row['Count']; // 總留言數
    }
    
    $pageLimit = 5; // 每頁顯示筆數
    if($count % $pageLimit === 0){
        $allPage = intval($count / $pageLimit); // 總留言頁面數
    } else {
        $allPage = intval($count / $pageLimit) + 1; // 總留言頁面數
    }
    empty($_GET['page']) ? $page = 0 : $page = intval($_GET['page'] - 1); // 設定第幾頁
    $displayPage = $page + 1;
    $page = $page * $pageLimit;

    $sql = 'SELECT CMID, AKIHA_users.Account, Nickname, Content, AKIHA_comment.Create_at  FROM AKIHA_comment
            LEFT JOIN AKIHA_users
            ON AKIHA_users.Account = AKIHA_comment.Account
            WHERE IsDeleted = 0
            ORDER BY CMID DESC
            LIMIT ? OFFSET ?;';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $pageLimit, $page); // 解決SQL Injection的問題
    $resault = getSQLData($stmt); // 取得資料
    if(!empty($_SESSION['nickname'])){ // 如果有登入資料
        $nickname = $_SESSION['nickname'];
        $account = $_SESSION['account'];
    }

    // api測試用
    $nickname = '秋葉';
    $account = 'akiha';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>看口雷留言板</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--RWD-->
        <meta name="description" content="給熱愛看口雷的提督留言討論的地方">
        <meta name="author" content="AKIHA">
        <link rel="stylesheet" href="./normalize.css">
        <link rel="stylesheet" href="./style.css">        
        <script src="./index.js"></script>
        <script src="./api_index.js"></script>
    </head>
    <body>
        <nav class="sign-in">
            <?PHP
                if(!empty($_COOKIE['loginCount'])){ // 顯示登入成功的效果
                    echo '<div class="logined">歡迎登入</div>';
                    setcookie('loginCount', '', time() - 1 );
                }
            ?>
            <?PHP
                if(!empty($nickname)){ // 如果有登入資料
            ?>
                <form method="post" action="./account.php">
                    <div class="login-button">
                        <input type="submit" value="帳號資料" />
                        <a href="./handle_logout.php">登出</a>
                    </div>
                </form>
            <?PHP
                } else {
            ?> 
                <form method="post" action="./handle_login.php">
                    <div class="login-text">
                        <input type="text" name="account" placeholder="帳號" />
                        <input type="password" name="password" placeholder="密碼" />
                    </div>
                    <div class="login-button">
                        <input type="submit" value="登入" />
                        <a href="./register.php">註冊</a>
                    </div>
                </form>
            <?PHP
                }
            ?>
        </nav>
        <main class="BG">
            <?PHP
                if(!empty($_COOKIE['register'])){ // 顯示登入成功的效果
                    echo '<div class="register">帳號註冊成功!</div>';
                    setcookie('register', '', time() - 1 );
                }
            ?>            
            <img src="./202006Event.gif"/>
            <h1>看口雷2020夏活甲章留言板</h1>
            <section class="comment-input">
                <?PHP
                    if(!empty($nickname)){ // 如果有登入資料
                ?>      
                        <div class="comment-input__info">
                            <h2>HIHI~ <span class="nickname"><?PHP echo escape($nickname) ?></span></h2>
                            <label class="point">來留言吧!</label>
                        </div>
                        <form method="post" action="./handle_add_post.php">
                            <textarea name="content" placeholder="想說些什麼呢..."></textarea>
                            <input type="submit" value="留言" data-value="post" />
                            <?PHP
                                if(!empty($_GET['error'])) { // 先判斷是否有回傳參數
                                    echo checkCode($_GET['error']);
                                }
                            ?>
                        </form>
                <?PHP
                    } else {
                        if(!empty($_GET['error'])) { // 先判斷是否有回傳參數
                            echo checkCode($_GET['error']);
                        }
                ?>
                        <strong>登入帳號一起討論吧！</strong>
                <?PHP
                    }
                ?>
            </section>
            <section class="comment-output">
            </section>            
            <section class="page-bar">
                <p class="page-info"><?PHP echo $allPage ?> 頁  共 <?PHP echo $count ?> 筆留言 </p>
                <div class="page-box">
                    <a class="page-button" href="./index.php"><<</a>
                    <a class="page-button" href="./index.php<?PHP $displayPage === 1 ? '' : print_r('?page=' . ($displayPage - 1) ); ?>"><</a>
                    <a class="page-button" href="./index.php<?PHP echo ('?page=' . $displayPage); ?>"><?PHP echo ($displayPage); ?></a>
                    <a class="page-button" href="./index.php<?PHP $displayPage === $allPage ? print_r('?page=' . $displayPage ) : print_r('?page=' . ($displayPage + 1) ); ?>">></a>
                    <a class="page-button" href="./index.php<?PHP echo ('?page=' . $allPage); ?>">>></a>
                </div>
            </section>
        </main>
        <footer class="footer__bottom">
            Copyright © 2020 看口雷 All Rights Reserved. 版權所有。賣勾靠北！
        </footer>
    </body>
</html>
