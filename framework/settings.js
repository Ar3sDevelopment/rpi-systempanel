exports.get_user_info = function(username, cb) {
	var json = require('./settings.json');
	var user = null;

	for (var i = 0; i < json.length && !user; i++)
	{
		if (json[i].username == username) {
			user = json[i];
		}
	}

	cb(user);
};

exports.check_login = function(username, password, cb) {
	exports.get_user_info(username, function(user) {
		if (user && user.password == password) {
			cb(true);
		} else {
			cb(false);
		}
	});
};

exports.toggleWidgetVisibility = function(username, widget_id, visibility, cb) {
	exports.get_user_info(username, function (user) {
		for (var i = 0; i < user.selected_widgets.length; i++)
		{
			var selected_widget = user.selected_widgets[i];
			if (selected_widget.id_html == widget_id) {
				selected_widget.visible = visibility;
				user.selected_widgets[i] = selected_widget;
			}
		}

		exports.save_user(user, function () {
			cb(true);
		});
	});
};

exports.toggleWidgetState = function(username, widget_id, enabled, cb) {
	exports.get_user_info(username, function (user) {
		for (var i = 0; i < user.selected_widgets.length; i++)
		{
			var selected_widget = user.selected_widgets[i];
			if (selected_widget.id_html == widget_id) {
				selected_widget.enabled = enabled;
				user.selected_widgets[i] = selected_widget;
			}
		}

		exports.save_user(user, function () {
			cb(true);
		});
	});
};

exports.save_user = function(user, cb) {
};

exports.save_user_widget = function(sid, widget, cb) {
	db.saveUserWidget(sid, widget, cb);
};

exports.delete_user_widget = function(sid, widget, cb) {
	db.deleteUserWidget(sid, widget, cb);
};

exports.create_user_widget = function(sid, widget, wid, cb) {
	db.createUserWidget(sid, widget, wid, cb);
};