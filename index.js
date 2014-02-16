exports.page = function(req, res, app, next) {
	var sid = req.session.sid;
	if (sid) {
		//TODO: Verificare la validità della sessione
		var settings = require('./framework/settings.js');

		settings.load(sid, function(user) {
			var current_url = req.headers.host.split(':')[0];
			var socket_port = 1338;

			res.render('index', {
				page: 'index',
				user : user,
				sid : sid,
				url : current_url,
				port : socket_port
			});
		});
	} else {
		res.redirect('/login');
	}
};