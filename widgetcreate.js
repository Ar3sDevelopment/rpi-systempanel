exports.page = function (req, res, app, next) {
	var sid = req.params.sid;
	if (sid) {
		var settings = require('./framework/settings.js');

		settings.get_widget_list(sid, function (data) {
			return res.render('widgetcreate', {
				sid: sid,
				widget_list: data,
				widget: {}
			});
		});
	} else {
		return next();
	}
};