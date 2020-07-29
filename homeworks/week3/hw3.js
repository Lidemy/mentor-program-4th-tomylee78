const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
    input: process.stdin,
});

rl.on('line', (line) => {
    lines.push(line);
});

function solve(n) {
    // var int = parseInt(n[0]);
    for (let i = 1; i < n.length; i += 1) {
        if (parseInt(n[i], 10) === 2) {
            console.log('Prime');
        } else if (parseInt(n[i], 10) === 1) {
            console.log('Composite');
        } else {
            const temp = parseInt(n[i], 10);// �ثe�P�_���Ʀr
            let isPrime = true;
            for (let x = 1; x <= temp; x += 1) {
                // ��Ʀr�i�H�Q���O1�Φۤv���ƾ㰣�ɡA�L�N���O���
                if ((temp % x === 0) && x !== 1 && x !== temp) {
                    isPrime = false;
                }
            }
            if (isPrime) {
                console.log('Prime');
            } else {
                console.log('Composite');
            }
        }
    }
}

rl.on('close', () => {
    solve(lines);
});
