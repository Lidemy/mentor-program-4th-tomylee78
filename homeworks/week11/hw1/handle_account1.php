<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php');
    if(empty($_POST['nickname'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        header('Location: ./account.php?error=1');
        exit();
    }

    $account = $_SESSION['account'];
    $nickname = $_POST['nickname'];
    $sql = "UPDATE AKIHA_users set Nickname = ? where Account = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nickname, $account); // 解決SQL Injection的問題

    if(!$result = $stmt->execute()){
        header('Location: ./account.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        if($conn->affected_rows === 0){ // 如果沒找到東西
            header('Location: ./account.php?error=4'); // 【帳號密碼有誤，請重新輸入】
        }
        else{
            $_SESSION['nickname'] = $nickname;
            header('Location: ./account.php'); // 修改成功導回頁面
        }
    }
    exit();
?>