var db = require('./database.js');

exports.get_widgets = function(sid)
{
	return db.get_widgets(sid);
};

exports.get_widget_list = function(sid)
{
	return db.get_widget_list(sid);
};

exports.save_widget = function(sid, widget)
{
	return db.save_widget(sid, widget);
};

exports.delete_widget = function(sid, widget)
{
	return db.delete_widget(sid, widget);
};

exports.create_widget = function(sid, widget)
{
	return db.create_widget(sid, widget);
};

exports.get_user_info = function(sid)
{
	return db.get_user_info(sid);
};

exports.get_hash_methods = function(sid)
{
	return db.get_hash_methods(sid);
};

exports.check_login = function(username, password)
{
	return db.check_login(username, password);
};

exports.update_sid = function(sid, device, uid)
{
	return db.update_sid(sid, device, uid);
};

exports.toggleWidgetVisibility = function(sid, widget_id, visibility)
{
	return db.toggleWidgetVisibility(sid, widget_id, visibility);
};

exports.toggleWidgetState = function(sid, widget_id, enabled)
{
	return db.toggleWidgetState(sid, widget_id, enabled);
};

exports.load = function(sid)
{
	var user = {};
	user = db.get_user_info(sid);
	
	if (user != null)
	{
		user.logged = true;
		user.widgets = db.load(sid);
	}
	
	return user;
};

exports.save_user = function(sid, username, password, hash)
{
	return db.save_user(sid, username, password, hash);
};

exports.save_user_widget = function(sid, widget)
{
	return db.save_user_widget(sid, widget);
};

exports.delete_user_widget = function(sid, widget)
{
	return db.delete_user_widget(sid, widget);
};

exports.create_user_widget = function(sid, widget, wid)
{
	return db.create_user_widget(sid, widget, wid);
};

exports.get_widget_from_user_widget = function(sid, uwid)
{
	return db.get_widget_from_user_widget(sid, uwid);
};

exports.insert_widget = function(sid, title, folder, phpfile, classname, templatefile, columns, updatetime, requireadmin, version)
{
	return db.insert_widget(sid, title, folder, phpfile, classname, templatefile, columns, updatetime, requireadmin, version);
};