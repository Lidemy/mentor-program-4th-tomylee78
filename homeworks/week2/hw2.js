function capitalize(str) {
    /*�H�U�O�ݿ��D�ذ��������e=.=.....
    var textlenght = str.length;//���o�r�����
    for (var i = 0; i < textlenght; i++) {
        var strAscii = (str.charAt(i)).charCodeAt(0);//�N�r�ꤺ���r���v�@���X�u.charAt()�v�A�����ഫ��ASCII�X

        //��P�w���p�g�ɡA�ഫASCII���j�g
        if (strAscii > 96 && strAscii < 123) {
            str = str.replace(String.fromCharCode(strAscii), String.fromCharCode(strAscii - 32));//�ϥ�Replace�q�Y�}�l�j�M�A����Ĥ@�ӲŦX���r���A�N�N��r���A�åB�ഫ���j�g
            break;//�u�B�z�r�ꪺ�r���A�ҥH�B�z������X�j��
        }
    }*/

    var strAscii = str.charCodeAt(0);//���o�r��Ĥ@�Ӧr����ASCII�X
    //��P�w���p�g�ɡA�ഫASCII���j�g
    if (strAscii > 96 && strAscii < 123) {
        str = str.replace(String.fromCharCode(strAscii), String.fromCharCode(strAscii - 32));//�ϥ�Replace�q�Y�}�l�j�M�A����Ĥ@�ӲŦX���r���A�N�N��r���A�åB�ഫ���j�g     
    }
    return str;
}

console.log(capitalize('hello'));
