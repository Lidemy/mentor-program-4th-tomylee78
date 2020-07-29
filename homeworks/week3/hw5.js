const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
    input: process.stdin,
});

rl.on('line', (line) => {
    lines.push(line);
});

function solve(n) {
    const round = n[0];// �x�s���h�֧���

    for (let i = 0; i < round; i += 1) {
        const result = n[i + 1].split(' ');

        const A = result[0];
        const B = result[0];

        if (A === B) { // ���e���@�˴N�O����
            console.log('DRAW');
        } else if (A.length > B.length) { // A��Ƥ����
            if (Number(result[2]) === 1) {
                console.log('A');
            } else if (Number(result[2]) === -1) {
                console.log('B');
            }
        } else if (B.length > A.length) { // B��Ƥ����
            if (Number(result[2]) === 1) {
                console.log('B');
            } else if (Number(result[2]) === -1) {
                console.log('A');
            }
        } else if (B.length === A.length) { // ��ƬۦP�A�q����}�l��
            for (let x = 0; x < B.length; x += 1) {
                if (A[x] > B[x]) {
                    if (Number(result[2]) === 1) {
                        console.log('A');
                        break;
                    } else if (Number(result[2]) === -1) {
                        console.log('B');
                        break;
                    }
                }
                if (B[x] > A[x]) {
                    if (Number(result[2]) === 1) {
                        console.log('B');
                        break;
                    } else if (Number(result[2]) === -1) {
                        console.log('A');
                        break;
                    }
                }
            }
        }
        /* const A = BigInt(result[0]);
        const B = BigInt(result[1]);
        if (A === B) {
            console.log('DRAW');
        } else if (A > B) {
            if (result[2] === 1) {
                console.log('A');
            } else if (result[2] === -1) {
                console.log('B');
            }
        } else if (B > A) {
            if (result[2] === 1) {
                console.log('B');
            } else if (result[2] === -1) {
                console.log('A');
            }
        } */
    }
}

rl.on('close', () => {
    solve(lines);
});
