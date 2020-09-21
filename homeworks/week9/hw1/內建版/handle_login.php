<?php
    session_start();
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-建立Token
    if(empty($_POST['account']) || empty($_POST['password'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        header('Location: ./index.php?error=4'); // 【帳號密碼有誤，請重新輸入】
        exit();
    }

    $account = $_POST['account'];
    $password = $_POST['password'];
    $sql = sprintf("SELECT * from AKIHA_users where Account = '%s' and Password = '%s';",$account, $password);
    if(!$result = $conn->query($sql)){
            header('Location: ./register.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        if($result->num_rows===0){ // 如果沒找到東西
            header('Location: ./index.php?error=4'); // 【帳號密碼有誤，請重新輸入】
        }
        else{
            $row = $result->fetch_assoc();
            setcookie('loginCount', 1, time() + 3600); // 設定顯示登入成功字樣的判斷參數
            // setcookie('token', createToken($account), time() + 3600); // 設定伺服器派發的Token ->手工版
            $_SESSION['nickname'] = $row['Nickname'];
            echo $_SESSION['nickname'];
            header('Location: ./index.php'); // 登入成功導回頁面
        }
    }
    exit();
?>
