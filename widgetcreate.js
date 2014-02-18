exports.page = function (req, res, app, next) {
	var username = req.session.username;
	if (username) {
		res.render('widgetcreate', {
			username: username,
			widget: {}
		});
	} else {
		next();
	}
};