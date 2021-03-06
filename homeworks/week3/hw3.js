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
            const temp = parseInt(n[i], 10);// 目前判斷的數字
            let isPrime = true;
            for (let x = 1; x <= temp; x += 1) {
                // 當數字可以被不是1或自己的數整除時，他就不是質數
                if ((temp % x === 0) && x !== 1 && x !== temp) {
                    isPrime = false;
                    break;
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
