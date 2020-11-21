// eslint-disable-next-line
/// <reference path="./jquery-3.5.1.js" />
$(document).ready(() => {
    // API位置變數
    const apiSite = 'http://localhost/w12_1_api_comment/';
    let limit = 5; // 顯示留言比數
    const addLimit = 5; // 按下「顯示更多」時所增加的留言筆數
    const siteKey = 'w12_1'; // 顯示留言比數

    // 純文字轉換
    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // 取得留言內容
    function getComments() {
        $.ajax({
            method: 'GET',
            url: `${apiSite}api_comments.php`,
            data: {
                siteKey,
                limit,
            },
        }).done((response) => {
            const data = JSON.parse(response); // 將JSON字串轉換成物件
            // console.log(data);
            if (data.status === 'error') { // 錯誤處裡
                console.log(data.message);
                return;
            }

            // 更新留言區內容
            $('.comment-output').empty();
            for (const comments of data.comments) {
                $('.comment-output').append(`
                    <div class="card  mt-3">
                        <div class="card-body">
                            <h5 class="nickname card-title">${escapeHtml(comments.nickname)}
                                <span class="badge badge-secondary ml-2">${escapeHtml(comments.createTime)}</span>
                            </h5>
                            <p class="content-output card-text">${escapeHtml(comments.content)}</p>
                        </div>
                    </div>
                `);
            }

            // 如果還有未顯示的留言，則顯示「更多留言」按鈕
            if (data.total > limit) {
                $('.comment-output').append('<button type="button" class="loadmore btn btn-info mt-3">更多留言</button>');
            }
        }).fail(() => {
            console.log('發生錯誤');
        });
    }

    // 主程式
    getComments(); // 取得留言內容
    $('.alert').hide(); // 隱藏告警訊息

    // 點選更多留言
    $('.comment-output').on('click', '.loadmore', () => {
        limit += addLimit;
        getComments(); // 取得留言內容
    });

    // 發送留言
    $('.comment-input').on('click', '.send-comment', () => {
        // 偵測沒輸入訊息時
        if ($('.nickname').val() === '' || $('.content').val() === '') {
            $('.alert').show(); // 顯示告警訊息
            return;
        }

        $('.alert').hide(); // 隱藏告警訊息
        // 發送訊息給API
        $.ajax({
            method: 'POST',
            url: `${apiSite}api_add_post.php`,
            data: {
                siteKey,
                nickname: $('.nickname').val(),
                content: $('.content').val(),
            },
        }).done((response) => {
            const data = JSON.parse(response); // 將JSON字串轉換成物件
            // console.log(data);
            if (data.status === 'error') { // 錯誤處裡
                console.log(data.message);
                return;
            }
            if (data.status === 'OK') { // 成功將訊息存入資料庫
                getComments(); // 取得留言內容
                $('.content').val(''); // 清空留言訊息
            }
        });
    });
});
