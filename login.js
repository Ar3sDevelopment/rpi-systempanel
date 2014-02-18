exports.page = function(req, res) {
	var current_url = req.headers.host.split(':')[0];
	var socket_port = 1338;

	if (req.body && req.body.username && req.body.password) {
		var settings = require('./framework/settings.js');

		settings.check_login(req.body.username, req.body.password, function (res) {
			if (res) {
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