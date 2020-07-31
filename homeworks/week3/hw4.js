const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
    input: process.stdin,
});

rl.on('line', (line) => {
    lines.push(line);
});

function solve(n) {
    //  var int = parseInt(n[0]);
    let temp = '';
    for (let i = n[0].length - 1; i >= 0; i -= 1) {
        temp += n[0][i];
    }
    if (temp === n[0]) {
        console.log('True');
    } else {
        console.log('False');
    }
}

rl.on('close', () => {
    solve(lines);
});
