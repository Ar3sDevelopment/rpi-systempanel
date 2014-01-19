var http = require('http');
var url = require('url');
var fs = require('fs');

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
		console.log(__dirname + req.url);

		if (req.url.indexOf('.js') != -1) {
			fs.readFile(__dirname + req.url, function(err, data) {
				if (err)
					console.log(err);
				res.writeHead(200, {
					'Content-Type' : 'text/javascript'
				});
				console.log(data.length);
				res.write(data);
				res.end();
			});
		} else if (req.url.indexOf('.css') != -1) {
			fs.readFile(__dirname + req.url, function(err, data) {
				if (err)
					console.log(err);
				res.writeHead(200, {
					'Content-Type' : 'text/css'
				});
				console.log(data.length);
				res.write(data);
				res.end();
			});
		} else {
			var sid = pre.get.sid;
			if (sid) {
				//TODO: Verificare la validità della sessione
				var settings = require('../framework/settings.js');

				settings.load(sid, function(user) {
					Bliss = require('bliss');
					bliss = new Bliss();
					template = bliss.compileFile('index');
					output = template(user, sid);

					res.writeHead(200, {
						'Content-Type' : 'text/html'
					});

					res.end(output);
				});
			} else {
				res.writeHead(500, {
					'Content-Type' : 'text/plain'
				});
				res.end();
			}
		}
	});
});

server.listen(1338);
