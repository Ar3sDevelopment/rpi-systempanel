var mysql = require('mysql');
var mysqlJSON = require('./db_conn.json');
var crypto = require('crypto');

exports.getWidgets = function (sid, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [sid];
	connection.query('CALL GetWidgets(?)', params, function (err, rows) {
		var widgets = [];
		
		if (!err) {
			for (var c = 0; c < rows[0].length; c++) {
				var row = rows[0][c];
				widgets.push(row);
			}
		}
		
		cb(widgets);
	});
};

exports.getWidgetList = function (sid, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [sid];
	connection.query('CALL GetWidgetList(?)', params, function (err, rows) {
		var widgets = [];
		
		if (!err) {
			for (var c = 0; c < rows[0].length; c++) {
				var row = rows[0][c];
				widgets.push(row);
			}
		}
		
		cb(widgets);
	});
};

exports.saveWidget = function(sid, widget, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [
		widget.columns,
		widget.updatetime,
		widget.title,
		widget.phpfile,
		widget.templatefile,
		widget.folder,
		widget.class_name,
		widget.version,
		widget.requireadmin,
		widget.id
	];
	connection.query('CALL SaveWidget(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', params, function (err, rows) {
		cb(!err);
	});
};

exports.deleteWidget = function(sid, widget, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [widget.id];
	connection.query('CALL DeleteWidget(?)', params, function (err, rows) {
		cb(!err);
	});
};

exports.getUserInfo = function (sid, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [sid];
	connection.query('CALL GetUserInfo(?)', params, function (err, rows) {
		var userInfo = {};
		
		if (!err) {
			if (rows[0].length) {
				userInfo = rows[0][0];
			}
		}
		
		cb(userInfo)
	});
};

exports.getHashMethods = function (sid, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [sid];
	connection.query('CALL GetHashes(?)', params, function (err, rows) {
		var hashes = [];
		
		if (!err) {
			for (var c = 0; c < rows[0].length; c++) {
				var row = rows[0][c];
				hashes.push(row);
			}
		}
		
		cb(hashes);
	});
};

exports.checkLogin = function (username, password, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [username];
	connection.query('CALL CheckLogin(?)', username, function (err, rows) {
		var uid = -1;
		if (!err) {
			for (var c = 0; c < rows[0].length; c++) {
				var userInfo = rows[0][c];
				if (userInfo.password == crypto.createHash(userInfo.hash).update(password).digest("hex")) {
					uid = userInfo.id;
				}
			}
		}
			
		cb(uid);
	});
};

exports.updateSid = function(sid, device, uid, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [
		sid,
		device,
		uid
	];
	connection.query('CALL UpdateSid(?, ?, ?)', params, function (err, rows) {			
		cb(!err);
	});
};

exports.toggleWidgetVisibility = function(sid, widget_id, visibility, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [
		visibility,
		sid,
		widget_id
	];
	connection.query('CALL ToggleWidgetVisibility(?, ?, ?)', params, function (err, rows) {			
		cb(!err);
	});
};

exports.toggleWidgetState = function(sid, widget_id, enabled, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [
		enabled,
		sid,
		widget_id
	];
	connection.query('CALL ToggleWidgetState(?, ?, ?)', params, function (err, rows) {			
		cb(!err);
	});
};

exports.saveUser = function(sid, username, password, hash) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [
		username,
		password,
		hash,
		sid
	];
	connection.query('CALL SaveUser(?, ?, ?, ?)', params, function (err, rows) {			
		cb(!err);
	});
};

exports.saveUserWidget = function(sid, userWidget) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [
		userWidget.position,
		userWidget.id_html,
		userWidget.id,
		sid
	];
	connection.query('CALL SaveUserWidget(?, ?, ?, ?)', params, function (err, rows) {			
		cb(!err);
	});
};

exports.deleteUserWidget = function(sid, userWidget) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [
		userWidget.id,
		sid
	];
	connection.query('CALL DeleteUserWidget(?, ?)', params, function (err, rows) {			
		cb(!err);
	});
};

exports.createUserWidget = function(sid, userWidget, widget_id) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [
		userWidget.position,
		userWidget.id_html,
		widget_id,
		sid
	];
	connection.query('CALL CreateUserWidget(?, ?, ?, ?)', params, function (err, rows) {			
		cb(!err);
	});
};

exports.getWidgetFromUserWidget = function (sid, uwid) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [uwid, sid];
	connection.query('CALL GetWidgetFromUserWidget(?, ?)', params, function (err, rows) {
		var widget = {};
		
		if (!err) {
			if (rows[0].length) {
				widget = rows[0][0];
			}
		}
		
		cb(widget)
	});
};

exports.insertWidget = function(sid, title, folder, phpfile, classname, templatefile, columns, updatetime, requireadmin, version, cb) {
	var connection = mysql.createConnection(mysqlJSON);
	var params = [
		title,
		folder,
		classname,
		templatefile,
		columns,
		updatetime,
		requireadmin,
		version,
		sid
	];
	connection.query('CALL InsertWidget(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', params, function (err, rows) {
		cb(!err);
	});
};

/*	
		public function create_widget($sid, $widget)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL CreateWidget(?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("iisssssii", $widget->columns,
										$widget->updatetime,
										$widget->title,
										$widget->phpfile,
										$widget->templatefile,
										$widget->folder,
										$widget->class_name,
										$widget->version,
										$widget->requireadmin);

			print_r($stmt);

			$stmt->execute();
			$stmt->close();
			
			if (!file_exists("../panelwidgets/$widget->folder"))
			{
				mkdir("../panelwidgets/$widget->folder");
			}
			
			if (!file_exists("../panelwidgets/$widget->folder/$widget->phpfile.widget.php"))
			{
				file_put_contents("../panelwidgets/$widget->folder/$widget->phpfile.widget.php", "<?php
	require_once('../panelwidgets/abstract.widget.php');

	class $widget->class_name" . "Widget extends AbstractWidget
	{	
		public function load() {
			//TODO: Load widget here
		}
		
		public function manage_post(\$post)
		{
			//TODO: Manage \$_POST here, return 0 for OK
			return 0;
		}
	}
?>");
			}

			if (!file_exists("../panelwidgets/$widget->folder/templates"))
			{
				mkdir("../panelwidgets/$widget->folder/templates");
			}
			
			if (!file_exists("../panelwidgets/$widget->folder/templates"))
			{
				file_put_contents("", "../panelwidgets/$widget->folder/templates/$widget->templatefile");
			}
		}
		
		public function load($sid)
		{
			$mysqli = $this->init_mysqli();
			
			$query = "CALL LoadSettings(?)";
			$stmt = $mysqli->stmt_init();
			$stmt->prepare($query);
			$stmt->bind_param("s", $sid);
			$stmt->execute();

			$widgets = array();

			if ($result = $stmt->get_result())
			{				
				while ($obj = $result->fetch_object())
				{
					$user_widget = new UserWidget();
					$user_widget->widget = new Widget();
				
					$user_widget->id = $obj->uwid;
					$user_widget->id_widget = $obj->wid;
					$user_widget->id_html = $obj->id_html;
					$user_widget->enabled = $obj->enabled;
					$user_widget->visible = $obj->visible;
					$user_widget->position = $obj->position;
					$user_widget->widget->id = $obj->wid;
					$user_widget->widget->title = $obj->title;
					$user_widget->widget->updatetime = $obj->updatetime;
					$user_widget->widget->columns = $obj->columns;
					$user_widget->widget->templatefile = $obj->templatefile;
					$user_widget->widget->phpfile = $obj->phpfile;
					$user_widget->widget->folder = $obj->folder;
					$user_widget->widget->class_name = $obj->class_name;
					
					$widgets[] = $user_widget;
				}
				
				$result->close();
			}
			
			$stmt->close();
			$mysqli->close();
			
			return $widgets;
		}
		*/