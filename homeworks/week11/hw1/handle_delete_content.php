<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php');
    if(empty($_POST['CMID'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        header('Location: ./index.php?error=1');
        exit();
    }

    $account = $_POST['account'];
    $CMID = $_POST['CMID'];

    $sql = "UPDATE AKIHA_comment SET IsDeleted = 1 where Account = ? and CMID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $account, $CMID); // 解決SQL Injection的問題

    if(!$result = $stmt->execute()){
        header('Location: ./index.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        if($conn->affected_rows === 0){ // 如果沒找到東西
            header('Location: ./index.php?error=4'); // 【帳號密碼有誤，請重新輸入】
        }
        else{
            header('Location: ./index.php'); // 修改成功導回頁面
        }
    }
    exit();
?>