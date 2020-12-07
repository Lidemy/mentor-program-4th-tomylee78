<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>稀哩呼嚕API留言板</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--RWD-->
        <meta name="description" content="提供各個版型留言板串接API">
        <meta name="author" content="AKIHA">
        <link rel="stylesheet" href="./normalize.css">
        <!--下面引用Bootstrap-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <!--上面引用Bootstrap-->
        <script src="./commentPlugin"></script>
        <script>
            $(document).ready(() => {
            // 模擬呼叫函式庫所傳入的參數
                const option = {
                apiSite: 'http://localhost/w13_2_api_comment/',
                limit: 5, // 顯示留言比數
                siteKey: 'w12_1', // 留言板金鑰
                target: $('#plugin-container'), // 要插入留言版的目標元素
                }
                const option2 = {
                apiSite: 'http://localhost/w13_2_api_comment/',
                limit: 5, // 顯示留言比數
                siteKey: 'w12_2', // 留言板金鑰
                target: $('#plugin-container2'), // 要插入留言版的目標元素
                }
                commentsPlugin.default(option); // 留言板初始化
                commentsPlugin.default(option2); // 留言板初始化
            });
        </script>
    </head>
    <body>
        <h1 class="container mt-5">稀哩呼嚕API留言板</h1>
        <div id="plugin-container"></div>
        <h1 class="container mt-5">稀哩呼嚕API留言板2</h1>
        <div id="plugin-container2"></div>
    </body>
</html>