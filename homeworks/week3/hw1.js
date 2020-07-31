const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
    input: process.stdin,
});

rl.on('line', (line) => {
    lines.push(line);
});

function solve(n) {
    const int = parseInt(n[0], 10);
    let star = '';
    for (let i = 0; i < int; i += 1) {
        star = `${star}*`;
        console.log(star);
    }
}

rl.on('close', () => {
    solve(lines);
});
