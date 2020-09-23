<?php
    require_once('./conn.php');
    if(empty($_POST['nickname']) || empty($_POST['content'])){ // 當輸入框沒正確輸入時，將錯誤代碼傳回主頁
        header('Location: ./index.php?error=1');
        exit();
    }

    $nickname = $_POST['nickname'];
    $content = $_POST['content'];
    //$sql = "INSERT INTO AKIHA_comment (Nickname, Content) values('" . $nickname . "', '" . $content . "'); ";
    $sql = sprintf("INSERT INTO AKIHA_comment (Nickname, Content) values('%s', '%s');", $nickname, $content);
    
    if(!$result = $conn->query($sql)){
        header('Location: ./index.php?error=2');
    } else {
        header('Location: ./index.php');
    }
    exit();
?>