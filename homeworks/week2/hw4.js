function printFactor(n) {
    for (var i = 1; i <= n; i++) {
        //����l�Ƭ�0�ɡA�N�N��O�]��(�i�H�㰣)
        if (n % i == 0) {
            console.log(i);
        }
    }
  
}

printFactor(10);
