<?php
    require_once('./conn.php');
    header('Content-Type: application/json; charset=utf-8'); // 避免編碼錯誤
    $jsonshell = array(); // 預計要回傳的JSON陣列

    if(empty($_POST['content']) || empty($_POST['account']) ){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        array_push($jsonshell, array(
            'status' => 'error',
            'message' => '資料不齊全',
        ));
        $response = json_encode($jsonshell); //轉譯成JSON格式字串
        echo $response;
        exit();
    }

    $account = $_POST['account'];
    $content = $_POST['content'];
    $sql = "INSERT INTO AKIHA_comment (Account, Content) values(?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $account, $content); // 解決SQL Injection的問題


    if(!$result = $stmt->execute()){
        array_push($jsonshell, array(
            'status' => 'error',
            'message' => '伺服器異常，請聯絡管理員',
        ));
    } else {
        if($conn->affected_rows === 0){ // 如果沒找到東西
            array_push($jsonshell, array(
                'status' => 'error',
                'message' => '資料未更新，請聯絡管理員',
            ));
        }
        else{
            array_push($jsonshell, array(
            'status' => 'Ok',
            'message' => '新增成功',
        ));
        }
    }

    $response = json_encode($jsonshell); //轉譯成JSON格式字串
    echo $response;
    exit();
?>