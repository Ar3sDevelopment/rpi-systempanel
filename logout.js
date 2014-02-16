exports.page = function (req, res, app, next) {
	var sid = req.session.sid;
	if (sid) {
		var settings = require('./framework/settings.js');

		settings.get_user_info(sid, function (result) {
			if (result) {
				settings.update_sid(null, ip, result.id, function (result) {
					if (result) {
						return res.redirect('/login');
					}else {
						return next();
					}
				});
			}else {
				return next();
			}
		});
	} else {
		return next();
	}
};
