exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {
		disks : []
	};

	exec("df -h -T -x tmpfs -x devtmpfs -x rootfs -x fuse -x cifs", function(err, stdout, stderr) {
		if (!err) {
			var diskfree = stdout.split(/[\r\n]{1,2}/);
			delete diskfree[0];

			for (var c = 0; c < diskfree.length; c++) {
				if (diskfree[c]) {
					var splitArr = diskfree[c].split(/\s+/);
					var obj = {
						mount : splitArr[0],
						typex : splitArr[1],
						size : splitArr[2],
						used : splitArr[3],
						avail : splitArr[4],
						percent_used : parseInt(splitArr[5].replace('%', ''))
					};
					obj.percent_avail = 100 - obj.percent_used;
					res.disks.push(obj);
				}
			}
		}

		cb(res);
	});
};

exports.manage_post = function(post, cb) {
	cb(0, null);
};
