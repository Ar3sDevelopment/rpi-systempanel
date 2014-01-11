function execute(cmd, cb)
{
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
	if (post.cmd) {
		execute($_POST['cmd'], function (stdout) {
			//TODO: Va visualizzato il risultato di stdout da qualche parte, probabilmente andrà cambiato il manage post con res e req
			cb(1);
		});
	}
			
	cb(0);
};