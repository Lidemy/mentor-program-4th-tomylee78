document.addEventListener('DOMContentLoaded', () => { // 讓HTML都載入後才跑DOM
    const top5Game = new XMLHttpRequest(); // 建立瀏覽器請求物件
    const channelList = new XMLHttpRequest(); // 建立瀏覽器請求物件
    const liGroup = document.querySelectorAll('li'); // 選取標籤列
    const channelsTitle = document.querySelector('.channels__title');
    const channelsList = document.querySelector('.channels-list');
    let actionLi = 0; // 記錄哪個標籤被選取

    // 取得圖奇API資料
    function getTwitchAPI(response, url, CB) {
        response.onerror = () => {
            alert('系統不穩定，請再試一次');
        };
        response.open('GET', url, true);
        response.setRequestHeader('Client-ID', '64xr2r7xnpdra0dakqsvqryuzxkrd0');
        response.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
        response.send();
        response.onload = () => {
            if (response.readyState === 4) { //
                if (response.status >= 200 && response.status < 400) {
                    const data = JSON.parse(response.responseText); // 將伺服器回傳的資料取出轉成JSON物件
                    CB(data);
                } else {
                    alert('系統不穩定，請再試一次');
                }
            }
        };
    }

    // 切換標籤選取
    function changeAction(newActionLi) {
        liGroup[actionLi].classList.toggle('action'); // 將原標籤列取消選取
        liGroup[newActionLi].classList.toggle('action'); // 新標籤列被選取
        actionLi = newActionLi;
    }

    // 為直播區增加直播box
    function addChannelsList(gameName) {
        channelsList.innerHTML = ''; // 清空直播區
        channelsTitle.innerText = gameName; // 修改主遊戲標題
        getTwitchAPI(channelList, `https://api.twitch.tv/kraken/streams/?game=${gameName}`, (data) => { // 再取得遊戲的頻道資訊
            // console.log(data.streams);
            const streansLimit = data.streams.length;
            for (let i = 0; streansLimit < 20 ? i < streansLimit : i < 20; i += 1) {
                const box = {
                    streamer: data.streams[i].channel.name, // 實況主名稱
                    channelName: data.streams[i].channel.status, // 實況頻道名稱
                    logo: data.streams[i].channel.logo, // 實況頭貼
                    preview: data.streams[i].preview.medium, // 方塊縮圖
                    viewer: data.streams[i].viewers, // 觀看人數
                    node: document.createElement('div'), // 新的盒子元素
                };

                box.node.classList.add('box');
                box.node.title = box.channelName;
                box.node.innerHTML = `
                    <a href="https://www.twitch.tv/${box.streamer}" target="_blank">
                        <div class="box__viewer">●${box.viewer}人</div>
                        <img class="box__preview" src="${box.preview}" />
                            <div class="box__info">
                                <img src="${box.logo}" />
                                <div class="box__info__right">
                                    <div class="box__info__right__title">${box.channelName}</div>
                                    <div class="box__info__right__content">${box.streamer}</div>
                                </div>
                            </div>
                    </a>`;
                channelsList.appendChild(box.node);
            }
        });
    }

    getTwitchAPI(top5Game, 'https://api.twitch.tv/kraken/games/top', (data) => { // 先取得前幾名的遊戲
        // console.log(data.top[0].game.name);
        const top1GameName = data.top[0].game.name;
        for (let i = 0; i < 5; i += 1) {
            liGroup[i].innerText = data.top[i].game.name; // 將前五名的遊戲名稱放入標籤中
            liGroup[i].title = data.top[i].game.name; // 滑鼠移上去時顯示文字
        }
        liGroup[0].classList.toggle('action');
        channelsTitle.innerText = top1GameName; // 修改主遊戲標題
        addChannelsList(top1GameName); // 為直播區增加直播box
    });

    document.querySelector('ul').addEventListener('click', (e) => { // 幫標籤列加事件
        if (e.target.title) {
            changeAction(e.target.value); // 切換標籤選取
            addChannelsList(e.target.title); // 為直播區增加直播box
        }
    });
});
