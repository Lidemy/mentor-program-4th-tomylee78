<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-建立Token
    if(empty($_POST['account']) || empty($_POST['password'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        header('Location: ./login.php?error=4'); // 【帳號密碼有誤，請重新輸入】
        exit();
    }

    $account = $_POST['account'];
    $password = $_POST['password'];
    $sql = "SELECT * from AKIHA_blog_users where Account = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $account); // 解決SQL Injection的問題
    $result = getSQLData($stmt);

    if($result === false){
        header('Location: ./login.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        if($result===0){ // 如果沒找到東西
            header('Location: ./login.php?error=4'); // 【帳號密碼有誤，請重新輸入】
        }
        else{
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['Password'])){
                $_SESSION['account'] = $account;
                header('Location: ./index.php'); // 登入成功導回頁面
            }
        }
    }

    exit();
?>
