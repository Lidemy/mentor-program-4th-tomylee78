function printFactor(n) {
    for (var i = 1; i <= n; i++) {
        //當取餘數為0時，就代表是因數(可以整除)
        if (n % i == 0) {
            console.log(i);
        }
    }
  
}

printFactor(10);
