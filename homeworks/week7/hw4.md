﻿## 什麼是 DOM？

- 表面上意思是將文件轉換成物件模型，實際上就是將程式碼內`body`裡的元素全部轉換成JavaScript可以使用的物件，這樣就可以用JavaSctipt改變html裡的值，存取方式主要是靠類似C#的`.`來向下面階層的標籤存取東西，經常會使用到的就是`.target`，可以透過Dev Tool工具查看e.target的內容，再根據階層輸入對應的指令存取更裡面的屬性值

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？

- 事件在傳遞時，會由根節點一路將事件傳遞到目標Target上，這種由根節點到目標Target的過程稱為捕獲，而由目標Target將事件一路傳回到跟節點的過程，則稱為冒泡。
- 有點類似游泳下潛的概念，在水面上開始往下潛稱為捕獲(下潛去海底捕獲貝類)，而從碰到底部再上來水面換氣的時候則稱為冒泡(跟著氣泡上浮回海面上換氣)
- 預設情況下，先捕獲、再冒泡，而當事件傳到 target 本身，沒有分先捕獲或是先冒泡，因為Targer Phase在最底層的關係，所以會依據程式碼先後順序決定先捕獲還是先冒泡，然而上面那面那樣講也有需要修正的地方，那就是Targer Phase做為和Capture Phase跟Bubble Phase不同的階段，實際上是沒有冒泡或捕獲這樣的說法。

## 什麼是 event delegation，為什麼我們需要它？

- event delegation稱為事件代理。可以利用事件傳遞的機制，實作出事件代理(Delegation)，因為事件的傳遞是依循著捕獲及冒泡機制而運行，由上層的事件會一路傳遞到下層的事件，同樣的監聽這事情也會因此而賦予下面的子元素都有監聽的效果，換句話說子元素是否觸發功能或傳遞事件，完全可透過上面母元素來設定。
- 因此若有有1000個性質相似的元素想要加入監聽事件，那麼只要在外層包上一個母元素，為母元素加上監聽事件，即可讓底下的1000個子元素都擁有監聽事件的效果。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

- `preventDefault()`是用來停止目標元素的效果，例如停止按下按鈕或超連結時會傳導到其他網頁。
- `stopPropagation()`則是阻止事件往後繼續傳遞，例如擁有多層次的滑鼠點擊事件，可以設定在某一層結束後，滑鼠點擊事件不繼續往後傳送下去。注意`stopPropagation()`是阻止事件的傳遞，但本身的事件仍然會觸發到
- 假設我在三個階層的div中，於最底下的一層加上Button按鈕，Button按鈕本身會重新轉導頁面，那麼在Button按鈕上增加滑鼠點擊事件並加入`preventDefault()`，實際點擊時網頁並不會重新轉導，但滑鼠點擊事件本身會從最上層的div一路傳遞到下面的Button按鈕，在重新傳回到最上一層。而Button按鈕上增加滑鼠點擊事件並改加入`stopPropagation()`，頁面本身會重新轉導，但滑鼠事件傳遞則只會由上傳遞到下面的Button按鈕就停止再傳送事件了
- 需要注意的是，當在捕獲階段有觸發`preventDefault()`，那麼該效果就會一路往下傳遞到底層的Targer Phase上，因此可以設定當最外層的**Windows**含有click的`preventDefault()`效果時，那麼底下所有html裡面的標籤都會連帶地含有`preventDefault()`