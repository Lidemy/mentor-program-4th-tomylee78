<?php
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-偵測錯誤代碼
    $resault = $conn->query('SELECT * FROM AKIHA_comment ORDER BY CMID DESC;');
    if(!empty($_COOKIE['token'])){ // 如果有登入資料
        $token =  $_COOKIE['token'];
        $userInfo = NULL; // 儲存查詢到的使用者資料
        if(getUserInfoByToken($token)){
            $userInfo = getUserInfoByToken($token)->fetch_assoc();
        }
        //print_r($userInfo['Account']);
    }
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
                if(!empty($userInfo)){ // 如果有登入資料
            ?>
                    <form method="post" action="./handle_logout.php">
                        <input class="logout" type="submit" value="登出" />
                    </form>
            <?PHP
                } else {
            ?> 
                <form method="post" action="./handle_login.php">
                    <input type="text" name="account" placeholder="帳號" />
                    <input type="password" name="password" placeholder="密碼" />
                    <input type="submit" value="登入" />
                    <a href="./register.php">註冊</a>
                </form>
            <?PHP
                }
            ?>
        </nav>
        <main class="BG">
            <?PHP
            if(!empty($_GET['register'])) { // 先判斷是否有回傳參數
                echo checkCode($_GET['register']); // 成功就顯示註冊成功
            }
            ?>            
            <img src="./202006Event.gif"/>
            <h1>看口雷2020夏活甲章留言板</h1>
            <section class="comment-input">
                <?PHP
                    if(!empty($userInfo)){ // 如果有登入資料
                ?>
                        <form method="post" action="./handle_add_post.php">
                            <input type="text" name="nickname" placeholder="暱稱" value="<?PHP echo $userInfo['Nickname'] ?>" />
                            <textarea name="content" placeholder="想說些什麼呢..."></textarea>
                            <input type="submit" value="留言" />
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
                <?php
                    while($row = $resault->fetch_assoc()){
                ?>
                <div class="message-box">
                    <div class="message-box__avatar"></div>
                    <div class="message-box__content">
                        <div class="message-box__content__title">
                            <?php echo $row['Nickname'] ?>
                            <span>
                                <?php echo $row['Create_at'] ?>
                            </span>
                        </div>
                        <p><?php echo $row['Content'] ?></p>
                    </div>
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