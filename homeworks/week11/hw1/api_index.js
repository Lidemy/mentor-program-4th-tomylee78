document.addEventListener('DOMContentLoaded', () => { // 讓HTML都載入後才跑DOM
    const comments = new XMLHttpRequest(); // 建立瀏覽器請求物件

    // 取得留言板API資料
    function getComnentAPI(response, url, CB) {
        response.onerror = () => {
            alert('系統不穩定，請再試一次');
        };
        response.open('POST', url, true);
        response.send();
        response.onload = () => {
            if (response.readyState === 4) { //
                if (response.status >= 200 && response.status < 400) {
                    const data = JSON.parse(response.responseText); // 將伺服器回傳的資料取出轉成JSON物件
                    CB(data);
                } else {
                    alert('系統不穩定，請再試一次');
                }
            }
        };
    }

    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }
    function Start() { // 初始取得留言板內容
        getComnentAPI(comments, 'http://localhost/w11_1_comment/api_comments.php', (data) => { // 向API索取留言資料
            // console.log(data.api_comments[3].comments);
            const item = data.api_comments[3].comments; // 留言資訊
            for (let i = 0; i < item.length; i += 1) {
                const element = document.createElement('div');
                element.classList.add('message-box');
                element.innerHTML = `
                <div class="message-box__avatar"></div>
                <div class="message-box__content">
                    <div class="message-box__content__title">
                        ${escapeHtml(item[i].nickname)}
                        <span class="message-box__content__account">${escapeHtml(item[i].account)}</span>
                        <span class="create-time">${escapeHtml(item[i].createTime)}</span>
                    </div>
                    <p>${escapeHtml(item[i].content)}</p>
                </div>`;
                // console.log(element);
                document.querySelector('.comment-output').appendChild(element); // 將新建的元素放入外框內
            }
        });
    }

    Start(); // 開始載入留言內容

    // 發送留言
    document.querySelector('input[data-value=post]').addEventListener('click', (e) => {
        e.preventDefault(); // 停止送出功能
        if (e.target.previousElementSibling.value === '') {
            alert('請輸入留言內容');
            return;
        }

        const content = e.target.previousElementSibling.value; // 撈取使用者的留言
        const response = new XMLHttpRequest(); // 建立瀏覽器請求物件
        response.onerror = () => {
            alert('系統不穩定，請再試一次');
        };
        response.open('POST', 'http://localhost/w11_1_comment/api_add_post.php', true);
        response.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8'); // 設定訊息文字編碼
        response.send(`account=akiha&content=${encodeURIComponent(content)}`);
        response.onload = () => {
            if (response.readyState === 4) { //
                if (response.status >= 200 && response.status < 400) {
                    // const data = JSON.parse(response.responseText); // 將伺服器回傳的資料取出轉成JSON物件
                    // const data = response.responseText;
                    // console.log(data);
                    document.querySelector('.comment-output').innerHTML = ''; // 清空留言內容
                    e.target.previousElementSibling.value = ''; // 清空使用者輸入
                    Start(); // 開始載入留言內容
                } else {
                    alert('系統不穩定，請再試一次');
                }
            }
        };
    });
});
