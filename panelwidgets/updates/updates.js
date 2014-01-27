exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {
		updates : []
	};

	exec("/usr/bin/sudo /usr/bin/apt-get --just-print upgrade", function(err, stdout, stderr) {
		if (!err) {
			var updates = stdout.split(/[\r\n]{1,2}/);
			for (var c = 0; c < updates.length; c++) {
				var update = updates[c];
				if (update) {
					var matches = update.match(/^Inst\s+(.*)\s+\[(.*)\]\s+\(([^s]*)\s+.*\)/);
					if (matches && matches.length) {
						res.updates.push({
							name : matches[1],
							old_version : matches[2],
							new_version : matches[3]
						});
					}
				}
			}
		}

		cb(res);
	});
};

exports.manage_post = function(post, cb) {
	cb(0, null);
}; 