<?php
    require_once('./conn.php');
    require_once('./utils.php'); // 客製化函式庫

    $comment = array(); // 放留言內容

    // 偵測傳遞留言板金鑰以及要顯示的留言數
    if(empty($_GET['siteKey']) || empty($_GET['limit']) ){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        $jsonshell = array(
            'status' => 'error',
            'message' => '資料不齊全',
        );
        $response = json_encode($jsonshell); //轉譯成JSON格式字串
        response ($response); // 將結果回傳給客戶端
        exit();
    }


    // 撈取資料庫資料
    // 撈取總留言數
    $sql = 'SELECT COUNT(Content) as Count FROM AKIHA_api_comment;';
    $stmt = $conn->prepare($sql);
    $result = getSQLData($stmt); // 取得資料
    if($result === false || $result === 0){
        exit('GG' . $conn->error); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        $row = $result->fetch_assoc();
        $count = $row['Count']; // 總留言數
    }

    // 撈取留言內容
    $pageLimit = $_GET['limit']; // 每頁顯示筆數
    $site_key = $_GET['siteKey']; // 來源留言板金鑰

    $sql = 'SELECT * FROM AKIHA_api_comment
            WHERE site_key = ?
            ORDER BY CMID DESC
            LIMIT ?;';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $site_key, $pageLimit); // 解決SQL Injection的問題
    $resault = getSQLData($stmt); // 取得資料

    // 如果查無訊息 (本次暫且不使用)
    if($resault === 0){
        $jsonshell = array(
            'status' => 'error',
            'message' => '查無訊息，可能是新的留言板，請檢查留言板金鑰是否正確',
        );
        $response = json_encode($jsonshell); //轉譯成JSON格式字串
        response ($response); // 將結果回傳給客戶端
        exit();
    }

    // 將資料放入陣列中
    while($row = $resault->fetch_assoc()){
        array_push($comment, array( // 以陣列的型式存入
            'ID'=> $row['CMID'], // 留言編號
            'nickname' => $row['nickname'], // 留言暱稱
            'content' => $row['content'], // 留言內容
            'createTime' => $row['create_at'], // 留言時間
        ));
    }

    $jsonshell = array(
        'comments'=> $comment, // 所有留言
        'total'=> $count, // 總留言數
    );
    $response = json_encode($jsonshell); //轉譯成JSON格式字串
    response ($response); // 將結果回傳給客戶端
    exit();
?>
