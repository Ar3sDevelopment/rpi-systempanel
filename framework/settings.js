var db = require('./database.js');

exports.get_widgets = function(sid, cb) {
	db.get_widgets(sid, cb);
};

exports.get_widget_list = function(sid, cb) {
	db.get_widget_list(sid, cb);
};

exports.save_widget = function(sid, widget, cb) {
	db.save_widget(sid, widget, cb);
};

exports.delete_widget = function(sid, widget, cb) {
	db.delete_widget(sid, widget, cb);
};

exports.create_widget = function(sid, widget, cb) {
	db.create_widget(sid, widget, cb);
};

exports.get_user_info = function(sid, cb) {
	db.get_user_info(sid, cb);
};

exports.get_hash_methods = function(sid, cb) {
	db.get_hash_methods(sid, cb);
};

exports.check_login = function(username, password, cb) {
	db.check_login(username, password, cb);
};

exports.update_sid = function(sid, device, uid, cb) {
	db.update_sid(sid, device, uid, cb);
};

exports.toggleWidgetVisibility = function(sid, widget_id, visibility, cb) {
	db.toggleWidgetVisibility(sid, widget_id, visibility, cb);
};

exports.toggleWidgetState = function(sid, widget_id, enabled, cb) {
	db.toggleWidgetState(sid, widget_id, enabled, cb);
};

exports.load = function(sid, cb) {
	db.get_user_info(sid, function(rows) {
		var user = rows;
		
		if (user) {
			user.logged = true;
			db.load(sid, function (rows) {
				user.widgets = rows;
				
				cb(user);
			});
		}
	});

};

exports.save_user = function(sid, username, password, hash, cb) {
	db.save_user(sid, username, password, hash, cb);
};

exports.save_user_widget = function(sid, widget, cb) {
	db.save_user_widget(sid, widget, cb);
};

exports.delete_user_widget = function(sid, widget, cb) {
	db.delete_user_widget(sid, widget, cb);
};

exports.create_user_widget = function(sid, widget, wid, cb) {
	db.create_user_widget(sid, widget, wid, cb);
};

exports.get_widget_from_user_widget = function(sid, uwid) {
	db.get_widget_from_user_widget(sid, uwid, cb);
};

exports.insert_widget = function(sid, title, folder, phpfile, classname, templatefile, columns, updatetime, requireadmin, version) {
	db.insert_widget(sid, title, folder, phpfile, classname, templatefile, columns, updatetime, requireadmin, version, cb);
}; 