// eslint-disable-next-line
/// <reference path="./jquery-3.5.1.js" />

// 函式引入區
import $ from './jquery-3.5.1';

// 取得留言內容
function apiGetComments(apiSite, siteKey, limit, cb) {
    $.ajax({
        method: 'GET',
        url: `${apiSite}api_comments.php`,
        data: {
            siteKey,
            limit,
        },
    }).done((response) => {
        cb(response); // 回呼函式->正確取得後該做什麼
    }).fail(() => {
        cb('error'); // 發生錯誤
    });
}

// 發送留言
function apiAddComments(apiSite, siteKey, nickname, content, cb) {
    $.ajax({
        method: 'POST',
        url: `${apiSite}api_add_post.php`,
        data: {
            siteKey,
            nickname,
            content,
        },
    }).done((response) => {
        cb(response);
    });
}

// 函式匯出區
export {
    apiGetComments, // 取得留言
    apiAddComments, // 發送留言
};
