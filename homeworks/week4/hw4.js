// eslint-disable-next-line
const request = require('request');// node.js內建模擬Client端發出HTTP request的函式庫，可以做簡單的客戶端模擬請求

request(
    {
        headers: {
            'Client-ID': '64xr2r7xnpdra0dakqsvqryuzxkrd0',
            Accept: 'application/vnd.twitchtv.v5+json',
        },
        url: 'https://api.twitch.tv/kraken/games/top',
    },
    (error, response, body) => { // 發送伺服器規範的HTTP API GET請求
        const json = JSON.parse(body);
        for (let i = 0; i < json.top.length; i += 1) {
            console.log(`${json.top[i].viewers} ${json.top[i].game.name}`);
        }
    },
);
