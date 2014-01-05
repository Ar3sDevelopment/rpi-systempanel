exports.data = function (cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {};
	
	exec("cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq", function (err, stdout, stderr) {
		res.frequency = stdout / 1000;
		
		exec("cat /proc/cpuinfo | grep model", function (err, stdout, stderr) {
			var processorArr = stdout.split(": ");
			res.processor = processorArr[1].replace("-compatible processor", "");
			
			exec("cat /sys/class/thermal/thermal_zone0/temp", function (err, stdout, stderr) {
				res.cpu_temperature = Math.round(stdout / 1000).toFixed(1);
				
				var output1 = null;
				var output2 = null;
				exec("cat /proc/stat", function (err, stdout, stderr) {
					output1 = stdout.split(/[\n\r]{1,2}/);
					setTimeout(function () {
						exec("cat /proc/stat", function (err, stdout, stderr) {
							output2 = stdout.split(/[\n\r]{1,2}/);
							res.cpuload = 0;
							for (i = 0; i < 1; i++)
							{
								var cpu_stat_1 = output1[i+1].split(/\s/);
								var cpu_stat_2 = output2[i+1].split(/\s/);
								var info1 = {
									user: parseInt(cpu_stat_1[1]),
									nice: parseInt(cpu_stat_1[2]),
									system: parseInt(cpu_stat_1[3]),
									idle: parseInt(cpu_stat_1[4])
								};
								
								var info2 = {
									user: parseInt(cpu_stat_2[1]),
									nice: parseInt(cpu_stat_2[2]),
									system: parseInt(cpu_stat_2[3]),
									idle: parseInt(cpu_stat_2[4])
								};
								
								
								var idlesum = info2.idle - info1.idle + info2.system - info1.system;
								var sum1 = info1.user + info1.nice + info1.system + info1.idle;
								var sum2 = info2.user + info2.nice + info2.system + info2.idle;
						
								var load = (1 - (idlesum / (sum2 - sum1))) * 100;
								res.cpuload += load;
							}
							
							res.cpuload = res.cpuload.toFixed(1);
							exec("lscpu -p | grep '^[0-9]'", function (err, stdout, stderr) {
								var split = stdout.split(/\,/);
							
								if (split.length > 3) {
									res.cpus = split[0] + 1;
									res.cores = split[1] + 1;
									res.sockets = split[2] + 1;
									res.nodes = split[3];
								} else {
									res.cpus = split[0] + 1;
									res.cores = split[1] + 1;
									res.sockets = split[2] + 1;
								}
								
								cb(res);
							});
						});
					}, 1000);
				});
			});
		});
	});
};

exports.manage_post = function (cb) {
	cb(0);
};
