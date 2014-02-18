exports.page = function (req, res, app, next) {
	var username = req.session.username;
	if (username) {
		var settings = require('./framework/settings.js');

		settings.get_user_info(username, function (result) {
			if (result) {
				res.redirect('/login');
			}else {
				next();
			}
		});
	} else {
		next();
	}
};
