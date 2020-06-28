function join(arr, concatStr) {
    var arrayLength = arr.length;//取得陣列長度
    var newString = "";//新字串
    for (var i = 0; i < arrayLength; i++) {
        if (i == arrayLength - 1) {
            newString = newString + arr[i];//最後一個時候
        }
        else {
            newString = newString + arr[i] + concatStr;
        }
    }
    return newString;
}

function repeat(str, times) {
    var newString = "";//新字串
    for (var i = 0; i < times; i++) {
        newString = newString + str;
    }
    return newString;
}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));
