// eslint-disable-next-line
/// <reference path="./jquery-3.5.1.js" />
$(document).ready(() => {
    // 初始設定1
    const apiSite = 'http://localhost/w12_2_todolist/';

    // 純文字轉換
    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // 更新項目總數
    function updateItemCount(target = '.edit') {
        const count = $('.todolist-output').find(target).length;
        $('.item-count').text(`共${count}項`);
    }

    // 隱藏與顯示項目
    function hideAndShow(hideArray = '', showArray = '') {
        if (hideArray !== '') { // 如果沒傳值進來就不隱藏
            for (const itemStatus of hideArray) {
                $(itemStatus).parent().hide();
                if ($(itemStatus).parent().hasClass('d-flex')) {
                    $(itemStatus).parent().removeClass('d-flex');
                }
            }
        }
        if (showArray !== '') { // 如果沒傳值進來就不顯示
            for (const itemStatus of showArray) {
                $(itemStatus).parent().show();
                if (!$(itemStatus).parent().hasClass('d-flex')) {
                    $(itemStatus).parent().addClass('d-flex');
                }
            }
        }
    }

    // 切換按鈕狀態
    function setFocus(focus = '') {
        let nonFocusArray = ['.all-display', '.all-completed', '.all-uncompleted'];
        // 從陣列群組挑出不被關注的
        nonFocusArray = nonFocusArray.filter(temp => temp !== focus);
        // 設定不關注
        for (const i of nonFocusArray) {
            if ($(i).hasClass('active')) {
                $(i).removeClass('active');
            }
        }
        // 設定關注
        if (!$(focus).hasClass('active')) {
            $(focus).addClass('active');
        }
    }

    // 根據關注項目刷新顯示及計數器
    function updateFocusAndCount() {
        if ($('.all-completed').hasClass('active')) { // 如果篩選器是已完成時，隱藏此項目
            hideAndShow($('[data-value|="0"]'));
            updateItemCount($('[data-value|="1"]')); // 更新項目總數
        }
        if ($('.all-uncompleted').hasClass('active')) { // 如果篩選器是未完成時，隱藏此項目
            hideAndShow($('[data-value|="1"]'));
            updateItemCount($('[data-value|="0"]')); // 更新項目總數
        }
    }

    // 顯示告警訊息
    function showAlert(text) {
        $('.alert').text(text);
        $('.alert').show(); // 顯示告警訊息
        $('.alert').delay(1000).fadeOut(); // 停頓數秒後淡出
    }

    // 初始設定2
    updateItemCount(); // 更新項目總數
    $('.alert').hide(); // 隱藏告警訊息

    // 新增待辦
    $('.todolist-input').on('keypress', '.add-item', (e) => {
        const itemContent = $('.add-item').val();
        if (e.keyCode === 13 && itemContent !== '') { // 當按下enter並且有內容時
            $('.item-list').append(`
              <div type="button" class="list-group-item list-group-item-action d-flex align-items-center edit">
                <span class="badge badge-warning mr-1 status" data-value="0">未完成</span>
                <p class="my-auto text-break ml-2 item">${escapeHtml(itemContent)}</p>
                <span class="badge badge-secondary ml-auto delete-item">X</span>
              </div>
            `);
            $('.add-item').val(''); // 清空欄位
            updateItemCount(); // 更新項目總數
            updateFocusAndCount(); // 根據關注項目刷新顯示及計數器
        }
    });

    // 刪除待辦
    $('.todolist-output').on('click', '.delete-item', (e) => {
        $(e.target.parentNode).remove();
        updateItemCount(); // 更新項目總數
    });

    // 編輯待辦
    $('.todolist-output').on('click', '.edit', (e) => {
        if ($(e.target).hasClass('edit') || $(e.target).hasClass('item')) { // 當點選到空白處或項目文字本身
            const itemBox = $(e.target).closest($('.edit'));
            const itemContent = itemBox.find('.item').text();
            // 替換成編輯框
            itemBox.find('.item').prop('outerHTML', `<input type="text" class="form-control mx-2 editing" value="${escapeHtml(itemContent)}"/>`);
        }
    });

    // 完成編輯待辦
    $('.todolist-output').on('keypress', '.editing', (e) => {
        const itemContent = $(e.target).val();
        if (e.keyCode === 13 && itemContent !== '') { // 當按下enter並且有內容時，儲存該項目
            $(e.target).prop('outerHTML', `<p class="my-auto text-break ml-2 item">${escapeHtml(itemContent)}</p>`);
        }
        if (e.keyCode === 13 && itemContent === '') { // 當按下enter並且無內容時，刪除該項目
            const itemBox = $(e.target).closest($('.edit'));
            itemBox.prop('outerHTML', '');
        }
        updateItemCount(); // 更新項目總數
    });

    // 切換狀態
    $('.todolist-output').on('click', '.status', (e) => {
        const status = $(e.target).attr('data-value');
        if (status === '1') {
            $(e.target).attr('data-value', 0);
            $(e.target).text('未完成');
            $(e.target).removeClass('badge-success');
            $(e.target).addClass('badge-warning');
        } else {
            $(e.target).attr('data-value', 1);
            $(e.target).text('已完成');
            $(e.target).addClass('badge-success');
            $(e.target).removeClass('badge-warning');
        }
        updateFocusAndCount(); // 根據關注項目刷新顯示及計數器
    });

    // 清空待辦
    $('.todolist-output').on('click', '#delete-item-list', () => {
        $('.item-list').html('');
        updateItemCount(); // 更新項目總數
    });

    // 篩選已完成
    $('.todolist-output').on('click', '.all-completed', () => {
        const hideArray = $('[data-value|="0"]');
        const showArray = $('[data-value|="1"]');
        hideAndShow(hideArray, showArray); // 隱藏與顯示項目
        updateItemCount($('[data-value|="1"]')); // 更新項目總數
        setFocus('.all-completed'); // 設定按鈕關注
    });

    // 篩選未完成
    $('.todolist-output').on('click', '.all-uncompleted', () => {
        const hideArray = $('[data-value|="1"]');
        const showArray = $('[data-value|="0"]');
        hideAndShow(hideArray, showArray); // 隱藏與顯示項目
        updateItemCount($('[data-value|="0"]')); // 更新項目總數
        setFocus('.all-uncompleted'); // 設定按鈕關注
    });

    // 全部顯示
    $('.todolist-output').on('click', '.all-display', () => {
        const showArray1 = $('[data-value|="1"]');
        const showArray2 = $('[data-value|="0"]');
        hideAndShow('', showArray1); // 隱藏與顯示項目
        hideAndShow('', showArray2); // 隱藏與顯示項目
        updateItemCount(); // 更新項目總數
        setFocus('.all-display'); // 設定按鈕關注
    });

    // 發送儲存訊息
    $('.file-process').on('click', '.save', () => {
        if ($('#list-id').val() === '') {
            showAlert('編號欄位不能為空白');// 顯示告警訊息
            return;
        }
        if ($('.todolist-output').find('input').length > 0) {
            showAlert('請完成編輯欄位');// 顯示告警訊息
            return;
        }

        // 資料處裡
        const count = $('.todolist-output').find('.edit'); // 撈取所有清單項目
        const itemList = []; // 存放項目資料
        for (const i of count) {
            const status = $(i).find('.status').attr('data-value');
            const item = $(i).find('.item').text();
            itemList.push([status, item]); // 資料放入陣列中
        }

        const postData = { // 製作JSON資料物件
            'list-id': $('#list-id').val(), // 清單編號
            itemList, // 清單資料本體
        };
        const json = JSON.stringify(postData); // 轉換成JSON字串

        // 傳輸資料
        $.ajax({
            method: 'GET',
            url: `${apiSite}handle_save_todolist.php`,
            data: {
                data: json,
            },
        }).done((response) => {
            const data = JSON.parse(response); // 將JSON字串轉換成物件
            // console.log(data);
            if (data.status === 'error') { // 錯誤處裡
                console.log(data.message);
                return;
            }
            $('.toast-body').text('清單已儲存');
            $('.toast').toast('show'); // 顯示提示訊息
        }).fail((response) => {
            const error = JSON.parse(response); // 將JSON字串轉換成物件
            console.log('發生錯誤');
            // console.log(error);
            console.log(error.responseText);
        });
    });

    // 發送讀取請求
    $('.file-process').on('click', '.load', () => {
        if ($('#list-id').val() === '') {
            showAlert('編號欄位不能為空白');// 顯示告警訊息
            return;
        }

        // 傳輸資料
        $.ajax({
            method: 'GET',
            url: `${apiSite}handle_load_todolist.php`,
            data: {
                'list-id': $('#list-id').val(), // 清單編號
            },
        }).done((response) => {
            // console.log(response);
            const data = JSON.parse(response); // 將JSON字串轉換成物件
            if (data.status === 'error') { // 錯誤處裡
                console.log(data.message);
                return;
            }

            $('.item-list').html(''); // 清空待辦清單
            const { itemList } = data; // ES-6 Destructuring解構
            const statusTemp0 = '<span class="badge badge-warning mr-1 status" data-value="0">未完成</span>';
            const statusTemp1 = '<span class="badge badge-success mr-1 status" data-value="1">已完成</span>';
            for (const items of itemList) {
                const status = items.status === 0 ? statusTemp0 : statusTemp1; // 切換已完成、未完成
                $('.item-list').append(`
                  <div type="button" class="list-group-item list-group-item-action d-flex align-items-center edit">
                    ${status}
                    <p class="my-auto text-break ml-2 item">${escapeHtml(items.item)}</p>
                    <span class="badge badge-secondary ml-auto delete-item">X</span>
                  </div>
                `);
            }
            updateItemCount(); // 更新項目總數
            updateFocusAndCount(); // 根據關注項目刷新顯示及計數器

            $('.toast-body').text('清單已讀取');
            $('.toast').toast('show'); // 顯示提示訊息
        }).fail((response) => {
            const error = JSON.parse(response); // 將JSON字串轉換成物件
            console.log('發生錯誤');
            // console.log(error);
            console.log(error.responseText);
        });
    });
});
