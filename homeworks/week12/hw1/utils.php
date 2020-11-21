<?php
    function getSQLData($stmt){ // 取得資料庫內的實體資料，通常用於【Select】的時候
        if($result = $stmt->execute()){
            $result = $stmt->get_result(); // 真正取得回傳結果
            if(!($result->num_rows===0)){ // 有東西
                return $result;
            }
            return 0; // 如果找不到東西
        }
        return false; // 資料庫異常
    }

    function response($jsonshell){ // 將結果回傳給客戶端
        $response =json_encode($jsonshell); //轉譯成JSON格式字串
        header('Content-Type: application/json; charset=utf-8'); // 避免編碼錯誤
        print_r ($response); // 透過print_r，可將封裝好的JSON格式字串回傳給前端
    }
?>