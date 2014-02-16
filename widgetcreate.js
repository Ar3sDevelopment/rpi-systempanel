exports.page = function (req, res, app, next) {
	var sid = req.session.sid;
	if (sid) {
		var settings = require('./framework/settings.js');

		settings.get_widget_list(sid, function (data) {
			res.render('widgetcreate', {
				sid: sid,
				widget_list: data,
				widget: {}
			});
		});
	} else {
		next();
	}
};