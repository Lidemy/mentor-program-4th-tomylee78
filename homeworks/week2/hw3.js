function reverse(str) {
    var temp = null;//�Ȧs�r��
    var newString = "";
    var strLength = str.length;//���o�r�����

    for (var i = 0; i < strLength; i++) {
        temp = str.charAt(strLength - 1 - i);
        newString = newString + temp;
    }
    console.log(newString);
}

reverse('hello');
