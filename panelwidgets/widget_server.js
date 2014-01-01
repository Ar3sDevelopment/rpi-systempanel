var http = require('http');
var nodeStatic = require('node-static');
var file = new nodeStatic.Server();
var url = require('url');

function dictionaryByEquals(source) {
	var dict = {};
	
	for (var c = 0; c < source.length; c++) {
		var pair = source[c].split('=');
		dict[pair[0]] = pair[1];
	}
	
	return dict;
}

function initPredefinedVariables(req, res, pre, cb) {
	var urlParts = url.parse(req.url, true);
	pre.get = urlParts.query;
	pre.post = {};
	var body = '';
	var bodyMax = 1e6;
	req.on('data', function(chunk) {
		body += chunk;
		if (body.length > bodyMax) {
			req.connection.destroy();
		}
	});
	req.on('end', function () {
		pre.post = dictionaryByEquals(body.split('&'));
		cb();
	})
}

http.createServer(function (req, res) {
	var pre = {};
	initPredefinedVariables(req, res, pre, function () {
		var json = pre.post.json;
		var sid = pre.post.sid;
		
		if (pre.post["widget-id"] !== undefined) {
			//TODO
		}
		
		file.serve(req, res);
	});
}).listen(1337, function () {
	var address = this.address();
	console.log('Opened server on %j', address);
});
