exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {};
	var fs = require('fs');

	fs.readFile('/proc/meminfo', {
		encoding : 'utf8'
	}, function(err, data) {
		if (!err) {
			var meminfo = data.split(/[\r\n]{1,2}/);

			for (var c = 0; c < meminfo.length; c++) {
				var splitArr = meminfo[c].split(/:/);
				if (splitArr.length > 1) {
					var item = splitArr[0].trim();
					var item_data = splitArr[1].trim().split(/\s/)[0];

					switch(item) {
						case "MemTotal":
							res.total_mem = item_data;
							break;
						case "MemFree":
							res.free_mem = item_data;
							break;
						case "SwapTotal":
							res.total_swap = item_data;
							break;
						case "SwapFree":
							res.free_swap = item_data;
							break;
						case "Buffers":
							res.buffer_mem = item_data;
							break;
						case "Cached":
							res.cache_mem = item_data;
							break;
						default:
							break;
					}
				}
			}

			res.used_mem = res.total_mem - res.free_mem;
			res.used_swap = res.total_swap - res.free_swap;
			res.percent_free = Math.round((res.free_mem / res.total_mem) * 100);
			res.percent_used = Math.round((res.used_mem / res.total_mem) * 100);
			res.percent_swap = Math.round(((res.total_swap - res.free_swap ) / res.total_swap) * 100);
			res.percent_swap_free = Math.round((res.free_swap / res.total_swap) * 100);
			res.percent_buff = Math.round((res.buffer_mem / res.total_mem) * 100);
			res.percent_cach = Math.round((res.cache_mem / res.total_mem) * 100);
		}

		cb(res);
	});
};

exports.manage_post = function(post, cb) {
	cb(0);
}; 