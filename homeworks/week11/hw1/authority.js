document.addEventListener('DOMContentLoaded', () => { // 讓HTML都載入後才跑DOM
    document.querySelector('.comment-input').addEventListener('click', (e) => { // 切換顯示編輯介面
        if (e.target.classList.contains('edit')) {
            e.target.parentNode.classList.toggle('hide');
            e.target.parentNode.nextElementSibling.classList.toggle('hide');
        }
        if (e.target.classList.contains('cancle')) {
            e.target.parentNode.classList.toggle('hide');
            e.target.parentNode.previousElementSibling.classList.toggle('hide');
        }
        if (e.target.classList.contains('submit')) { // 檢查輸入框是否有東西
            // 使用者選擇的權限
            const newAuthority = e.target.previousElementSibling.previousElementSibling.value;
            let account = e.target.parentNode.previousElementSibling;
            account = account.previousElementSibling.firstElementChild.innerText; // 選擇的帳號
            // console.log(newAuthority);
            const response = new XMLHttpRequest(); // 建立瀏覽器請求物件
            response.onerror = () => {
                alert('系統不穩定，請再試一次');
            };
            response.open('POST', 'http://localhost/w11_1_comment/handle_authority.php', true);
            response.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8'); // 設定訊息文字編碼
            response.send(`account=${encodeURIComponent(account)}&newAuthority=${encodeURIComponent(newAuthority)}`);
            response.onload = () => {
                if (response.readyState === 4) { //
                    if (response.status >= 200 && response.status < 400) {
                        const data = JSON.parse(response.responseText); // 將伺服器回傳的資料取出轉成JSON物件
                        // const data = response.responseText;
                        // console.log(data[0].status);
                        if (data[0].status === 'Ok') {
                            Location.reload(); // 重新刷新頁面
                        }
                    } else {
                        alert('系統不穩定，請再試一次');
                    }
                }
            };
        }
    });
});
