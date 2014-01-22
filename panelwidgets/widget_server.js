var http = require('http');
var socket_io = require('socket.io');
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

function getUserWidget(json, sid, widget_id, post_params, cb) {
	var settings = require('../framework/settings.js');

	settings.load(sid, function(user) {
		var user_widget = null;

		for (var c = 0; c < user.widgets.length && !user_widget; c++) {
			if (user.widgets[c].id == widget_id) {
				user_widget = user.widgets[c];
			}
		}

		if (user_widget) {
			var folder = './' + user_widget.widget.folder;
			var path = folder + '/' + user_widget.widget.phpfile + '.js';
			var loaded_widget = require(path);
			loaded_widget.manage_post(post_params, function(result, output) {
				if (result) {
					cb(user_widget, 200, 'text/plain', output);
				} else {
					loaded_widget.data(function(widget_data) {
						if (json) {
							cb(user_widget, 200, 'application/json', widget_data);
						} else {
							Bliss = require('bliss');
							bliss = new Bliss();
							template = bliss.compileFile(folder + '/' + user_widget.widget.templatefile.replace('.tpl', ''));
							output = template(widget_data, user_widget, sid);
							cb(user_widget, 200, 'text/html', output);
						}
					});
				}
			});
		} else {
			cb(user_widget, 500, 'text/plain', '');
		}
	});
}

var server = http.createServer(function(req, res) {
	var pre = {};
	initPredefinedVariables(req, res, pre, function() {
		var json = pre.post.json || false;
		var sid = pre.post.sid;
		var widget_id = pre.post["widget-id"];

		getUserWidget(json, sid, widget_id, pre_post, function(user_widget, statusCode, contentType, output) {
			res.writeHead(statusCode, {
				'Content-Type' : contentType
			});
			res.end(output);
		});
	});
});

server.listen(1337);

var io = socket_io.listen(server);

io.sockets.on('connection', function(socket) {
	socket.on('request_new_data', function(data) {
		getUserWidget(data.json, data.sid, data.widget_id, {}, function(user_widget, statusCode, contentType, output) {
			socket.emit('updated_data', {
				output : output,
				user_widget : user_widget,
				statusCode : statusCode,
				contentType : contentType
			});
		});
	});

	socket.on('request_first_data', function(data) {
		getUserWidget(data.json, data.sid, data.widget_id, {}, function(user_widget, statusCode, contentType, output) {
			socket.emit('first_use_data', {
				output : output,
				user_widget : user_widget,
				statusCode : statusCode,
				contentType : contentType,
				callback : data.callback
			});
		});
	});
});
