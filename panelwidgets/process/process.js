exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {
		procs : []
	};

	exec("ps aux", function(err, stdout, stderr) {
		if (!err) {
			var procsinfo = stdout.split(/[\r\n]{1,2}/);
			delete procsinfo[0];
			for (var c = 0; c < procsinfo.length; c++) {
				var procinfo = procsinfo[c];
				if (procinfo) {
					var split = procinfo.split(/\s+/);
					if (split.length > 10) {
						res.procs.push({
							user : split[0],
							pid : split[1],
							cpu_percent : split[2],
							mem_percent : split[3],
							start_date : split[9],
							command : split[10]
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