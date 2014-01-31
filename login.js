exports.page = function(req, res, app) {
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
		var socket_port = 1338;
		res.render('login.js.html', {
			url : current_url,
			port : socket_port
		});
	}
};