function execute(cmd, cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	exec(cmd, function (err, stdout, stderr) {
		cb(stdout);
	});
}

exports.data = function (cb) {
	var res = {};
	cb(res);
};

exports.manage_post = function(post, cb) {
	if (post) {
		if (post.cmd) {
			execute($_POST['cmd'], function (stdout) {
				cb(1, stdout);
			});
		}
	} else {
		cb(0, null);
	}
};