// eslint-disable-next-line
/// <reference path="./jquery-3.5.1.js" />

// 建立客製化模板
function createTemplate(siteKey) {
    return `<section class="${siteKey}-comment-input container mt-3">
        <form>
            <div class="form-group">
                <label for="exampleFormControlInput1">留言板暱稱</label>
                <input type="text" class="form-control ${siteKey}-nickname" id="exampleFormControlInput1" placeholder="輸入暱稱" />
            </div>
            <div class="form-group">
                <label for="${siteKey}-contain-input">訊息內容</label>
                <textarea class="form-control ${siteKey}-content" rows="3"></textarea>
            </div>
            <div class="${siteKey}-alert alert alert-warning" role="alert">訊息不能為空白</div>
            <button type="button" class="btn btn-primary ${siteKey}-send-comment">發送訊息</button>
        </form>
    </section>
    <section class="${siteKey}-comment-output container mb-5">
    </section>`;
}

// 更多留言按鈕
function loadMoreTemplate(siteKey) {
    return `<button type="button" class="${siteKey}-loadmore btn btn-info mt-3">更多留言</button>`;
}

// 函式匯出區
export {
    createTemplate, loadMoreTemplate, // 初始化->載入留言板模板並顯示留言內容
};
