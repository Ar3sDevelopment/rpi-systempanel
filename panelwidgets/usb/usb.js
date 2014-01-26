exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {
		devices : []
	};

	exec("lsusb", function(err, stdout, stderr) {
		if (!err) {
			var devicesInfo = stdout.split(/[\r\n]{1,2}/);
			for (var c = 0; c < devicesInfo.length; c++) {
				var usbinfo = devicesInfo[c].split(/\s+/);
				if (usbinfo.length >= 5) {
					var device = {
						bus : usbinfo[1],
						device : usbinfo[3].replace(':', ''),
						id : usbinfo[5]
					};

					var name = '';
					for (var i = 6; i < usbinfo.length; i++) {
						name += usbinfo[i] + ' ';
					}

					device.name = name.trim();

					res.devices.push(device);
				}
			}
		}
		cb(res);
	});
};

exports.manage_post = function(post, cb) {
	cb(0, null);
};
