// eslint-disable-next-line
const request = require('request');// node.js���ؼ���Client�ݵo�XHTTP request���禡�w�A�i�H��²�檺�Ȥ�ݼ����ШD
const process = require('process');// �ΨӳB�zCLI�ϥΪ̿�J�����
// eslint-disable-next-line
booksProcess(process.argv[2]);// �N�ϥΪ̿�J����ƥ�i�ѥ��禡�h�P�_

function booksProcess(tag) {
    switch (tag) {
        case 'list':
            request('https://lidemy-book-store.herokuapp.com/books?_limit=20', (error, response, body) => { // �o�e���A���W�d��HTTP API GET�ШD
                const json = JSON.parse(body);
                for (let i = 0; i < 20; i += 1) {
                    console.log(`${i + 1} ${json[i].name}`);
                }
            });
            break;
        case 'read':
            request('https://lidemy-book-store.herokuapp.com/books?_limit=20', (error, response, body) => { // �o�e���A���W�d��HTTP API GET�ШD
                const json = JSON.parse(body);
                console.log(`ID ${process.argv[3]}:${json[process.argv[3]].name}`);
            });
            break;
        case 'delete':
            request.delete(`https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`, (error, response) => { // �o�e���A���W�d��HTTP API DELETE�ШD
                console.log(`Your HTTP Status is ${response.statusCode}`);
            });
            break;
        case 'create':
            request.post( // �o�e���A���W�d��HTTP API POST�ШD
                {
                    url: 'https://lidemy-book-store.herokuapp.com/books',
                    form: { // �d�Nform���g�k
                        name: process.argv[3],
                    },
                },
                (error, response) => {
                    console.log(`Your HTTP Status is ${response.statusCode}`);
                },
            );
            break;
        case 'update':
            request.patch( // �o�e���A���W�d��HTTP API PATCH�ШD
                {
                    url: `https://lidemy-book-store.herokuapp.com/books/${process.argv[3]}`,
                    form: { // �d�Nform���g�k
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
