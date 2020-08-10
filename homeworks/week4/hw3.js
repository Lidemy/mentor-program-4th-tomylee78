// eslint-disable-next-line
const request = require('request');// node.js內建模擬Client端發出HTTP request的函式庫，可以做簡單的客戶端模擬請求
const process = require('process');// 用來處理CLI使用者輸入的資料


request(`https://restcountries.eu/rest/v2/name/${process.argv[2]}`, (error, response, body) => { // 發送伺服器規範的HTTP API GET請求
    const json = JSON.parse(body);
    const num = json.length;// 查詢到幾筆國家

    if (response.statusCode !== 404) { // 當找到資料時
        for (let i = 0; i < num; i += 1) {
            console.log('============');
            console.log(`國家：${json[i].name}`);
            console.log(`首都：${json[i].capital}`);
            console.log(`貨幣：${json[i].currencies[0].code}`);
            console.log(`國碼：${json[i].callingCodes}`);
        }
    } else {
        console.log('找不到國家資訊');
    }
});
