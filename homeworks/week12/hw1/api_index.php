<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>稀哩呼嚕API留言板</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--RWD-->
        <meta name="description" content="提供各個版型留言板串接API">
        <meta name="author" content="AKIHA">
        <link rel="stylesheet" href="./normalize.css">
        <!--<link rel="stylesheet" href="./style.css">-->
        <!--<script src="./index.js"></script>-->        
        <!--下面引用Bootstrap-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <!--上面引用Bootstrap-->
        <script src="./api_index.js"></script>        
    </head>
    <body>
        <h1 class="container mt-5">稀哩呼嚕API留言板</h1>
        <section class="comment-input container mt-3">
            <form>
                <div class="form-group">
                    <label for="exampleFormControlInput1">留言板暱稱</label>
                    <input type="email" class="form-control nickname" id="exampleFormControlInput1" placeholder="輸入暱稱" />
                </div>
                <div class="form-group">
                    <label for="contain-input">訊息內容</label>
                    <textarea class="form-control content" id="contain-input" rows="3"></textarea>
                </div>
                <div class="alert alert-warning" role="alert">訊息不能為空白</div>
                <button type="button" class="btn btn-primary send-comment">發送訊息</button>
            </form>
        </section>
        <section class="comment-output container mb-5">
        </section>
    </body>
</html>