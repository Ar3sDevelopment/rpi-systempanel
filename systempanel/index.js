var http = require('http');
var url = require('url');
var fs = require('fs');
var path = require('path');

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
	var mimeTypes = {
		"html" : "text/html",
		"jpeg" : "image/jpeg",
		"jpg" : "image/jpeg",
		"png" : "image/png",
		"js" : "text/javascript",
		"css" : "text/css",
		"eot" : "application/vnd.ms-fontobject",
		"svg" : "image/svg+xml",
		"ttf" : "application/x-font-ttf",
		"otf" : "application/x-font-opentype",
		"woff" : "application/font-woff"
	};
	initPredefinedVariables(req, res, pre, function() {
		var uri = url.parse(req.url).pathname;
		var filename = path.join(process.cwd(), uri);
		fs.exists(filename, function(exists) {
			if (!exists) {
				res.writeHead(500, {
					'Content-Type' : 'text/plain'
				});
				res.end();
			} else {
				fs.stat(filename, function(err, stats) {
					if (stats.isDirectory()) {
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
					} else {
						var mimeType = mimeTypes[path.extname(filename).split(".")[1]];
						res.writeHead(200, mimeType);
						var fileStream = fs.createReadStream(filename);
						fileStream.pipe(res);
					}
				});
			}
		});
	});
});

server.listen(1338);
