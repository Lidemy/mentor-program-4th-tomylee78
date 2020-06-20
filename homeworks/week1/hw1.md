## 交作業流程

# 安裝Git

1. 上Git官網下載對應作業系統的Git

    [Downloading Git](https://git-scm.com/download/win)

## 設定交作業的GitHub 專案

1. 前往GitHuba classroom 網址，讓GitHub帳號接受任務

    [https://classroom.github.com/a/SbDvk2VA](https://classroom.github.com/a/SbDvk2VA)

2. 綁定帳號後，點選Clone or Download，將作業下載下來
這概念有點像是複製老師的答案券到自己電腦上，接著在自己這張答案券上作答
3. 根據以上概念，可以在Git Bash上，利用`git clone 網址` 的方式，將答案券下載到電腦的指定資料夾內

    ![https://s3-us-west-2.amazonaws.com/secure.notion-static.com/cdf036b6-3c2e-4e00-ad64-e68069d1ea16/Untitled.png](https://s3-us-west-2.amazonaws.com/secure.notion-static.com/cdf036b6-3c2e-4e00-ad64-e68069d1ea16/Untitled.png)

    請務必留意!!!每處理一份作業，請新建一個Branch，不要跟原本的Master撞在一起，都確定好作業後再合併回Master當中

## 作業完成後，開始上傳繳交

請留意是否已將作業Commit

1. 使用`push origin week1`，將作業上傳到GitHub
2. 在網頁中輸入作業完成的字樣，最後按下Create pull request
3. 在作業平台中貼上PR連結，完成繳交