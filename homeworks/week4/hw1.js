// eslint-disable-next-line
const request = require('request');// node.js內建模擬Client端發出HTTP request的函式庫，可以做簡單的客戶端模擬請求

request('https://lidemy-book-store.herokuapp.com/books?_limit=10', (error, response, body) => { // 發送伺服器規範的HTTP API GET請求
    const json = JSON.parse(body);
    console.log('JSON格式的物件：');
    console.log(json);

    for (let i = 0; i < 10; i += 1) {
        console.log(`${i + 1} ${json[i].name}`);
    }
});
