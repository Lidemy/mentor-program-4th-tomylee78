## 跟你朋友介紹 Git

# 網頁好讀版

[4.跟你朋友介紹 Git](https://www.notion.so/GitHub-6bb1f91625fd402290447f7bc6a96234)

## 概念講解-版本控制("Git"只做這些事)

- 需要新的版本→開新資料夾
- 不會依據版本而改變 (EX:亙古不變的函式庫)→不要加入資料夾
- 使用亂數作為版本號(資料夾名稱)，避免版本號衝突 (多人協作時簡單的數字編號容易重複)
- 用一個檔案紀錄上面那麼多資料夾中，哪個資料夾才是最新的版本
- 用檔案紀錄版本順序以及修改的歷史紀錄
- 需要多版本並行時，使用`Branch`進行版本分支切割(這時Commit就是Branch下的子資料夾，並且整個架構為三層式架構)
- 合併兩個Branch若發生衝突，就手動解決衝突的檔案，結束後再Commit即可


## 功能說明

- 用於版本控制
- 推薦使用Git官網自帶的Git Bash操作Git
- Git Bash上操作的Command Line指令與Linux類似


## 基礎指令

### git init

- 為所在的資料夾進行初始化
- 可以看到在初始化後，該資料夾路徑就會變成master


- 而在資料夾中，打開隱藏檔，可以發現有個「.git」資料夾，裡面存放git版本控制所需要的東西


### git status

- 用於查看現在版本控制的狀態

### git add

- 將檔案加入版本控制的暫存區

    ```csharp
    git add Knamusu.txt
    ```


- 可以看到檔案被分成commit區域跟Untracked(不追蹤)區域
- 若當前新加入commit的檔案想要取消加入，則可使用提視窗說的`git rm --cachedKanmusu.txt`，將該檔案放回到Untracked當中
- 若需要將目前路徑的資夾內所有檔案都加入進版本控制暫存區中，可以用`git add .`，利用"點"代表當前資料夾內所有東西的意思

### git commit

- 用於新建版本的指令
- 如果先前有使用`git add`指令加入的檔案，則單純輸入`git commit`，就會將那些檔案抓進來做為新版本的內容物，同時會跳出視窗要求輸入這個版本的著名訊息(這個版本改了哪些東西之類的)
- 上面提到的訊息視窗，如果是Linux會用Vim編輯，如果是Windows，就看綁定的是哪個編輯平台(我是跳出VS Code)


- 如果不需要開啟編輯器而直接輸入版本訊息，可使用`git commit -m "請輸入訊息"`，這樣就可同時新建版本又輸入版本訊息
- 而有commit過的檔案如果被修改，透過`git status`查詢，就會跳出檔案被修改的狀態


如果在 git commit 的時候出現錯誤，跳出了要設定帳號跟姓名的畫面，請輸入以下指令
（記得把名字跟 email 換成你自己的）
`git config --global user.name "your name"
git config --global user.email "youremail"`
代表為此git建立使用者資訊(推薦跟GitHub的使用者名稱和信箱一樣)

- 若前面幾版已經有commit過的檔案，當修改檔案後，如果不使用`git add`而直接使用git commit，則會跳出檔案未加入準備commit的暫存區、需使用add加入
- 因此先前有commit的檔案，推薦使用`git commit -am "版本訊息"`，這樣就可以同時又add又commit，但前提是該檔案是先前有曾經加入commit的檔案，如果是新的檔案沒加入的，使用`git commit -am "版本訊息"`是不會加進去的


### git log

- 用於查看版本的歷史紀錄
- 包含作者、版號、建立時間、版本訊息等
- 可以想像成每一個commit就會對應一個版本資料夾


- 另外有個小指令是 `git log —oneline`，可以簡易的方式顯示log內容(顯示板號的前七碼)


### git checkout

- 用於回到先前的版本號，用法是 `git checkout 先前版本號名稱`


- 而要從舊的版本號回到最新版本號，則使用`git checkout master`，就可回到最新的了


### .gitignore   【不是指令，是檔案】

推薦.gitignore檔案要加入版本控制當中，好讓其他人能了解哪些檔案不需要做版控的歷程

- 紀錄於於此檔案清單內的檔案會自動被git忽略，避免每次Commit使用`git add .`時，還得額外將這些不放入版控的檔案一個一個用`rm --cached` 取消
- 使用 `touch .gitignore`建立檔案
- 使用`vi .gitignore` 編輯此檔案，例如我想要忽略vs.sln的板控，便把名字輸入後，鍵入`:wq`儲存，這樣使用git status時候就不會出現了


### git diff

- 用於確認當前還沒Commit時，與上一個Commit版本的實際內容差異


## Branch相關

### git branch -v

- 用於查看當前的branch版本訊息，並且會顯示當前最新的Commit


### git branch 你要的名稱

- 開啟新的分支版本(相較於主版本Master)

```csharp
git branch TomyTT
```


### git branch -d branch名稱

- 刪除指定的branch版本


### git checkout branch-name

- 用於切換不同Branch版本用(與切換Commit相同指令)


### git merge branch-name

- 合併不同的branch，是將他人的Branch合併到當前的Branch當中
- 當合併完成後，可以考慮用`git branch -d` 將被合併的舊版本給刪除


### conflic 【不是指令，是除錯】

- 當兩個Branch合併時發生衝突，會跳出錯誤訊息告知無法自動合併，需要手動修正
- 除了告警之外，檔案本身也會標註哪邊出問題，需要將`<<<<   =====    >>>>>`等符號刪除


- 使用`git status`查詢時，也會告知哪個檔案需要修改


- 而當問題解決時，請記得再一次Commit


