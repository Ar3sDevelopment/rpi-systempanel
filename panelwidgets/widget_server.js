var express = require('express');
var app = express();
var http = require('http');
var url = require('url');
var path = require('path');
Bliss = require('bliss');
bliss = new Bliss();

var socket_io = require('socket.io');
var server = http.createServer(app).listen(1337);

app.engine('html', function(path, options, fn) {
	fn(null, bliss.render(path, options));
});

app.set('views', __dirname);

var io = socket_io.listen(server, {
	log : false
});

app.get('/', function(req, res) {
	res.send('');
});

function getUserWidget(data, cb) {
	var settings = require('../framework/settings.js');

	settings.load(data.sid, function(user) {
		if (user != null) {
			var user_widget = null;

			for (var c = 0; c < user.widgets.length && !user_widget; c++) {
				if (user.widgets[c].id == data.widget_id) {
					user_widget = user.widgets[c];
				}
			}

			if (user_widget) {
				var folder = './' + user_widget.widget.folder;
				var path = folder + '/' + user_widget.widget.phpfile + '.js';
				var loaded_widget = require(path);
				console.log(path);
				loaded_widget.manage_post(data.post_params, function(result, output) {
					if (result) {
						cb(user_widget, 200, 'text/plain', output);
					} else {
						loaded_widget.data(function(widget_data) {
							if (widget_data != null) {
								if (data.json) {
									cb(user_widget, 200, 'application/json', widget_data);
								} else {
									app.render(folder + '/' + user_widget.widget.templatefile.replace('.tpl', '.js.html'), {
										data : widget_data,
										user_widget : user_widget,
										sid : data.sid
									}, function(err, output) {
										if (!err) {
											cb(user_widget, 200, 'text/html', output);
										} else {
											console.log(err);
										}
									});
								}
							} else {
								cb(user_widget, 500, 'text/plain', '');
							}
						});
					}
				});
			} else {
				cb(user_widget, 500, 'text/plain', '');
			}
		} else {
			cb(null, 500, 'text/plain', '');
		}
	});
}

function widgetUpdatingCallback(socket, data, old_user_widget) {
	if (!socket.disconnected) {
		getUserWidget(data, function(user_widget, statusCode, contentType, output) {
			socket.emit('updated_data_' + data.widget_id, {
				output : output,
				user_widget : user_widget,
				statusCode : statusCode,
				contentType : contentType
			});

			if (user_widget == null) {
				user_widget = old_user_widget;
				if (user_widget == null) {
					user_widget = {
						widget : {
							updatetime : 1000
						}
					};
				}
			}
			if (user_widget.widget.updatetime > 0 && !socket.disconnected) {
				setTimeout(function() {
					widgetUpdatingCallback(socket, data, user_widget);
				}, user_widget.widget.updatetime);
			}
		});
	}
}

io.sockets.on('connection', function(socket) {
	socket.on('request_updating', function(data) {
		widgetUpdatingCallback(socket, data, null);
	});

	socket.on('request_first_data', function(data) {
		getUserWidget(data, function(user_widget, statusCode, contentType, output) {
			socket.emit('first_use_data', {
				output : output,
				user_widget : user_widget,
				statusCode : statusCode,
				contentType : contentType
			});
		});
	});
});
