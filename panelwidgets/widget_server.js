var http = require('http');
var nodeStatic = require('node-static');
var file = new nodeStatic.Server();
var url = require('url');
var mysql = require('mysql');

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
	});
}

function createUserWidgetFromSQLRow(row, cb) {
	user_widget = {};
	user_widget.id = row.uwid;
	user_widget.id_widget = row.wid;
	user_widget.id_html = row.id_html;
	user_widget.enabled = row.enabled;
	user_widget.visible = row.visible;
	user_widget.position = row.position;
	user_widget.widget = {};
	user_widget.widget.id = row.wid;
	user_widget.widget.title = row.title;
	user_widget.widget.updatetime = row.updatetime;
	user_widget.widget.columns = row.columns;
	user_widget.widget.templatefile = row.templatefile;
	user_widget.widget.phpfile = row.phpfile;
	user_widget.widget.folder = row.folder;
	user_widget.widget.class_name = row.class_name;
	
	cb(user_widget);
}

var server = http.createServer(function (req, res) {
	var pre = {};
	initPredefinedVariables(req, res, pre, function () {
		var json = pre.get.json || false;
		var sid = pre.get.sid;
		var mysqlJSON = require('./db_conn.json');
		var connection = mysql.createConnection(mysqlJSON);
		
		connection.query('CALL GetUserInfo(?)', [sid], function (err, rows) {
			if (!err) {
				if (rows[0].length) {
					connection.query('CALL LoadSettings(?)', [sid], function (err, rows) {
						if (!err) {
							var user_widget = null;
							
							for (var c = 0; c < rows[0].length && !user_widget; c++) {
								if (rows[0][c].uwid == pre.get["widget-id"]) {
									createUserWidgetFromSQLRow(rows[0][c], function (uw) {
										user_widget = uw;
									});
								}
							}
							
							if (user_widget) {
								var folder = './' + user_widget.widget.folder;
								var path = folder + '/' + user_widget.widget.phpfile + '.js';
								var loaded_widget = require(path);
								loaded_widget.manage_post(pre.post, function (result) {
									if (result) {
										res.writeHead(200, { 'Content-Type': 'text/plain' });
										res.end();
									} else {
										loaded_widget.data(function (widget_data) {
											if (json) {
												res.writeHead(200, { 'Content-Type': 'application/json' });
												res.end(JSON.stringify(widget_data));										
											} else {
												Bliss = require('bliss');
												bliss = new Bliss();
												template = bliss.compileFile(folder + '/' + user_widget.widget.templatefile.replace('.tpl', ''));
												output = template(widget_data, user_widget, sid);
												res.writeHead(500, { 'Content-Type': 'text/html' });
												res.end(output);
											}
										});
									}
								});
							} else {
								res.writeHead(500, { 'Content-Type': 'text/plain' });
								res.end();
							}
						}
					});
				}
			}
		});
	});
});

server.listen(1337, function () {
	var address = this.address();
	console.log('Opened server on %j', address);
});
