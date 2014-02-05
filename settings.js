exports.page = function(req, res, app, next) {
	if (req.body && req.body.sid) {
		//TODO: Manage settings post
	} else {
		//TODO: Manage settings get
		var sid = req.params.sid;
		if (sid) {
			//TODO: Verificare la validità della sessione
			var settings = require('./framework/settings.js');

			settings.load(sid, function(user) {
				var current_url = req.headers.host.split(':')[0];
				var socket_port = 1338;

				return res.render('settings.js.html', {
					user : user,
					sid : sid,
					url : current_url,
					port : socket_port
				});
			});
		} else {
			return next();
		}
	}
};