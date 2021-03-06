<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-偵測錯誤代碼    

    $sql = 'SELECT * from AKIHA_blog
            WHERE IsDeleted = 0
            ORDER BY BLOGID DESC
            LIMIT 5;';
    $stmt = $conn->prepare($sql);
    $resault = getSQLData($stmt); // 取得資料

    if(!empty($_SESSION['account'])){ // 如果有登入資料
        $account = $_SESSION['account'];
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
                if(!empty($_GET['error'])) { // 先判斷是否有回傳參數
                    echo checkCode($_GET['error']);
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
                <?php
                while($row = $resault->fetch_assoc()){
                ?>
                    <div class="blog-box">
                        <div class="blog-box__title-box">
                            <div class="blog-box__title"><?php echo escape($row['Title']) ?></div>
                            <?PHP
                            if(!empty($account)){ // 如果有登入資料
                            ?>
                                <form class="blog-box__edit-form" method="post" action="./edit_blog.php">
                                    <input type="hidden" name="BLOGID" value="<?php echo escape($row['BLOGID']) ?>" />
                                    <input type="submit" class="blog-box__edit" value="編輯" />
                                </form>
                                <form class="blog-box__delete-form" method="post" action="./handle_delete_blog.php">
                                    <input type="hidden" name="BLOGID" value="<?php echo escape($row['BLOGID']) ?>" />
                                    <input type="submit" class="blog-box__delete" value="刪除" />
                                </form>
                            <?PHP
                            }
                            ?>
                        </div>
                        <div class="blog-box__info">
                            <img class="img-icon-clock" src="./watch-later-24-px.png" />
                            <p class="blog-box__info__content"><?php echo escape($row['Create_at']) ?></p>
                            <img class="img-icon-file" src="./folder-24-px.png" />
                            <p>歷史公告</p>
                        </div>
                        <p class="blog-box__preview"><?php echo escape($row['Content']) ?></p>
                        <form class="blog-box__readme-form" method="post" action="./read_blog.php">
                            <input type="hidden" name="BLOGID" value="<?php echo escape($row['BLOGID']) ?>" />
                            <input type="submit" class="blog-box__readme" value="READ MORE" />
                        </form>
                    </div>
                <?PHP
                }
                ?>

            </section>

        </main>
        <footer class="footer__bottom">
            Copyright © 2020 Who's Blog All Rights Reserved.
        </footer>
    </body>
</html>