// 輸入框輸入資料
document.querySelector('.input-box').addEventListener('keydown', (e) => {
    const inputBox = document.querySelector('.input-box');
    const listBoxGroup = document.querySelector('.list-box-group');

    if (e.keyCode === 13 && inputBox.value !== '') { // 當輸入框有文字並且按下Enter時
        const node = document.createElement('div'); // 預計加入的清單節點
        node.classList.add('list-box');
        node.innerHTML = `<div class="list-box__checkbox"></div>
                <div class="list-box__content">${inputBox.value}</div>
                <div class="list-box__cancel"></div>`;
        listBoxGroup.appendChild(node); // 將清單加入最下層
        inputBox.value = ''; // 將輸入框清空
    }
});

document.querySelector('.list-box-group').addEventListener('click', (e) => {
    // 點擊勾選框時
    if (e.target.classList.contains('list-box__checkbox')) { // 當事件是監聽到勾選框被點擊時，才判斷是否打勾
        e.target.classList.toggle('list-box__checkbox__clicked'); // 切換勾選效果
        e.target.nextElementSibling.classList.toggle('list-box__content__clicked'); // 文字內容切換勾選效果
        e.target.nextElementSibling.nextElementSibling.classList.toggle('list-box__cancel'); // 叉叉切換勾選效果-1
        e.target.nextElementSibling.nextElementSibling.classList.toggle('list-box__cancel__clicked'); // 叉叉切換勾選效果-2
    }

    // 點擊叉叉時，因為有兩套class的關係(一個正常色，一個淺色)，所以用 || 進行判斷
    if (e.target.classList.contains('list-box__cancel') || e.target.classList.contains('list-box__cancel__clicked')) {
        e.target.closest('.list-box').remove();
    }
});

// 滑鼠移動到按鈕上
document.querySelector('.list-box-group').addEventListener('mouseover', (e) => {
    // 增加提示訊息
    function addPoint(node, content) {
        if (e.target.classList.contains(node)) { // 選擇目標
            e.target.closest(`.${node}`).innerHTML = content; // 增加提示
        }
    }

    addPoint('list-box__checkbox', '<div class="list-box__checkbox__point">完成</div>'); // 勾選框
    addPoint('list-box__cancel', '<div class="list-box__cancel__point">刪除</div>'); // 叉叉(正常色)
    addPoint('list-box__cancel__clicked', '<div class="list-box__cancel__clicked__point">刪除</div>'); // 叉叉(淺色)
});

// 滑鼠移開按鈕時
document.querySelector('.list-box-group').addEventListener('mouseout', (e) => {
    // 刪除提示訊息
    function deletePoint(node) {
        if (e.target.classList.contains(node)) { // 選擇目標
            e.target.removeChild(document.querySelector(`.${node}__point`)); // 將目標內的div提示移除
        }
    }

    deletePoint('list-box__checkbox'); // 勾選框
    deletePoint('list-box__cancel'); // 叉叉(正常色)
    deletePoint('list-box__cancel__clicked'); // 叉叉(淺色)
});
