// eslint-disable-next-line
const request = require('request');// node.js���ؼ���Client�ݵo�XHTTP request���禡�w�A�i�H��²�檺�Ȥ�ݼ����ШD
const process = require('process');// �ΨӳB�zCLI�ϥΪ̿�J�����


request(`https://restcountries.eu/rest/v2/name/${process.argv[2]}`, (error, response, body) => { // �o�e���A���W�d��HTTP API GET�ШD
    const json = JSON.parse(body);
    const num = json.length;// �d�ߨ�X����a

    if (response.statusCode !== 404) { // �����Ʈ�
        for (let i = 0; i < num; i += 1) {
            console.log('============');
            console.log(`��a�G${json[i].name}`);
            console.log(`�����G${json[i].capital}`);
            console.log(`�f���G${json[i].currencies[0].code}`);
            console.log(`��X�G${json[i].callingCodes}`);
        }
    } else {
        console.log('�䤣���a��T');
    }
});
