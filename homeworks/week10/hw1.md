## 六到十週心得與解題心得

### 第十週作業

- 先來講講第十週的作業-綜合能力測驗， 破關後還真有種錯愕感，倒不是關卡設計得不好，而是..就一關呀?本來已經打定好要長期奮戰闖十關了，突然軟掉Orz
- 不過這唯一的一關我也卡住了，卡在沒注意到 JavaScript 可以直接用 Console 來設定，我還拿了第四週用來發出請求的 Node.js 來發 Request。第二個卡的則是沒意識到那一串亂數是SHA1的編碼，警覺性也太低了我-.-
- 而助教寫的關卡，第六關真的是長知識了，原來還有顏文字編碼的aaencode，不過東西閱讀起來果然有點頭痛，最後是網路上找aaencode的加解密工具
- 第九關也智障一波，雖然能理解`ord($token[$i]) * ord($token[$i - 1])) % $i !== 0`的關係，但一度以為真的要暴力解而跑去寫程式碼，但後來在看更仔細以及提示後，發現只要推敲就可以過關了 (雖然還要查表)，不過也是學到了 `ord()` 跟 `strlen()` 這兩個指令的用法
- 第十關也比蠢的，下面的系統提示都說用POST去找Token了，結果我用 Node.js 試一直在用本來程式碼中的 OPTIONS，結果怎麼測都是Null....
- 其實滿多時候都沒注意到應該先從網頁內的js檔案開始看起，但好像也沒印象哪裡有提示說可以去那裏看看，不過後面的題目幾乎大部分都得要看這個檔案的東西才解的開
- 第十四關真的滿厲害的，我還真的沒認真想到是用DevTool看回應的時間，而是直接用Node.js寫一個1到9999的迴圈，只要不是「回來了?」就是正確答案，然後就爆掉了，笑死XDDD

```jsx
function paddingLeft(str, lenght) {
    if (str.length >= lenght)
        return str;
    else
        return paddingLeft("0" + str, lenght);
}

for (let i = 0; i < 1000; i++) {
    let temp = i;
    temp = paddingLeft(temp, 4);
    console.log(`i=${temp}`);
    request(
        {
            url: `https://r30challenge.herokuapp.com/lv14.php?token=${temp}`,
        }, (error, response, body) => { //發送伺服器規範的HTTP API  GET請求
            if (body !== '回來了？') {
                console.log(`answer=${temp}`);
            }
        }
    );
}
```

- 第十五關也是挺燒腦袋的，我最困擾這種跟看天能一樣腦袋會當機的邏輯題目了  囧，而且這次還卡著時間限制在裡面，最後大懶人直接複製程式碼然後用往後推五分鐘一個一個測試字母
- 然後還發現了一個問題，那就是這題目在午夜12點的時候是爆炸解不出來的，也許應該要調整count要大於100的這個設定

```php
<?php
    function isTokenValid($token) {
        $h = 9;
        $m = 22;
        $a = $h * $m + 42;
        $count = 0;
        for($i = 0; $i < 8; $i++) {
            $count += ord($token[$i]) - 65;
        }
        echo 'count=' . $count . '</br>';
        if ($count <= 100) {
            return false;
        }

        echo 'a=' . $a. '</br>';
        echo 'count=' . $count. '</br>';
        echo 'a % count=' . ($a % $count). '</br>';
        return $a % $count === 0;
    }

    isTokenValid('ZZXXAAQI');

?>
```

## 第二階段心得

- 相比起最一開始的前五週，之後的五週資訊量真的是超級大爆炸，實在很難想像一個多月前我連怎麼生出網頁都不曉得，就更不用說幫網頁加上登入註冊功能讓前後端串接在一起了，根本就進步神速!
- 不過最一開始的第六真的超辛苦，很多標籤效果要去熟悉，並且也是第一次切板，都切到懷疑人生了，當然就算到現在第十週結束，對於切板還是挺苦手的，甚至比寫JavaScript跟PHP還累，歸根究柢主要還是flex幾個主要的指令沒有到很熟，再來就是調RWD很花時間，甚至手機板在iphone上可以，但換到三星就爆給你看，有時候架構階層一多起來，都搞不清楚是父元素影響還是本身元素影響顯示效果的
- 教學上最讓我有感的就是第九週吧，跟以前不一樣的是老師引導發現問題的學習過程讓大家去關注陽春版的問題所在，當然這也不是讓學生自己去摸索問題，而是說一開始先教不完美的基礎版，之後再開始做精進
- 另外Session的講述也是我很喜歡的地方，先用手工版帶我們實際了解運作原理，之後才用PHP內建的Session，實際做過後就很能了解Session跟Cookie的關係了
- 目前七八九週都有個還算像樣的作業出來，整體來講算滿意，不過進度毫無長進就是了...依然落後一個月左右的時間-.-

[Just A Bite!](https://lidemy.github.io/mentor-program-4th-tomylee78/homeworks/week7/hw3/)

[圖奇熱門遊戲面板](https://lidemy.github.io/mentor-program-4th-tomylee78/homeworks/week8/hw2/)

### 手工Session版

[](https://mentor-program.co/mtr04group2/tomylee78/9w/manual/index.php)

### PHP內建Session版

[看口雷留言板](https://mentor-program.co/mtr04group2/tomylee78/9w/automatic/index.php)