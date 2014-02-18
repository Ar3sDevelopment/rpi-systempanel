exports.page = function(req, res, app, next) {
	var settings = require('./framework/settings.js');
	var username = req.session.username;
	if (username) {
		var widget_id;
		var widget;

		if (req.body && req.body != {}) {
			if (req.body.visibility !== undefined) {
				widget_id = req.body["widget-id"];

				settings.toggleWidgetVisibility(username, widget_id, req.body.visibility, function (data) {
					if (data) {
						res.send({ visible: req.body.visibility });
					} else {
						res.send();
					}
				});
			} else if (req.body.enable !== undefined) {
				widget_id = req.body["widget-id"];

				settings.toggleWidgetState(username, widget_id, req.body.enable, function (data) {
					if (data) {
						res.send({ enabled: req.body.enable });
					} else {
						res.send();
					}
				});
			} else if (req.body.save_user !== undefined) {
				var new_username = req.body.username;
				var crypto = require('crypto');
				var password = crypto.createHash('sha512').update(req.body.password).digest('hex');

				settings.get_user_info(username, function (user) {
					user.username = new_username;
					user.password = password;
					settings.save_user(user, function (data) {
						if (data) {
							res.send();
						} else {
							res.send();
						}
					});
				});
			} else if (req.body.assign_widget !== undefined) {
				widget = {
					id_html: req.body.widget_id_html,
					poistion: req.body.widget_position
				};
				var wid = req.body.wid;

				settings.create_user_widget(username, widget, wid, function (data) {
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
					settings.save_user_widget(username, widget, function (data) {
						if (data) {
							res.send();
						}else {
							res.send();
						}
					});
				}else if (req.body.widget_action == 'delete') {
					settings.delete_user_widget(username, widget, function (data) {
						if (data) {
							res.send();
						} else {
							res.send();
						}
					});
				}
			}
		} else {
			settings.get_user_info(username, function(user) {
				settings.get_hash_methods(username, function (hashes) {
					var current_url = req.headers.host.split(':')[0];
					var socket_port = 1338;

					res.render('settings', {
						page: 'settings',
						user : user,
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