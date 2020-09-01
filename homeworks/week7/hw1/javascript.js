document.querySelector('.submit').addEventListener('click', () => {
    // 針對輸入框做處裡
    function checkNull(src) { // 使用老師影片中推薦的function，將事情簡單化
        const inputBox = document.querySelector(src);
        const nextNode = document.querySelector(`${src} + .error`);

        if (inputBox.value === '' && nextNode === null) { // 當欄位為空白並且沒有警告標語時才加上
            inputBox.outerHTML += '<div class="error">此欄位不能為空白</div>';
        } else if (nextNode !== null && inputBox.value !== '') { // 當發現欄位有填字、並且紅色警告字存在時
            document.querySelector(`${src} + .error`).remove(); // 直接移除新增的紅色警告字
        }
    }

    checkNull('input[placeholder=您的回答]');
    checkNull('input[placeholder=您的電子郵件]');
    checkNull('input[placeholder=您的手機號碼]');
    checkNull('.select ~ input[placeholder=您的回答]');

    // 針對選單做處裡

    const radio = document.querySelectorAll('input[type=radio]'); // 選擇radio
    const selectNode = document.querySelector('.select + .error');

    function ckeckRegister(temp) { // 傳入選取陣列，當當有抓到其中一個被選取就回傳true
        for (let i = 0; i < temp.length; i += 1) {
            if (temp[i].checked) {
                return i;
            }
        }
        return undefined;
    }

    if (ckeckRegister(radio) === undefined && selectNode === null) { // 當沒有做選擇並且沒有警告標語時，加上警告標語
        document.querySelector('.select').outerHTML += '<div class="error">此欄位不能為空白</div>';
    } else if (ckeckRegister(radio) !== undefined && selectNode !== null) { // 當有選擇並且有警告標語時，移除警告標語
        document.querySelector('.select + .error').remove();
    }

    // 當都確實輸入時，跳出彈出視窗
    if (!document.querySelector('.error')) {
        const answer = document.querySelectorAll('input[type=text]');
        const labelBox = document.querySelectorAll('input[type=radio] + label'); // 選擇radio後面的label集合

        alert(`
            使用者輸入資料如下

            暱稱：${answer[0].value}
            電子郵件：${answer[1].value}
            手機號碼：${answer[2].value}
            報名類型：${labelBox[ckeckRegister(radio)].innerText}
            怎麼知道這個活動：${answer[3].value}
        `);
    }
});
