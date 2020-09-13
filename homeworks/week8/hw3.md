## 什麼是 Ajax？

- Asynchronous JavaScript And XML-AJAX技術
- 凡是透過任何非同步的方式和伺服器交換資料的JavaScript都算是AJAX
- 早期的資料格式是以XML來儲存，但現在大多已改成用JSON格式儲存，然而名稱仍然沒改變還是叫AJAX
- 只要見到網頁跟後台傳遞資料，但卻沒有刷新整個網頁，而是只更新網頁的部分內容，那就是AJAX了

## 用 Ajax 與我們用表單送出資料的差別在哪？

- form比起跟伺服器交換資料，更像是我要到目標頁面，並且前往時帶著參數前往
因此這樣會將整個頁面刷新洗掉，因為伺服器會直接將資料回覆給瀏覽器本身做渲染
- 跟form傳遞資料不同的地方在於，伺服器最後是將資料回傳到瀏覽上的JavaScript，這時候JavaScript即可透過取得的資料用事件處裡來修改最終瀏覽器上的顯示效果，也因此不需要整個刷新瀏覽器頁面

## JSONP 是什麼？

- JSON with Padding→簡稱JSONP，其中padding在這裡有填充的意思
- 此方式是利用瀏覽器不會針對HTML的`<script>`標籤判定同源的特性，事先存取伺服器端的js檔案，而JS檔案裡面放置的function實際上是真正要傳送的資料，這樣在本地端的JavaScript內只要含有同名的函式，即可輕易存取裡面的內容
- JSONP 的缺點就是你要帶的那些參數永遠都只能用附加在網址上的方式（GET）帶過去，沒辦法用 POST

## 要如何存取跨網域的 API？

- 在node.js環境下無此問題
- 因為瀏覽器的限制，需使用跨來源資源共用 Cross-Origin Resource Sharing CORS
- 方法是在request的header中，加入access-control-allow-origin
- 因為瀏覽器在向目標伺服器發出請求時，會在標頭中加入`origin`，代表你的來源是哪裡，而伺服器會根據origin的內容，判斷是否要給予正確的response
- 因此如果在不同源的情況下，若伺服器的response沒有加入access-control-allow-origin並且含有你這邊的origin，那麼是絕對沒辦法拿到伺服器的response的!
- 有些access-control-allow-origin可以在response的header上看到，而值為`*`，代表所有的origin都可以存取
- 有些HTML標籤不受同源政策的影響，例如顯示圖片的`<img>`，以及載入JavaScript的`<script>`，一些CDN節點所存取的資料也不在此限制

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？

- 主要是因為兩者的runtime環境不同所致，在node.js上想做任何請求跟資料傳輸都沒任何問題，但瀏覽器為了使用者的安全性問題，避免A網站私自竊取使用者在其他網站的資料，所以增加了同源政策Same Orogin Policy，凡是協定不對、port號不對、網域不對基本上是不能取得伺服器資料的
- 當然該請求本身是會發給伺服器，伺服器也會發回應回來，但是會被瀏覽器擋下