exports.data = function(cb) {
	var util = require('util');
	var exec = require('child_process').exec;
	var res = {};
	var Transmission = require('transmission');

	var transmission = new Transmission({
		port : 9091,
		host : '127.0.0.1'
	});

	transmission.sessionStats(function(err, stats_result) {
		if (!err) {
			res.total_torrents = stats_result.torrentCount;
			res.active_torrents = stats_result.activeTorrentCount;

			transmission.get(function(err, get_results) {
				if (!err) {
					var statuses = {};

					for (var c = 0; c < get_results.torrents; c++) {
						var torrent = get_results.torrents[c];
						statuses[torrent.status] = statuses[torrent.status] + 1;
					}

					res.downloading_torrents = statuses[4] || 0;
					res.seeding_torrents = statuses[6] || 0;
				}

				cb(res);
			});
		} else {
			cb(res);
		}
	});
};

function stop() {
	var Transmission = require('transmission');
	var transmission = new Transmission({
		port : 9091,
		host : '127.0.0.1'
	});

	transmission.stop(function(err, arg) {
	});
}

function start() {
	var Transmission = require('transmission');
	var transmission = new Transmission({
		port : 9091,
		host : '127.0.0.1'
	});

	transmission.start(function(err, arg) {
	});
}

exports.manage_post = function(post, cb) {
	if (post) {
		if (post.sta) {
			start();

			cb(1, '');
		} else if (post.sto) {
			stop();

			cb(1, '');
		}
	} else {
		cb(0);
	}
};
