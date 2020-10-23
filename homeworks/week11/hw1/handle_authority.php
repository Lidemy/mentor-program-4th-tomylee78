<?php
    require_once('./conn.php');
    require_once('./Utils.php');
    $jsonshell = array(); // 預計要回傳的JSON陣列
    if(empty($_POST['account']) || empty($_POST['newAuthority'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        array_push($jsonshell, array(
            'status' => 'error',
            'message' => '資料不齊全',
        ));
        $response = json_encode($jsonshell); //轉譯成JSON格式字串
        echo $response;
        exit();
    }

    $account = $_POST['account'];
    $newAuthority = intval($_POST['newAuthority']);
    $sql = "UPDATE AKIHA_users set Authority = ? where Account = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $newAuthority, $account); // 解決SQL Injection的問題

    if(!$result = $stmt->execute()){
        array_push($jsonshell, array(
            'status' => 'error',
            'message' => '伺服器異常，請聯絡管理員',
        ));
    } else {
        if($conn->affected_rows === 0){ // 因為選項相同也可以，所以允許更新數為0
            array_push($jsonshell, array(
            'status' => 'Ok',
            'message' => '新增成功',
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