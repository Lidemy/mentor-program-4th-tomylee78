// eslint-disable-next-line
const request = require('request');// node.js���ؼ���Client�ݵo�XHTTP request���禡�w�A�i�H��²�檺�Ȥ�ݼ����ШD

request('https://lidemy-book-store.herokuapp.com/books?_limit=10', (error, response, body) => { // �o�e���A���W�d��HTTP API GET�ШD
    const json = JSON.parse(body);
    console.log('JSON�榡������G');
    console.log(json);

    for (let i = 0; i < 10; i += 1) {
        console.log(`${i + 1} ${json[i].name}`);
    }
});
