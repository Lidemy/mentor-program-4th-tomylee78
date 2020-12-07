// eslint-disable-next-line
/// <reference path="./jquery-3.5.1.js" />

// 函式引入區
import $ from './jquery-3.5.1';
import { apiGetComments, apiAddComments } from './api';
import addCommenttoDOM from './utils';
import { createTemplate, loadMoreTemplate } from './commentTemplate';

// 內部全域變數
const addLimit = 5; // 按一次按鈕增加的留言比數 (預設是5)

// 取得留言內容
function getComments(apiSite, siteKey, limit, outputTarget) {
    // 呼叫API取得留言
    apiGetComments(apiSite, siteKey, limit, (response) => {
        if (response === 'error') {
            console.log('發生錯誤');
            return;
        }
        const data = JSON.parse(response); // 將JSON字串轉換成物件
        // console.log(data);
        if (data.status === 'error') { // 錯誤處裡
            console.log(data.message);
            return;
        }

        // 更新留言區內容
        $(outputTarget).empty();
        addCommenttoDOM(outputTarget, data.comments); // 將API取得的留言放進網頁中

        // 如果還有未顯示的留言，則顯示「更多留言」按鈕
        if (data.total > limit) {
            $(outputTarget).append(loadMoreTemplate(siteKey));
        }
    });
}

// 初始化->載入留言板模板並顯示留言內容
function commentInit(option) {
    // 內部參數獲取外部傳入的值
    const { apiSite } = option; // API位置
    let { limit } = option; // 顯示留言比數
    const { siteKey } = option; // 留言板金鑰
    const { target } = option; // 要插入留言版的目標元素
    const inputTarget = `.${siteKey}-comment-input`; // 留言板輸入框架的元素
    const outputTarget = `.${siteKey}-comment-output`; // 留言板顯示框架的元素
    const nicknameTarget = `.${siteKey}-nickname`; // 留言板暱稱的元素
    const contentTarget = `.${siteKey}-content`; // 留言板輸入內容的元素

    target.append(createTemplate(siteKey)); // 在網頁上渲染出留言板版型
    getComments(apiSite, siteKey, limit, outputTarget); // 取得留言內容

    $(`.${siteKey}-alert`).hide(); // 隱藏告警訊息

    // 點選更多留言
    $(outputTarget).on('click', `.${siteKey}-loadmore`, () => {
        limit += addLimit;
        getComments(apiSite, siteKey, limit, outputTarget); // 取得留言內容
    });

    // 發送留言
    $(inputTarget).on('click', `.${siteKey}-send-comment`, () => {
        // 偵測沒輸入訊息時
        if ($(nicknameTarget).val() === '' || $(contentTarget).val() === '') {
            $(`.${siteKey}-alert`).show(); // 顯示告警訊息
            return;
        }

        $(`.${siteKey}-alert`).hide(); // 隱藏告警訊息
        // 發送訊息給API
        const nickname = $(nicknameTarget).val(); // 暱稱
        const content = $(contentTarget).val(); // 留言內容
        apiAddComments(apiSite, siteKey, nickname, content, (response) => {
            const data = JSON.parse(response); // 將JSON字串轉換成物件
            // console.log(data);
            if (data.status === 'error') { // 錯誤處裡
                console.log(data.message);
                return;
            }
            if (data.status === 'OK') { // 成功將訊息存入資料庫
                getComments(apiSite, siteKey, limit, outputTarget); // 取得留言內容
                $(contentTarget).val(''); // 清空留言訊息
            }
        });
    });
}

// 函式匯出區
export default commentInit; // 初始化->載入留言板模板並顯示留言內容
