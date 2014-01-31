exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {};

	var output1 = null;
	var output2 = null;
	exec("cat /proc/stat", function(err, stdout, stderr) {
		if (!err) {
			output1 = stdout.split(/[\n\r]{1,2}/);
			setTimeout(function() {
				exec("cat /proc/stat", function(err, stdout, stderr) {
					if (!err) {
						output2 = stdout.split(/[\n\r]{1,2}/);
						res.cpuload = 0;
						for (var i = 0; i < 1; i++) {
							var cpu_stat_1 = output1[i + 1].split(/\s/);
							var cpu_stat_2 = output2[i + 1].split(/\s/);
							var info1 = {
								user : parseInt(cpu_stat_1[1]),
								nice : parseInt(cpu_stat_1[2]),
								system : parseInt(cpu_stat_1[3]),
								idle : parseInt(cpu_stat_1[4])
							};

							var info2 = {
								user : parseInt(cpu_stat_2[1]),
								nice : parseInt(cpu_stat_2[2]),
								system : parseInt(cpu_stat_2[3]),
								idle : parseInt(cpu_stat_2[4])
							};

							var idlesum = info2.idle - info1.idle + info2.system - info1.system;
							var sum1 = info1.user + info1.nice + info1.system + info1.idle;
							var sum2 = info2.user + info2.nice + info2.system + info2.idle;

							res.cpuload += (1 - (idlesum / (sum2 - sum1))) * 100;
						}

						res.cpuload = res.cpuload.toFixed(1);
					}
					
					cb(res);
				});
			}, 1000);
		} else {
			cb(res);
		}
	});
};

exports.manage_post = function(post, cb) {
	cb(0, null);
};
