<?php
    require_once('./conn.php');
    require_once('./Utils.php'); // 客製化函式庫-偵測錯誤代碼

    $api_comments = array(); // 外層(未上JSON外殼)
    $comment = array(); // 放留言內容


    // 撈取資料庫資料
    //  撈取總留言數
    $sql = 'SELECT COUNT(Content) as Count  FROM AKIHA_comment WHERE IsDeleted = 0;';
    $stmt = $conn->prepare($sql);
    $result = getSQLData($stmt); // 取得資料
    if($result === false || $result === 0){
        exit('GG' . $conn->error); // 【伺服器錯誤，請聯絡管理員檢查伺服器】
    } else {
        $row = $result->fetch_assoc();
        $count = $row['Count']; // 總留言數
    }

    // 撈取留言內容
    $pageLimit = 5; // 每頁顯示筆數
    $allPage = intval($count / $pageLimit) + 1; // 總留言頁面數
    empty($_GET['page']) ? $page = 0 : $page = intval($_GET['page'] - 1); // 設定第幾頁
    $displayPage = $page + 1;
    $page = $page * $pageLimit;

    $sql = 'SELECT CMID, AKIHA_users.Account, Nickname, Content, AKIHA_comment.Create_at  FROM AKIHA_comment
            LEFT JOIN AKIHA_users
            ON AKIHA_users.Account = AKIHA_comment.Account
            WHERE IsDeleted = 0
            ORDER BY CMID DESC
            LIMIT ? OFFSET ?;';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $pageLimit, $page); // 解決SQL Injection的問題
    $resault = getSQLData($stmt); // 取得資料

    // 將資料放入陣列中
    while($row = $resault->fetch_assoc()){
        array_push($comment, array( // 以陣列的型式存入
            'ID'=> $row['CMID'], // 留言編號
            'account' => $row['Account'], // 帳號
            'nickname' => $row['Nickname'], // 留言編號
            'content' => $row['Content'], // 留言內容
            'createTime' => $row['Create_at'], // 留言時間
        ));
    }

    $api_comments = array( // 以物件的型式存入
        'totalCount'=> $count, // 總頁數
        'page'=> $displayPage, // 目前頁數
        'allPage'=> $allPage, // 總留言頁面數
        'comments'=> $comment, // 所有留言
    );

    $jsonshell = array(
        'api_comments'=> $api_comments,
    );

    $response =json_encode($jsonshell); //轉譯成JSON格式字串
    header('Content-Type: application/json; charset=utf-8'); // 避免編碼錯誤
    print_r ($response);

    exit();
?>
