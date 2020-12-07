// eslint-disable-next-line
/// <reference path="./jquery-3.5.1.js" />

// 函式引入區
import $ from './jquery-3.5.1';

// 純文字轉換
function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

// 將API取得的留言放進網頁中
function addCommenttoDOM(outputTarget, comments) {
    for (const comment of comments) {
        $(outputTarget).append(`
            <div class="card  mt-3">
                <div class="card-body">
                    <h5 class="nickname card-title">${escapeHtml(comment.nickname)}
                        <span class="badge badge-secondary ml-2">${escapeHtml(comment.createTime)}</span>
                    </h5>
                    <p class="content-output card-text">${escapeHtml(comment.content)}</p>
                </div>
            </div>
        `);
    }
}

// 函式匯出區
export default addCommenttoDOM; // 將API取得的留言放進網頁中
