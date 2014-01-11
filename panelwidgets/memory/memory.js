exports.data = function (cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = { ram_usages: [] };
	var fs = require('fs');
	
	fs.readFile('/proc/meminfo', { encoding: 'utf8' }, function (err, data) {
		if (!err) {
			var total_mem = 0;Free
			var free_mem = 0;
			var meminfo = data.split(/[\r\n]{1,2}/);
			
			for (var c = 0; c < meminfo.length; c++)
			{
				var splitArr = meminfo[c].split(/:/);
				if (splitArr.length > 1) {
					var item = splitArr[0].trim();
					var item_data = splitArr[1].trim().split(/\s/)[0];
					
					switch(item)
					{
						case "MemTotal":
							total_mem = item_data;
							break;
						case "MemFree":
							free_mem = item_data;
							break;
						default:
							break;
					}
				}
			}
			
			used_mem = total_mem - free_mem;
			percent_free = Math.round((free_mem / total_mem) * 100);
			percent_used = Math.round((used_mem / total_mem) * 100);
			var item_free = {
				ram_percent: percent_free,
				ram_description: 'Free'
			};
			var item_used = {
				ram_percent: percent_used,
				ram_description: 'Used'
			};
			
			res.ram_usages = [item_used, item_free];
		}
		
		cb(res);
	});
};

exports.manage_post = function (post, cb) {
	cb(0);
};