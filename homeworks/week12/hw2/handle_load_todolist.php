<?php
    require_once('./conn.php');
    require_once('./utils.php'); // 客製化函式庫

    // 偵測傳遞的清單編號
    if(empty($_GET['list-id']) ){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        $jsonshell = array(
            'status' => 'error',
            'message' => '資料不齊全',
        );
        $response = json_encode($jsonshell); //轉譯成JSON格式字串
        response ($response); // 將結果回傳給客戶端
        exit();
    }

    $itemList = array(); // 擺放待辦清單項目
    $list_id = $_GET['list-id']; // 清單編號

    $sql = "SELECT * FROM AKIHA_todolist WHERE list_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $list_id); // 解決SQL Injection的問題
    $result = getSQLData($stmt); // 取得資料

    // 如果查無訊息
    if($result === 0){
        $jsonshell = array(
            'status' => 'error',
            'message' => '查無訊息，請確認清單編號是否正確',
        );
        $response = json_encode($jsonshell); //轉譯成JSON格式字串
        response ($response); // 將結果回傳給客戶端
        exit();
    }

    // 將資料放入陣列中
    while($row = $result->fetch_assoc()){
        array_push($itemList, array( // 以陣列的型式存入
            'status' => $row['is_completed'], // 項目狀態
            'item' => $row['item'], // 項目本體
        ));
    }

    $jsonshell = array(
        'itemList'=> $itemList, // 所有待辦項目
    );
    $response = json_encode($jsonshell); //轉譯成JSON格式字串
    response ($response); // 將結果回傳給客戶端
    exit();
?>

