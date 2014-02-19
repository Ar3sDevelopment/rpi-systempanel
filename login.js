exports.page = function(req, res) {
	var current_url = req.headers.host.split(':')[0];
	var socket_port = 1338;

	if (req.body && req.body.username && req.body.password) {
		var settings = require('./framework/settings.js');
		var crypto = require('crypto');
		var password = crypto.createHash('sha512').update(req.body.password).digest('hex');

		settings.check_login(req.body.username, password, function (result) {
			if (result) {
				req.session.username = req.body.username;
				res.redirect('/');
			} else {
				res.render('login', {
					url : current_url,
					port : socket_port
				});
			}
		});
	} else {
		res.render('login', {
			url : current_url,
			port : socket_port
		});
	}
};