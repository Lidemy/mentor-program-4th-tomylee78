<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php');
    if(empty($_POST['content']) || empty($_POST['title']) || empty($_POST['BLOGID']) || empty($_SESSION['account'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        header('Location: ./index.php?error=1'); // 【記得要輸入資料唷!】
        exit();
    }

    $title = $_POST['title'];
    $content = $_POST['content'];
    $BLOGID = $_POST['BLOGID'];

    $sql = "UPDATE AKIHA_blog set Title = ?, Content = ?  where BLOGID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $title, $content, $BLOGID); // 解決SQL Injection的問題

    if(!$result = $stmt->execute()){
        header('Location: ./index.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        if($conn->affected_rows === 0){ // 如果沒找到東西
            //header('Location: ./index.php?error=5'); // 【資料未更新，請聯絡管理員】
            header('Location: ./index.php'); // <-----這裡因為就算沒更新也可以，所以pass
        }
        else{
            header('Location: ./index.php'); // 修改成功導回頁面
        }
    }
    exit();
?>