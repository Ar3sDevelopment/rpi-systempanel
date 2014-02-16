exports.page = function(req, res, app, next) {
	var settings = require('./framework/settings.js');
	var sid = req.session.sid;
	if (sid) {
		var widget_id;
		var widget;

		if (req.body && req.body != {}) {
			if (req.body.visibility !== undefined) {
				widget_id = req.body["widget-id"];

				settings.toggleWidgetVisibility(sid, widget_id, req.body.visibility, function (data) {
					if (data) {
						res.send({ visible: req.body.visibility });
					} else {
						res.send();
					}
				});
			} else if (req.body.enable !== undefined) {
				widget_id = req.body["widget-id"];

				settings.toggleWidgetState(sid, widget_id, req.body.enable, function (data) {
					if (data) {
						res.send({ enabled: req.body.enable });
					} else {
						res.send();
					}
				});
			} else if (req.body.save_user !== undefined) {
				var username = req.body.username;
				var hashmethod = req.body.hashmethod;
				var crypto = require('crypto');
				var password = crypto.createHash(hashmethod).update(req.body.password).digest('hex');

				settings.save_user(sid, username, password, hashmethod, function (data) {
					if (data) {
						res.send();
					} else {
						res.send();
					}
				});
			} else if (req.body.assign_widget !== undefined) {
				widget = {
					id_html: req.body.widget_id_html,
					poistion: req.body.widget_position
				};
				var wid = req.body.wid;

				settings.create_user_widget(sid, widget, wid, function (data) {
					if (data) {
						res.send();
					} else {
						res.send();
					}
				});
			} else if (req.body.widget_action !== undefined) {
				widget = {
					id: req.body.widget_id,
					id_html: req.body.widget_id_html,
					poistion: req.body.widget_position
				};

				if (req.body.widget_action == 'save') {
					settings.save_user_widget(sid, widget, function (data) {
						if (data) {
							res.send();
						}else {
							res.send();
						}
					});
				}else if (req.body.widget_action == 'delete') {
					settings.delete_user_widget(sid, widget, function (data) {
						if (data) {
							res.send();
						} else {
							res.send();
						}
					});
				}
			}
		} else {
			settings.load(sid, function(user) {
				settings.get_hash_methods(sid, function (hashes) {
					var current_url = req.headers.host.split(':')[0];
					var socket_port = 1338;

					res.render('settings', {
						page: 'settings',
						user : user,
						sid : sid,
						url : current_url,
						port : socket_port,
						hashes: hashes
					});
				});
			});

		}
	} else {
		next();
	}
};