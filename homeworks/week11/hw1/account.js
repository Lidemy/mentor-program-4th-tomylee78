document.addEventListener('DOMContentLoaded', () => { // 讓HTML都載入後才跑DOM
    document.querySelector('.comment-input').addEventListener('click', (e) => { // 切換顯示編輯介面
        if (e.target.classList.contains('edit')) {
            e.target.parentNode.classList.toggle('hide');
            e.target.parentNode.nextElementSibling.classList.toggle('hide');
        }
        if (e.target.classList.contains('cancle')) {
            e.target.parentNode.parentNode.classList.toggle('hide');
            e.target.parentNode.parentNode.previousElementSibling.classList.toggle('hide');
        }
        if (e.target.classList.contains('submit')) { // 檢查輸入框是否有東西
            if (e.target.parentNode.firstElementChild.value === '') {
                e.preventDefault(); // 功能暫停
                if (e.target.parentNode.parentNode.nextElementSibling.classList.contains('hide')) {
                    e.target.parentNode.parentNode.nextElementSibling.classList.remove('hide');
                }
            }
            if (!e.target.parentNode.parentNode.nextElementSibling.classList.contains('hide')) {
                e.target.parentNode.parentNode.nextElementSibling.classList.add('hide');
            }
        }
    });
});
