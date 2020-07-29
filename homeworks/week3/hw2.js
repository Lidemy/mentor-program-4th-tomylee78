const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
    input: process.stdin,
});

rl.on('line', (line) => {
    lines.push(line);
});

function solve(n) {
    const int1 = parseInt((n[0].split(' '))[0], 10);
    const int2 = parseInt((n[0].split(' '))[1], 10);

    for (let i = int1; i <= int2; i += 1) {
        const str = i.toString();
        const pow = str.length;// 確認位數->次方曙
        let total = 0;// 總數
        for (let x = 0; x < pow; x += 1) {
            total += (parseInt(str[x], 10) ** pow);
        }
        if (i === total) {
            console.log(i);
        }
    }
}

rl.on('close', () => {
    solve(lines);
});
