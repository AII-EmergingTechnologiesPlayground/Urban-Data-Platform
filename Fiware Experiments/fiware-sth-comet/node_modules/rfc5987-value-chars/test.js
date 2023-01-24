'use strict'

const test = require('tape')
const {encode, decode} = require('./')

test(function(t){
	const subject = '\'()*|`^@ôô🇩🇰👍123789abcxzy'

	t.equal(encode(subject), '%27%28%29%2A|`^%40o%CC%82%C3%B4%F0%9F%87%A9%F0%9F%87%B0%F0%9F%91%8D123789abcxzy')
	t.equal(decode(encode(subject)), subject)
	t.end()
})
