<?php
    function checkCode($Code){ // 狀態代碼傳遞
        switch ($Code){
            case '1':
                return '<div class="error" >記得要輸入資料唷~</div>';
                break;
            case '2':
                return '<div class="error" >伺服器錯誤，請聯絡管理員檢查伺服器</div>';
                break;
            case '3':
                return '<div class="error" >帳號重複囉！請換其他帳號試試</div>';
                break;
            case '4':
                return '<div class="error" >帳號密碼有誤，請重新輸入</div>';
                break;
            case '5':
                return '<div class="error" >資料未更新，請聯絡管理員</div>';
                break;
            case 'OK':
                return '<strong>帳號註冊成功!</strong>';
                break;
        }
    }

    function createToken($account){ // 建立暫存在資料庫的Token(舊版)
        global $conn;
        $token = null;
        for($i = 0; $i<30; $i += 1){
            $token .= chr(rand(65, 90));  // 產生Token
        }
        $conn->prepare("SET SQL_SAFE_UPDATES = 0;")->execute(); // 關閉保護機制
        $sql = "DELETE from AKIHA_token where Account = ?;"; // 先刪除資料表內的Token確保新增不會異常
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $account);
        if($delete_result = $stmt->execute()){
            $conn->prepare("SET SQL_SAFE_UPDATES = 1;")->execute(); // 開啟保護機制
            $sql = "INSERT INTO AKIHA_token (Account, Token) values(?, ?);"; // 新增Token
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $account, $token);
            if($insert_result = $stmt->execute()){
                return $token;
            }
            else{
                header('Location: ./register.php?error=2'); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
            }
        }
    }

    function getUserInfoByToken($token){ // 透過Token取得使用者資訊(舊版)
        global $conn;
        $sql = "
            SELECT * FROM AKIHA_users
            LEFT JOIN AKIHA_token
            ON AKIHA_users.Account = AKIHA_token.Account
            where AKIHA_token.Token = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $token);
        if($result = $stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows===0){ // 如果沒找到東西
                return 0;
            }
            return $result; // 將查詢結果回傳
        }
        return 0; // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    }

    function escape($str){ // 轉換html文字
        return htmlspecialchars($str ,ENT_QUOTES);
    }

    function getSQLData($stmt){ // 取得資料庫內的實體資料
        if($result = $stmt->execute()){
            $result = $stmt->get_result(); // 真正取得回傳結果
            if(!($result->num_rows===0)){ // 有東西
                return $result;
            }
            return 0; // 如果找不到東西
        }
        return false; // 資料庫異常
    }
?>