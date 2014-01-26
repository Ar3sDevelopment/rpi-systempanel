var db = require('./database.js');

exports.get_widgets = function(sid, cb) {
	db.getWidgets(sid, cb);
};

exports.get_widget_list = function(sid, cb) {
	db.getWidgetList(sid, cb);
};

exports.save_widget = function(sid, widget, cb) {
	db.saveWidget(sid, widget, cb);
};

exports.delete_widget = function(sid, widget, cb) {
	db.deleteWidget(sid, widget, cb);
};

exports.create_widget = function(sid, widget, cb) {
	db.createWidget(sid, widget, cb);
};

exports.get_user_info = function(sid, cb) {
	db.getUserInfo(sid, cb);
};

exports.get_hash_methods = function(sid, cb) {
	db.getHashMethods(sid, cb);
};

exports.check_login = function(username, password, cb) {
	db.checkLogin(username, password, cb);
};

exports.update_sid = function(sid, device, uid, cb) {
	db.updateSid(sid, device, uid, cb);
};

exports.toggleWidgetVisibility = function(sid, widget_id, visibility, cb) {
	db.toggleWidgetVisibility(sid, widget_id, visibility, cb);
};

exports.toggleWidgetState = function(sid, widget_id, enabled, cb) {
	db.toggleWidgetState(sid, widget_id, enabled, cb);
};

exports.load = function(sid, cb) {
	db.getUserInfo(sid, function(user) {
		if (user) {
			user.logged = true;
			db.load(sid, function (userWidgets) {
				user.widgets = userWidgets;
				
				cb(user);
			});
		} else {
			cb(null);
		}
	});
};

exports.save_user = function(sid, username, password, hash, cb) {
	db.saveUser(sid, username, password, hash, cb);
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

exports.get_widget_from_user_widget = function(sid, uwid) {
	db.getWidgetFromUserWidget(sid, uwid, cb);
};

exports.insert_widget = function(sid, title, folder, phpfile, classname, templatefile, columns, updatetime, requireadmin, version) {
	db.insertWidget(sid, title, folder, phpfile, classname, templatefile, columns, updatetime, requireadmin, version, cb);
}; 