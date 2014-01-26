exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {};

	exec("cat /sys/class/thermal/thermal_zone0/temp", function(err, stdout, stderr) {
		if (!err) {
			res.cpu_temperature = Math.round(stdout / 1000).toFixed(1);
		}

		cb(res);
	});
};

exports.manage_post = function(post, cb) {
	cb(0, null);
};
