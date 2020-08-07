## 請以自己的話解釋 API 是什麼

- 先前一直以為API是很玄的東西，但這段時間或多或少接觸後，融合以前碰過的東西，直白地來講就是「照規矩辦事，你跟我要什麼，我就給你(幫你做)什麼」，甚至是一般的函式呼叫我都覺得算是一種API，我不需要管裡面到底是怎麼做的，我只知道我呼叫你(函式)辦事，給了你要的東西(參數)，然後你就會給我或是幫我做到什麼事情。
- 以我先前寫外掛的例子來說，我不用管按鍵精靈到底如何操控滑鼠的，我只需要知道我想讓滑鼠移動，只要呼叫按鍵精靈提供的滑鼠移動函式，給定X、Y兩個值，按鍵精靈就會幫我移動到螢幕上對應的位置。
- 又或者是按鍵精靈之餘Windows作業系統，關於滑鼠底層真正的移動方式，還是靠Windows釋出的硬體操控API，按鍵精靈在根據這些API文件，將這些操控滑鼠的方式，以更簡單的VB語言包裝成親民的指令提供給按鍵精靈使用者。
- 另外不知道這樣算不算是API，就是去銀行櫃檯領錢存錢，你只需要跟銀行櫃員說我要存(領)錢，並填寫規定的提存款單據，銀行櫃檯人員就會根據你的需求將你的錢領出或存入。我們不需要知道銀行後面那些錢究竟實際上放哪去或是從哪邊領出來的，只需要依照銀行的規定辦理手續就可以完成提存款動作，所以我認為這也算是一種API。

## 請找出三個課程沒教的 HTTP status code 並簡單介紹

- 好巧不巧，一個多月前被前公司老闆狠K一頓，說不要在公眾群組問504是什麼的這種蠢問題

### 504 Gateway Timeout

- 如標題所言，路由器回應時間太長。通常不是網路塞車，就是伺服器炸裂造成。我遇到的情況是，作為VM Storage的NAS(貧窮版)被客戶從其他不合法的管道塞了一堆容量到不允許的地方，壓迫到其他正常執行的VM，所以某個正在使用的網頁平台就會經常跳出504的訊息，效果是點下按鈕後瀏覽器一直轉轉轉沒反應，要過一兩分鐘後重新刷新或是再點選按鈕才有反應。頻率大概兩分鐘一次。

## 511 Network Authentication Required

- 這個沒遇過，看說明似乎是要求存取未經許可的網路連線時，會回傳此代碼要求客戶需先進行身分驗證才可使用。

## 305 Use Proxy

- 伺服器似乎會檢查要求連線的客戶端是否經由代理伺服器而來，若不是的話會返回此狀態碼告知客戶端必須經由指定的代理伺服器向伺服器發出請求才能允許取得相關資源。回傳的標頭含有Locaiton，代表代理伺服器的位置。

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

- 算是仿照作業一那樣列出相關API

## Base：https://kankore-ramenkikan.com.jp

### 回傳所有餐廳資料

- Method：GET
- Path：/all
- 範例：https://kankore-ramenkikan.com.jp/all

### 回傳單一餐廳資料-1

- Method：GET
- Path：/restaurant/:name
- 參數說明：name為拉麵店的店名
- 範例：https://kankore-ramenkikan.com.jp/restaurant/itoramen

### 回傳單一餐廳資料-2

- Method：GET
- Path：/restaurant/:id
- 參數說明：id為拉麵店的編號
- 範例：https://kankore-ramenkikan.com.jp/restaurant/18

### 回傳區域內的所有餐廳資料

- Method：GET
- Path：/restaurant/:area
- 參數說明：area為拉麵店的所在地區，以縣市做分類
- 範例：https://kankore-ramenkikan.com.jp/restaurant/newtaipeicity

### 刪除一筆餐廳資料-1

- Method：DELETE
- Path：/restaurant/:name
- 參數說明：name為拉麵店的店名
- 範例：https://kankore-ramenkikan.com.jp/restaurant/itoramen

### 刪除一筆餐廳資料-2

- Method：DELETE
- Path：/restaurant/:id
- 參數說明：id為拉麵店的編號
- 範例：https://kankore-ramenkikan.com.jp/restaurant/18

### 新增一筆餐廳資料

- Method：POST
- Path：/restaurant/:name
- 參數說明：name為拉麵店的店名
- 範例：https://kankore-ramenkikan.com.jp/restaurant/itoramen

```jsx
{    
    "area": "拉麵店所在的區域"
}
```

### 修改一筆餐廳資料-1

- Method：PATCH
- Path：/restaurant/:name
- 參數說明：name為拉麵店的店名
- 範例：https://kankore-ramenkikan.com.jp/restaurant/itoramen

```jsx
{    
		"name": "拉麵店的店名"
    "area": "拉麵店所在的區域"
}
```

### 修改一筆餐廳資料-2

- Method：PATCH
- Path：/restaurant/:id
- 參數說明：id為拉麵店的編號
- 範例：https://kankore-ramenkikan.com.jp/restaurant/18

```jsx
{    
		"name": "拉麵店的店名"
    "area": "拉麵店所在的區域"
}
```