## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。

### <audio>

- 用來控制瀏覽器撥放音樂的音樂撥放器，需宣告`controls`屬性，裡面一層則用`source`宣告來源，`src`參數放檔案位置，`type`參數放檔案格式

```html
<audio controls>
        <source src="./3.wav" type="audio/mp4">                
    </audio>
```

![https://i.imgur.com/eT9fTOd.png](https://i.imgur.com/eT9fTOd.png)

## <b>

- 算是滿簡單的語法，用來讓html內的文字變成粗體

```html
<b>裡面是粗體字</b>
```

## <cite>

- 跟`<title>`滿類似的語法，屬於Semantic的標籤，跟`<title>`最大的差別是`<title>`用在網頁上面分頁的文字顯示，而`<cite>`則是用在內文中針對作品、或是一個主題所訂定的「標題」。所以作業1的菜單網頁中，menu搶先看等標題我認為都可以使用這個標籤

## 請問什麼是盒模型（box modal）

- 在CSS中用來表示html裡面元素的視覺效果用，由最外層的margin、框線的border、內部的padding、元素本體的content，想像成是洋蔥一層一層包覆的樣子。
- margin是元素本身向外延伸的距離
- border指的是元素的外框線調本身
- padding則是元素向內推的距離(和本體content之間的距離)
- 儘管實際CSS顯示相同，但其實可能是用不同的margin、border、padding參數所做出來的效果，而在CSS標籤語法含有繼承及覆蓋的特性，很有可能眼前的效果是從其他class繼承來的樣式

## 請問 display: inline, block 跟 inline-block 的差別是什麼？

### block

- 包含常見的<div>、<h1>、<p>，怎麼調都可以
- 儘管有設定寬度，但通常會占滿一整行

### inline

- 代表的有<span>、<a>，調寬高、上下都沒用
- 寬度會根據內容而做調整
- 設定`margin`會改變左右的間距，但不會更動到上下的間距
- 設定padding會身的文字內容左右會改變，但是位置不會改變，因此才是所謂的上下都沒用，而左右確實會隨著`padding`的設定而改變座標位置，但如果加上底色後，可以發現底色會隨著`padding`而改變，但不影響實際文字的顯示位置，因此才會說上下都沒用

### inline-block

- 將iinline和block的優點結合起來
- 對外向inline一樣可以併排、對內像block可以任意調整
- 代表的有`<button>`、`<input>`、`<select>`
- 真要說具體的差別，那就是一般的block一行只能放一個元素，但是inline-block可以放多個元素

inline-block不能貼齊並排的小陷阱!!!

- 這是因為在預設情況下，會把程式碼中元素之間的空格給渲染出來，因此瀏覽器顯示也會照著把這些空格給描繪出來形成間距
- 這時候推薦設定負值Margin或取消`inline-block;` 改用`float: left`

[【笨問題】Inline-Block元素多出來的間隙-黑暗執行緒](https://blog.darkthread.net/blog/inline-block-redundant-space/)

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？

### static

- 一般情況下瀏覽器的`position`預設值為`static`
- `static`會根據物件本身的特性進行排列，例如div一定是一整個行、span可以並排在一起之類的

### relative

- 相對位置
- 如果將`position`設定成`relative`，那麼就可設定上`top`下`bottom`左`left`右`right`設定距離座標點的相對位置，也就是距離左上角的(0,0)的相對位置，此種方式不會更動到其他人的座標位置，只會修改到自己的座標位置

### fixed

- 固定定位，相對於瀏覽器視窗的位置做定位，也就是常見的浮動功能
- 更精確的說法是，相對於Viewport(顯示區域)做定位

## absolute

- 絕對位置
- 針對某個參考點進行定位，而非預設的原本排版的元素左上角做參考點
- 上面提到的某個參考點，定義是「往上找第一個不是`static`的元素」
- 而當相同階層的元素有人使用`absolute`時，該元素就會被抽離原本的坐標系，而讓後續的元素替補上來

留意`relative`不管怎麼搞都不會影響到其他人
但是`absolute`會影響到後面的元素可能替補上來