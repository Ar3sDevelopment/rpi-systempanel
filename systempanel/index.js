var express = require('express');
var app = express();
var url = require('url');
var fs = require('fs');
var path = require('path');
Bliss = require('bliss');
bliss = new Bliss();

function dictionaryByEquals(source) {
	var dict = {};

	for (var c = 0; c < source.length; c++) {
		var pair = source[c].split('=');
		dict[pair[0]] = pair[1];
	}

	return dict;
}

function indexFunction(req, res) {
	var sid = req.params.sid;
	if (sid) {
		//TODO: Verificare la validità della sessione
		var settings = require('../framework/settings.js');

		settings.load(sid, function(user) {
			var current_url = req.headers.host.split(':')[0];
			var socket_port = 1337;
			res.render('index', {
				user : user,
				sid : sid,
				url : current_url,
				port : socket_port
			});
		});
	} else {
		res.send(500, '');
	}
}

function loginFunction(req, res) {
	if (req.body != null) {
		if (req.body.username && req.body.password) {
			//TODO: Check login and get sid
			var sid = '';

			if (sid) {
				res.redirect('/' + sid);
			}
		}
	}

	if (!sid) {
		var current_url = req.headers.host.split(':')[0];
		var socket_port = 1337;
		res.render('login', {
			url : current_url,
			port : socket_port
		});
	}
}

app.engine('.js.html', function(path, options, fn) {
	fn(null, bliss.render(path, options));
});

app.use('/css', express.static(__dirname + '/css'));
app.use('/fonts', express.static(__dirname + '/fonts'));
app.use('/images', express.static(__dirname + '/images'));
app.use('/js', express.static(__dirname + '/js'));

app.get('/:sid', function(req, res) {
	indexFunction(req, res);
});

app.get('/login', function(req, res) {
	loginFunction(req, res);
});

app.post('/login', function(req, res) {
	loginPostFunction(req, res);
});

app.get('/logout', function (req, res) {
	res.redirect('/login');
});

app.listen(1338);
