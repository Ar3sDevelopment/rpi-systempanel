function human_bytes(bytes) {
	var strings = ['B', 'KB', 'MB', 'GB', 'TB'];
	var idx = 0;

	while (bytes > 1024) {
		bytes /= 1024;
		idx++;
	}

	return bytes.toFixed(2) + ' ' + strings[idx];
}

function get_nic_details(nicname, cb) {
	var util = require('util');
	var exec = require('child_process').exec;

	exec("/sbin/ifconfig " + nicname, function(err, stdout, stderr) {
		var nicrecord = {
			name: nicname
		};

		if (!err) {
			var ifnic = stdout.split(/[\r\n]{1,2}/);
			var match = ifnic[0].match(/Link encap:((\w+\s?)+)/);

			if (match != null && match.length > 1) {
				nicrecord.encap = match[1];
			}

			match = ifnic[0].match(/HWaddr\s((\w{2}:){5}\w{2})/);

			if (match != null && match.length > 1) {
				nicrecord.mac = match[1];
			}

			match = ifnic[1].match(/inet addr:((\d{1,3}\.){3}\d{1,3})/);

			if (match != null && match.length > 1) {
				nicrecord.ip = match[1];
			}

			match = ifnic[6].match(/RX bytes:(\d+)/);

			if (match != null && match.length > 1) {
				nicrecord.rx = human_bytes(match[1]);
			}

			match = ifnic[6].match(/TX bytes:(\d+)/);

			if (match != null && match.length > 1) {
				nicrecord.tx = human_bytes(match[1]);
			}
		}

		cb(nicrecord);
	});
}

exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {
		nics : []
	};

	exec("/sbin/ifconfig -s -a", function(err, stdout, stderr) {
		if (!err) {
			var nics = stdout.split(/[\r\n]{1,2}/);

			(function iterator(index) {
				if (index == nics.length) {
					cb(res);
				} else {
					var nic = nics[index];
					if (nic.length > 0) {
						var nicname = nic.split(/\s+/);
						get_nic_details(nicname[0], function(nicrecord) {
							res.nics.push(nicrecord);
							iterator(index + 1);
						});
					} else {
						iterator(index + 1);
					}
				}
			})(1);
		} else {
			cb(res);
		}
	});
};

exports.manage_post = function(post, cb) {
	cb(0, null);
};
