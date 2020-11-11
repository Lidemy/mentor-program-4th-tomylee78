<?php
    require_once('./conn.php');
    require_once('./utils.php'); // 客製化函式庫

    // 偵測傳遞留言板金鑰、暱稱以及內容
    if(empty($_POST['siteKey']) || empty($_POST['nickname']) || empty($_POST['content']) ){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        $jsonshell = array(
            'status' => 'error',
            'message' => '資料不齊全',
        );
        $response = json_encode($jsonshell); //轉譯成JSON格式字串
        response($response); // 將結果回傳給客戶端
        exit();
    }

    $site_key = $_POST['siteKey']; // 來源留言板金鑰
    $nickname = $_POST['nickname']; // 暱稱
    $content = $_POST['content']; // 內容
    $sql = "INSERT INTO AKIHA_api_comment (site_key, nickname, content) values(?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $site_key, $nickname, $content); // 解決SQL Injection的問題


    if(!$result = $stmt->execute()){
        $jsonshell = array(
            'status' => 'error',
            'message' => '伺服器異常，請聯絡管理員',
        );
        response($jsonshell); // 將結果回傳給客戶端
    } else {
        if($conn->affected_rows === 0){ // 如果沒找到東西
            $jsonshell = array(
                'status' => 'error',
                'message' => '資料未更新，請聯絡管理員',
            );
            $response = json_encode($jsonshell); //轉譯成JSON格式字串
            response($response); // 將結果回傳給客戶端
            exit();
        }
        else{
            $jsonshell = array(
                'status' => 'OK',
                'message' => '新增成功',
            );
            $response = json_encode($jsonshell); //轉譯成JSON格式字串
            response ($response); // 將結果回傳給客戶端
            exit();
        }
    }
    exit();
?>