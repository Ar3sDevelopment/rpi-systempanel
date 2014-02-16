exports.page = function(req, res) {
	var current_url = req.headers.host.split(':')[0];
	var socket_port = 1338;

	if (req.body && req.body.username && req.body.password) {
		var settings = require('./framework/settings.js');

		settings.check_login(req.body.username, req.body.password, function (uid) {
			if (uid != -1) {
				var crypto = require('crypto');
				var sid = crypto.createHash('sha1').update(uid + '|' + req.body.username + '|' + req.body.password).digest('hex');
				res.session.sid = sid;
				var ip = req.headers['x-forwarded-for'] || req.connection.remoteAddress;

				settings.update_sid(sid, ip, uid, function (result) {
					if (result) {
						res.redirect('/index/' + sid);
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
		});
	} else {
		res.render('login', {
			url : current_url,
			port : socket_port
		});
	}
};