exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {};

	exec("date +'%d %b %Y %T %Z'", function(err, stdout, stderr) {
		if (!err) {
			res.current_time = stdout;

			exec("uname -a", function(err, stdout, stderr) {
				if (!err) {
					var arr = stdout.split(/\s/);

					res.system = arr[0];
					res.host = arr[1];
					res.kernel = arr[2];
					res.firmware = arr[3];

					exec("cat /proc/uptime", function(err, stdout, stderr) {
						if (!err) {
							var arr = stdout.split(/\s/);

							var seconds = Math.round(arr[0]);
							var minutes = seconds / 60;
							var hours = minutes / 60;
							var days = Math.floor(hours / 24);

							hours = Math.floor(hours - Math.floor(days * 24));
							minutes = Math.floor(minutes - Math.floor(days * 24 * 60) - (hours * 60));

							res.uptime = (days <= 0 ? days + "d " : "") + hours + "h " + minutes + "m";
						}
						cb(res);
					});
				} else {
					cb(res);
				}
			});
		} else {
			cb(res);
		}
	});
};

exports.manage_post = function(post, cb) {
	cb(0, null);
};
