Number.isNaN = Number.isNaN || function isNaN(input) {
    return typeof input === 'number' && input !== input;
}

NodeList.prototype.forEach = NodeList.prototype.forEach || function(fn, scope) {
	for(var i = 0, len = this.length; i < len; ++i) {
		fn.call(scope, this[i], i, this);
	}
}
