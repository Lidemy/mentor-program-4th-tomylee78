function reverse(str) {
    var temp = null;//暫存字元
    var newString = "";
    var strLength = str.length;//取得字串長度

    for (var i = 0; i < strLength; i++) {
        temp = str.charAt(strLength - 1 - i);
        newString = newString + temp;
    }
    console.log(newString);
}

reverse('hello');
