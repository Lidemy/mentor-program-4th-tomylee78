## Webpack 是做什麼用的？可以不用它嗎？

- Webpack是一個模組包產生工具 (module bundler)，把各家各自為政的模組化函式庫打包在一起，這樣瀏覽器引入只要引入單一資源庫即可使用所有東西。而一些自定義的函式庫也可以以檔案為單位進行匯入與管理，而不用再全部寫在同一份檔案內
- Webpack最大的目標就是實現模組化管理的目的，以目前的連覽器支援度而言，較新的瀏覽器也支援模組化匯入的功能，叫ES Modules ，除了引入的JS檔以及被引入的函式庫，在網頁上還得宣告`<script> src="JS檔路徑" type="module" </script>`，這樣才算是完整的瀏覽器引入，而要真正能使用還得把這些檔案放在伺服器端才可正常執行
- 所以說不用Webpack 也是可以正常引入函式的，不過跟複雜度相比，目前還是Webpack比較好用些

## gulp 跟 webpack 有什麼不一樣？

- 儘管做的事情類似，但兩者有本質上的不同，可以把gulp想像成排成管理器，只要執行gulp，裡面就會開始執行你預先設定好的排成，不僅限於轉檔、編碼，能做到的事情比Webpack更多
- 而webpack 就單純只是模組打包工具，把任何專案會引用的模組通通打包在一起，不管是js檔、CSS檔、圖片檔通通都能打包成單一檔案，這樣的好處是在引用這些資源時，只要匯入一個檔案，裡面就包山包海可以任你呼叫裏頭已經打包在裡面的相關資源

## CSS Selector 權重的計算方式為何？

- CSS的特色是權重高的覆蓋權重低的效果，相同權重下後面的樣式會覆蓋前面的樣式，每條CSS都可以透過選擇器的寫法來疊加權重分數。而權重的用法可以方便的讓使用者針對目標html元素進行CSS設定
    - 以分數來比較的話元素為1分，class為10分，ID為100分，inline style為1000分，!important為10000分

### 元素

- 元素指的就是html的標籤，例如下面這樣子寫法就是2分，因為一條CSS選擇器中包含兩個元素

```css
div p {
   color : black;
}
```

### class

- 這裡指的就是在元素內class屬性中的名稱，在選擇器中會用`.`代表此為class名稱，每個class為10分，例如下面就是2個元素加兩個class，為22分

```css
div.navbar p.content {
   color : black;
}
```

### ID

- ID指的是html元素內ID屬性中的名稱，在選擇器中會用#代表ID，每個ID為100分，通常一個網頁中只會有一個ID，例如下面就是2個元素加兩個class加1個ID，為122分

```css
div.navbar p.content #uid {
   color : black;
}
```

### inline style

- 這裡指的是在網頁上的元素內，直接用style屬性撰寫CSS內容，例如下面這樣就是1000分

```css
<div id="uid" class="navbar" style="color : black">
   inline style 效果
</div>
```

### !important

- 算是滿特殊的寫法，方法是在CSS的語法項目後面加個`!important`，但是Bootstrap很多都是用!important強制複寫CSS效果，好讓Bootstrap的效果能夠優先於其他CSS之前，例如下面這寫法就是2個元素加兩個class加1個ID加一個!important，為10122分

```css
div.navbar p.content #uid {
   color : black !important;
}
```