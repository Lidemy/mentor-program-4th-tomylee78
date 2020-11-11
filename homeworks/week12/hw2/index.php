<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>待辦清單</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"><!--RWD-->
        <meta name="description" content="使用Bootstap的TodoList">
        <meta name="author" content="AKIHA">
        <link rel="stylesheet" href="./normalize.css">
        <!--下面引用Bootstrap-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <!--上面引用Bootstrap-->
        <script src="./index.js"></script>
        <style>
            #delete-item-list{
                outline:none;
            }
            .point-box{
                position:relative;
            }
            .point{
                position:absolute;
                left:50%;
                transform:translate(-50%, -20%);
            }
        </style>
    </head>
    <body>
        <h1 class="container mt-5 text-center">待辦清單</h1>
        <div class="form-inline container file-process">
            <input type="text" class="form-control mx-sm-3 mb-2" id="list-id" placeholder="輸入編號存取清單紀錄">          
            <button type="submit" class="btn btn-primary mr-3 mb-2 load">讀取</button>
            <button type="submit" class="btn btn-primary mr-3 mb-2 save">儲存</button>
        </div>
        <section class="point-box container">
            <div class="alert alert-warning point mx-auto mt-2" role="alert"></div>
            <div class="toast container text-white bg-primary point" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
              <div class="toast-body"></div>
            </div>
        </section>
        <section class="todolist-input container mt-5">
            <div class="form-group">
                <input type="text" class="form-control add-item  pt-4 pb-4" placeholder="輸入代辦項目"/>
            </div>
        </section>
        <section class="todolist-output container">
            <div class="list-group item-list">
            </div>
            <div class="list-group list-group-horizontal text-center">
                <button type="button" class="list-group-item list-group-item-action item-count" disabled>共5項</button>
                <button type="button" class="list-group-item list-group-item-action all-display active">全部</button>
                <button type="button" class="list-group-item list-group-item-action all-completed">已完成</button>
                <button type="button" class="list-group-item list-group-item-action all-uncompleted">未完成</button>
                <button type="button" class="list-group-item list-group-item-action" id="delete-item-list">清空待辦</button>
            </div>
        </section>
    </body>
</html>
