- 先自首...學完就忘，看到題目就傻住了....
- 此題是物件的`this`，物件情況下，`this`對應的東西跟函式在哪呼叫有關，但跟`this`寫在哪裡無關，所以`obj.inner.hello()`實際上是可以寫成`obj.inner.hello.call(obj.inner)`，所以`this`指向obj.inner，也因此obj.inner的value為2
- 第二個obj2.hello()同第一個的原理，可以改寫成obj2.hello.call(obj2)，而obj2又是obj.inner，所以可以寫成obj2.hello.call(obj.inner)，傳入的是obj.inner，因此結果同樣為2
- 第三個單純的`hello()`，儘管是指向`obj.inner.hello`這個函式，但因為上面提到物件內的`this`會根據在哪裡呼叫而定，所以`hello()`實際上是變成`obj.inner.hello.call(undefined)`，把undefined傳給`this`，所以輸出也是undefined
- 最後輸出結果為

```jsx
2
2
undefined
```