// eslint-disable-next-line
const request = require('request');// node.js內建模擬Client端發出HTTP request的函式庫，可以做簡單的客戶端模擬請求
const process = require('process');// 用來處理CLI使用者輸入的資料
// eslint-disable-next-line
booksProcess(process.argv[2]);// 將使用者輸入的資料丟進書本函式去判斷

function booksProcess(tag) {
    switch (tag) {
        case 'list':
            request('https://lidemy-book-store.herokuapp.com/books?_limit=20', (error, response, body) => { // 發送伺服器規範的HTTP API GET請求
                const json = JSON.parse(body);
                for (let i = 0; i < 20; i += 1) {
                    console.log(`${i + 1} ${json[i].name}`);
                }
            });
            break;
        case 'read':
            request('https://lidemy-book-store.herokuapp.com/books?_limit=20', (error, response, body) => { // 發送伺服器規範的HTTP API GET請求
                const json = JSON.parse(body);
                console.log(`ID ${process.argv[3]}:${json[process.argv[3]].name}`);
            });
            break;
        case 'delete':
            request.delete(`https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`, (error, response) => { // 發送伺服器規範的HTTP API DELETE請求
                console.log(`Your HTTP Status is ${response.statusCode}`);
            });
            break;
        case 'create':
            request.post( // 發送伺服器規範的HTTP API POST請求
                {
                    url: 'https://lidemy-book-store.herokuapp.com/books',
                    form: { // 留意form的寫法
                        name: process.argv[3],
                    },
                },
                (error, response) => {
                    console.log(`Your HTTP Status is ${response.statusCode}`);
                },
            );
            break;
        case 'update':
            request.patch( // 發送伺服器規範的HTTP API PATCH請求
                {
                    url: `https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`,
                    form: { // 留意form的寫法
                        name: process.argv[4],
                    },
                },
                (error, response) => {
                    console.log(`Your HTTP Status is ${response.statusCode}`);
                },
            );
            break;
        default:
            console.log('Your imput was error!');
            break;
    }
}
