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
	})
}

var server = http.createServer(function (req, res) {
	var pre = {};
	initPredefinedVariables(req, res, pre, function () {
		var json = pre.get.json || false;
		var sid = pre.get.sid;
		var mysqlJSON = require('./db_conn.json');
		var connection = mysql.createConnection(mysqlJSON);
		
		connection.query('CALL GetUserInfo(?)', [sid], function (err, rows) {
			if (err === undefined || err == null) {
				if (rows[0].length > 0) {
					connection.query('CALL LoadSettings(?)', [sid], function (err, rows) {
						if (err === undefined || err == null) {
							var user_widget = null;
							
							for (var c = 0; c < rows[0].length; c++) {
								if (rows[0][c].uwid == pre.get["widget-id"]) {
									user_widget = {};
									user_widget.id = rows[0][c].uwid;
									user_widget.id_widget = rows[0][c].wid;
									user_widget.id_html = rows[0][c].id_html;
									user_widget.enabled = rows[0][c].enabled;
									user_widget.visible = rows[0][c].visible;
									user_widget,position = rows[0][c].position;
									user_widget.widget = {};
									user_widget.widget.id = rows[0][c].wid;
									user_widget.widget.title = rows[0][c].title;
									user_widget.widget.updatetime = rows[0][c].updatetime;
									user_widget.widget.columns = rows[0][c].columns;
									user_widget.widget.templatefile = rows[0][c].templatefile;
									user_widget.widget.phpfile = rows[0][c].phpfile;
									user_widget.widget.folder = rows[0][c].folder;
									user_widget.widget.class_name = rows[0][c].class_name;
									console.log(user_widget);
									break;
								}
							}
							
							if (user_widget != null) {
								res.writeHead(200, { 'Content-Type': 'text/plain' });
								res.end('test');	
							}
						}
					});
				}
			}
		});
		
		//file.serve(req, res);
	});
});

server.listen(1337, function () {
	var address = this.address();
	console.log('Opened server on %j', address);
});
