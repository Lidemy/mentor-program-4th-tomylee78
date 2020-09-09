document.addEventListener('DOMContentLoaded', () => { // 讓HTML都載入後才跑DOM
    // 切換隱藏版面
    function hideDiv(class1) {
        document.querySelector(class1).classList.toggle('hide');
    }

    // 加入新的class
    function addClass(addclass) {
        document.querySelector('.lottery-background').classList.add(addclass);
    }

    // 修改中獎文字
    function changeText(text) {
        document.querySelector('.lottery-resul__content').innerText = text;
    }

    // 熱血開抽
    document.querySelector('.button').addEventListener('click', () => {
        const request = new XMLHttpRequest(); // 建立瀏覽器請求物件
        request.onload = () => {
            if (request.status >= 200 && request.status < 400) {
                const data = JSON.parse(request.responseText); // 將伺服器回傳的資料取出轉乘JSON物件
                console.log(data.prize);
                if (data.prize === 'FIRST' || data.prize === 'SECOND' || data.prize === 'THIRD' || data.prize === 'NONE') {
                    hideDiv('.lottery-result');
                    hideDiv('.lottery-information');
                }

                switch (data.prize) {
                    case 'FIRST':
                        addClass('result-1');
                        changeText('恭喜你中頭獎了！中國武漢來回雙人遊！');
                        break;
                    case 'SECOND':
                        addClass('result-2');
                        changeText('恭喜你中二獎！ 5 吋電視一台！');
                        break;
                    case 'THIRD':
                        addClass('result-3');
                        changeText('恭喜你抽中三獎：知名 YouTuber 丁皇簽名握手會入場券一張，墮！');
                        break;
                    case 'NONE':
                        addClass('result-0');
                        changeText('銘謝惠顧！沒中獎幫哭哭唷~');
                        document.querySelector('.lottery-resul__content').classList.add('GG');
                        break;
                    default:
                        alert('系統不穩定，請再試一次');
                        break;
                }
            } else {
                alert('系統不穩定，請再試一次');
            }
        };

        request.onerror = () => {
            alert('系統不穩定，請再試一次');
        };
        request.open('GET', 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery', true);
        request.send();
    });

    // 返回初始抽獎頁
    document.querySelector('.button-back').addEventListener('click', () => {
        hideDiv('.lottery-result');
        hideDiv('.lottery-information');
        document.querySelector('.lottery-background').setAttribute('class', 'lottery-background'); // 將背景重製
        document.querySelector('.lottery-resul__content').setAttribute('class', 'lottery-resul__content'); // 將得獎文字顏色重製
    });
});
