exports.page = function(req, res, app, next) {
	var settings = require('./framework/settings.js');
	var sid = req.params.sid;
	if (sid) {
		if (req.body && req.body != {}) {
			if (req.body.visibility !== undefined) {
				var widget_id = req.body["widget-id"];

				settings.toggleWidgetVisibility(sid, widget_id, req.body.visibility);

				return res.send({ visible: req.body.visibility });
			} else if (req.body.enable !== undefined) {
				var widget_id = req.body["widget-id"];

				settings.toggleWidgetState(sid, widget_id, req.body.enable);

				return res.send({ enabled: req.body.enable });
			} else if (req.body.save_user) {
				var username = req.body.username;
				var hashmethod = req.body.hashmethod;
				var crypto = require('crypto');
				var password = crypto.createHash(hashmethod).update(req.body.password).digest('hex');

				settings.save_user(sid, username, password, hashmethod);
				return res.send();
			} else if (req.body.assign_widget) {
				var widget = {
					id_html: req.body.widget_id_html,
					poistion: req.body.widget_position
				};
				var wid = req.body.wid;

				settings.create_user_widget(sid, widget, wid);

				return res.send();
			} else if (req.body.widget_action) {
				var widget = {
					id: req.body.widget_id,
					id_html: req.body.widget_id_html,
					poistion: req.body.widget_position
				};

				if (req.body.widget_action == 'save') {
					settings.save_user_widget(sid, widget);
				}else if (req.body.widget_action == 'delete') {
					settings.delete_user_widget(sid, widget);
				}
			}
		} else {
			settings.load(sid, function(user) {
				settings.get_hash_methods(sid, function (hashes) {
					var current_url = req.headers.host.split(':')[0];
					var socket_port = 1338;

					return res.render('settings', {
						user : user,
						sid : sid,
						url : current_url,
						port : socket_port,
						hashes: hashes
					});
				});
			});

		}		} else {
		return next();
	}
};