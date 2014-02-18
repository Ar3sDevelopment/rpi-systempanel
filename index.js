exports.page = function(req, res) {
	var username = req.session.username;
	if (username) {
		var settings = require('./framework/settings.js');

		settings.get_user_info(username, function(user) {
			var current_url = req.headers.host.split(':')[0];
			var socket_port = 1338;

			res.render('index', {
				page: 'index',
				user : user,
				url : current_url,
				port : socket_port
			});
		});
	} else {
		res.redirect('/login');
	}
};