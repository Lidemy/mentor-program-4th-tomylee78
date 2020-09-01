document.querySelector('.faq-box-group').addEventListener('click', (e) => {
    const parent = e.target.getAttribute('data-value');
    const child = e.target.parentNode.getAttribute('data-value');

    function addAnswer(ans) {
        const answerbox = document.querySelector(`div[data-value=${ans}] > .faq-box__answer`); // 抓取答案框
        if (!answerbox) { // 如果沒答案框，就寫入答案
            const node = document.createElement('div'); // 新增含有div的元素
            node.classList.add('faq-box__answer'); // 為div加入回答用的class樣式

            switch (ans) {
                case 'q1':
                    node.innerText = '憑交易編號以及商品並連繫客服，我們會派員前往您的地址收回商品，凡是鑑賞期七天內都可退貨，滿足奧客們的心，是我們的宗旨。';
                    break;
                case 'q2':
                    node.innerText = '目前提供Line Pay、街口支付、Pi 錢包、信用卡等多種付款方式。';
                    break;
                case 'q3':
                    node.innerText = '線上刷卡的使用方式也超簡單，只要您確認您當次的購物清單與金額都無誤，就可立即到匯款上傳系統，登入個人帳號密碼後，點選"線上刷卡方式"，確認收件住址後，再進行刷卡確認程序即可～';
                    break;
                case 'q4':
                    node.innerText = '點選右上角查詢訂單按鈕，輸入訂單編號即可查詢您的訂單。';
                    break;
                case 'q5':
                    node.innerText = '可以的，只要在訂單成立後半小時內，都可隨時更改訂單內的商品數量，若有需要也可直接取消訂單，雖然我們會陪到死，但服務客人乃是我們的宗旨，所以歡迎多加使用。';
                    break;
                case 'q6':
                    node.innerText = '若您的商品缺貨時，可聯繫客服人員告知商品編號，我們會在三個工作天內盡快補貨並通知您。';
                    break;
                default:
                    break;
            }

            document.querySelector(`div[data-value=${ans}]`).appendChild(node); // 將新增的元素插入母元素的最下面
        } else if (answerbox) { // 如果有答案框了，那麼就移除答案框
            document.querySelector(`div[data-value=${ans}]`).removeChild(answerbox);
        }
    }

    if (parent) { // 當點選整個問題框時
        addAnswer(parent);
    } else if (child) { // 當點選問題框內的子元素時
        addAnswer(child);
    }
});
