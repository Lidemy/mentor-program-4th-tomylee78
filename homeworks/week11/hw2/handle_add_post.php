<?php
    session_start();
    require_once('./conn.php');
    if(empty($_SESSION['account']) || empty($_POST['title']) || empty($_POST['content'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        header('Location: ./index.php?error=1');
        exit();
    }

    $account = $_SESSION['account'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = "INSERT INTO AKIHA_blog (Account, Title, Content) values(?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $account, $title, $content); // 解決SQL Injection的問題


    if(!$result = $stmt->execute()){
        header('Location: ./post_blog.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        if($conn->affected_rows === 0){ // 如果沒找到東西
            header('Location: ./post_blog.php?error=5'); // 【資料未更新，請聯絡管理員】
        }
        else{
            header('Location: ./index.php'); // 修改成功導回頁面
        }
    }
    exit();
?>