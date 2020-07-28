var readline = require('readline');

var lines = []
var rl = readline.createInterface({
    input: process.stdin
});

rl.on('line', function (line) {
    lines.push(line)
});

rl.on('close', function () {
    solve(lines)
})

function solve(n) {
    var int = parseInt(n[0]);
    var star = "";
    for (var i = 0; i < int; i++) {
        star = star + "*";
        console.log(star);
    }
}