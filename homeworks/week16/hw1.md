[setTimeout()](https://www.notion.so/setTimeout-e643acd17b5c4a11bfe0c55d6767c1b0) 

- 因為是`setTimeout()`這個等待後執行函式的指令，所以我參考當初自己筆記內的`setTimeout()`定義，發現`setTimeout()`是執行一個回呼函式，也就是肥同步函式，這也導致真正`setTimeout()`執行的順序沒有一定的先後之分，因為第二個參數是保證「至少」會在 X 秒後執行，但不能保證 X秒的時候一定執行
- 所以外部`console.log()`的排序一定是135，而透過`setTimeout()`輸出的2一定在1後面，4擇一定在1跟3後面