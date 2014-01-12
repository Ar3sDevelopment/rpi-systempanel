var Transmission = require('./')
var ProgressBar = require('progress');

var transmission = new Transmission({
	port : 9091,
	host : '127.0.0.1'
})
function get(id, cb) {
	transmission.get(id, function(err, result) {
		if (err) {
			throw err
		}
		cb(null, result.torrents[0])
	})
}

function watch(id) {
	get(id, function(err, torrent) {
		if (err) {
			throw err
		}
		var downloadedEver = 0
		var WatchBar = new ProgressBar('  downloading [:bar] :percent :etas', {
			complete : '=',
			incomplete : ' ',
			width : 35,
			total : torrent.sizeWhenDone
		})

		function tick(err, torrent) {
			if (err) {
				throw err
			}
			var downloaded = torrent.downloadedEver - downloadedEver
			downloadedEver = torrent.downloadedEver
			WatchBar.tick(downloaded);

			if (torrent.sizeWhenDone == torrent.downloadedEver) {
				return remove(id)
			}
			setTimeout(function() {
				get(id, tick)
			}, 1000)
		}

		get(id, tick)
	})
}

function remove(id) {
	transmission.remove(id, function(err) {
		if (err) {
			throw err
		}
		console.log('torrent was removed')
	})
}

transmission.add('http://cdimage.debian.org/debian-cd/7.1.0/i386/bt-cd/debian-7.1.0-i386-netinst.iso.torrent', {
	//options
}, function(err, result) {
	if (err) {
		return console.log(err)
	}
	var id = result.id
	watch(id)
})