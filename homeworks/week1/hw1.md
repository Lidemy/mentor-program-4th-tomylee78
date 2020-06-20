## 交作業流程

# 網頁好讀版

[如何使用GitHub交作業](https://www.notion.so/GitHub-4fc4dbf09b194dcabbcee34bd241c9b5)

# 安裝Git

1. 上Git官網下載對應作業系統的Git

    [Downloading Git](https://git-scm.com/download/win)

## 設定交作業的GitHub 專案

1. 前往GitHuba classroom 網址，讓GitHub帳號接受任務

    [https://classroom.github.com/a/SbDvk2VA](https://classroom.github.com/a/SbDvk2VA)

2. 綁定帳號後，點選Clone or Download，將作業下載下來
這概念有點像是複製老師的答案券到自己電腦上，接著在自己這張答案券上作答
3. 根據以上概念，可以在Git Bash上，利用`git clone 網址` 的方式，將答案券下載到電腦的指定資料夾內



    請務必留意!!!每處理一份作業，請新建一個Branch，不要跟原本的Master撞在一起，都確定好作業後再合併回Master當中

## 開始寫作業

1. 寫作業之前，先將作業資料夾Branch一份出來，例如名稱為week1→ `git branch week1`，有了新的Branch才不會更動到主要的Master資料。概念類似複印一份答案卷出來，而不要直接填寫在原本的答案券上)
2. 切換Branch，使用`git checkout week1`進行切換
3. 打開作業資料夾的檔案開始寫作業

## 作業完成後，開始上傳繳交

請留意是否已將作業Commit

1. 使用`git status`，確認完成作業後的版本狀態，應該會發現有修改的作業檔未commit
2. 使用`git commit -am "第一週作業繳交"`，將修改完的作業add並commit
3. 使用`push origin week1`，將作業上傳到GitHub
4. 前往GitHub頁面，可以發現在網頁中輸入作業完成的標題字樣和內容(問題或小心得)，最後按下Create pull request
5. 複製GitHub中，Pull Request的Conversation網址，在作業平台中選擇作業列表→新增作業→選擇繳交的作業週次→貼上上面的那個PR連結
6. 勾選「確認已經檢查過作業，有完成需求」和「確認已經看過當週的自我檢討並修正錯誤」，最後按下送出完成繳交