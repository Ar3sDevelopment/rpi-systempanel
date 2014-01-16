var http = require('http');
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
	req.on('end', function() {
		pre.post = dictionaryByEquals(body.split('&'));
		cb();
	});
}

var server = http.createServer(function(req, res) {
	var pre = {};
	initPredefinedVariables(req, res, pre, function() {
		var sid = pre.get.sid;
		//TODO: Verificare la validità della sessione
		var settings = require('../framework/settings.js');

		settings.load(sid, function(user) {
			var widgets = user.widgets;

			Bliss = require('bliss');
			bliss = new Bliss();
			template = bliss.compileFile('index');
			output = template(widgets, user, sid);

			res.writeHead(200, {
				'Content-Type' : 'text/html'
			});
			res.end(output);
		});
	});
});

server.listen(1338); 