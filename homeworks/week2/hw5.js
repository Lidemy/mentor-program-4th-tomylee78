function join(arr, concatStr) {
    var arrayLength = arr.length;//���o�}�C����
    var newString = "";//�s�r��
    for (var i = 0; i < arrayLength; i++) {
        if (i == arrayLength - 1) {
            newString = newString + arr[i];//�̫�@�Ӯɭ�
        }
        else {
            newString = newString + arr[i] + concatStr;
        }
    }
    return newString;
}

function repeat(str, times) {
    var newString = "";//�s�r��
    for (var i = 0; i < times; i++) {
        newString = newString + str;
    }
    return newString;
}

console.log(join(['a'], '!'));
console.log(repeat('a', 5));
