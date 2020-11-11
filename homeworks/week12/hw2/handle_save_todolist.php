<?php
    require_once('./conn.php');
    require_once('./utils.php'); // 客製化函式庫

    // 偵測傳遞的資料是否存在
    if(empty($_GET['data'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        $jsonshell = array(
            'status' => 'error',
            'message' => '資料不齊全',
        );
        $response = json_encode($jsonshell); //轉譯成JSON格式字串
        response ($response); // 將結果回傳給客戶端
        exit();
    }

    $object = json_decode($_GET['data'], true); // 轉換JSON字串成PHP陣列
    $list_id = $object['list-id']; // 清單編號


    // 先清空資料庫內清單編號的所有內容
    $sql = "DELETE FROM AKIHA_todolist where list_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $list_id); // 解決SQL Injection的問題
    if(!$result = $stmt->execute()){
        $jsonshell = array(
            'status' => 'error',
            'message' => '伺服器異常無法刪除資料，請聯絡管理員',
        );
        $response = json_encode($jsonshell); //轉譯成JSON格式字串
        response ($response); // 將結果回傳給客戶端
        exit();
    }

    // 撈取傳入的資料並逐一寫入資料庫內
    foreach($object['itemList'] as $itemlist){
        $is_completed = $itemlist[0]; // 完成狀態
        $item = $itemlist[1]; // 清單項目
        $sql = "INSERT INTO AKIHA_todolist (list_id, item, is_completed) values(?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $list_id, $item, $is_completed); // 解決SQL Injection的問題
        if(!$result = $stmt->execute()){
            $jsonshell = array(
                'status' => 'error',
                'message' => '伺服器異常，請聯絡管理員',
            );
            $response = json_encode($jsonshell); //轉譯成JSON格式字串
            response ($response); // 將結果回傳給客戶端
            exit();
        }
        if($conn->affected_rows === 0){ // 如果新增影響比數為0
            $jsonshell = array(
                'status' => 'error',
                'message' => '資料未更新，請聯絡管理員',
            );
            $response = json_encode($jsonshell); //轉譯成JSON格式字串
            response ($response); // 將結果回傳給客戶端
            exit();
        }
    }
    
    // 若都沒問題則回傳OK
    $jsonshell = array(
        'status' => 'OK',
        'message' => '資料儲存完畢',
    );
    $response = json_encode($jsonshell); //轉譯成JSON格式字串
    response ($response); // 將結果回傳給客戶端
    exit();
?>