// eslint-disable-next-line
const request = require('request');// node.js���ؼ���Client�ݵo�XHTTP request���禡�w�A�i�H��²�檺�Ȥ�ݼ����ШD

request(
    {
        headers: {
            'Client-ID': '64xr2r7xnpdra0dakqsvqryuzxkrd0',
            Accept: 'application/vnd.twitchtv.v5+json',
        },
        url: 'https://api.twitch.tv/kraken/games/top',
    },
    (error, response, body) => { // �o�e���A���W�d��HTTP API GET�ШD
        const json = JSON.parse(body);
        for (let i = 0; i < json.top.length; i += 1) {
            console.log(`${json.top[i].viewers} ${json.top[i].game.name}`);
        }
    },
);
