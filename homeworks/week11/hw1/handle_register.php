<?php
    require_once('./conn.php');
    if(empty($_POST['account']) || empty($_POST['password']) || empty($_POST['nickname'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        header('Location: ./register.php?error=1'); // 【記得要輸入資料唷】
        exit();
    }

    $account = $_POST['account'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $nickname = $_POST['nickname'];
    $sql = "INSERT INTO AKIHA_users (Account, Password, Nickname) values(?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $account, $password, $nickname); // 解決SQL Injection的問題
    if(!$result = $stmt->execute()){
        if($conn->errno === 1062){ // 當錯誤代碼1062時，代表要新增的資料與原資料庫內的資料重複了
            header('Location: ./register.php?error=3'); // 【帳號重複囉！請換其他帳號試試】
        } else{
            header('Location: ./register.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
        }
    } else {
        setcookie('register', 1, time() + 3600); // 設定顯示註冊成功字樣的判斷參數
        header('Location: ./index.php'); // 【帳號註冊成功!】
    }
    exit();
?>