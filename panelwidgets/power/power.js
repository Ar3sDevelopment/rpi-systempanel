function poweroff(cb)
{
	var util = require('util');
	var exec = require('child_process').exec;
	exec('/usr/bin/sudo poweroff', function (err, stdout, stderr) { cb(); });
}

function reboot(cb)
{
	var util = require('util');
	var exec = require('child_process').exec;
	exec('/usr/bin/sudo reboot', function (err, stdout, stderr) { cb(); });
}

exports.data = function (cb) {
	var res = {};
	cb(res);
};

exports.manage_post = function (post, cb) {
	if (post) {
		if (post.po) {
			poweroff(function () {
				cb(1, '');
			});
		} else if (post['pr']) {
			reboot(function () {
				cb(1, '');
			});
		}
	} else {
		cb(0, null);
	}
};
