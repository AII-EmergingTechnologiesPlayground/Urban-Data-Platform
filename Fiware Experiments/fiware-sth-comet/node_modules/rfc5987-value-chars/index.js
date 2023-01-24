'use strict'

module.exports = {
	encode: encode,
	decode: decodeURIComponent,
}

function encode(str){
  return encodeURIComponent(str)
    .replace(/['()*]/g, function(c){
    	return "%" + c.charCodeAt(0).toString(16).toUpperCase()
	})
    .replace(/%(7C|60|5E)/g, function(str, hex){
    	return String.fromCharCode(parseInt(hex, 16))
    })
}
