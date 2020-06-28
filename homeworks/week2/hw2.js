function capitalize(str) {
    /*以下是看錯題目做錯的內容=.=.....
    var textlenght = str.length;//取得字串長度
    for (var i = 0; i < textlenght; i++) {
        var strAscii = (str.charAt(i)).charCodeAt(0);//將字串內的字元逐一取出「.charAt()」，接著轉換成ASCII碼

        //當判定為小寫時，轉換ASCII為大寫
        if (strAscii > 96 && strAscii < 123) {
            str = str.replace(String.fromCharCode(strAscii), String.fromCharCode(strAscii - 32));//使用Replace從頭開始搜尋，當找到第一個符合的字元，就代表字首，並且轉換成大寫
            break;//只處理字串的字首，所以處理完後跳出迴圈
        }
    }*/

    var strAscii = str.charCodeAt(0);//取得字串第一個字元的ASCII碼
    //當判定為小寫時，轉換ASCII為大寫
    if (strAscii > 96 && strAscii < 123) {
        str = str.replace(String.fromCharCode(strAscii), String.fromCharCode(strAscii - 32));//使用Replace從頭開始搜尋，當找到第一個符合的字元，就代表字首，並且轉換成大寫     
    }
    return str;
}

console.log(capitalize('hello'));
