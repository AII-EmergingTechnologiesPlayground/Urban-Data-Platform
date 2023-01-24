# RFC5987 "value-chars" encode/decode

Great for HTTP header fields such as the "filename" of a "Content-Disposition".

Lightweight: 16 lines

```js
const {encode, decode} = require('rfc5987-value-chars')

decode(encode(filename))
```

Largely inspired by examples at: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/encodeURIComponent
