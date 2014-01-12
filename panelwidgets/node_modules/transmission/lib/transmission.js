//node utils
var http = require('http');
var util = require('util');
var path = require('path');
var fs = require('fs');
var url = require('url');
var events = require('events');

var uuid = require('./utils').uuid;

var Transmission = module.exports = function(options) {

	events.EventEmitter.call(this);

	this.url = options.url || '/transmission/rpc';
	this.host = options.host || 'localhost';
	this.port = options.port || 9091;
	this.key = null;

	if (options.username) {
		this.authHeader = 'Basic ' + new Buffer(options.username + (options.password ? ':' + options.password : '')).toString('base64');
	}

};
// So will act like an event emitter
util.inherits(Transmission, events.EventEmitter);

Transmission.prototype.add = function(path, options, callback) {

	var args = {
		//
	}
	if ( typeof options === 'function') {
		callback = options;
	} else {
		if ( typeof options === 'object') {
			var keys = Object.keys(options)
			for (var i = 0; i < keys.length; i++) {
				args[keys[i]] = options[keys[i]]
			};
		} else {
			callback(new Error('Arguments mismatch for "bt.add"'))
		}
	}

	args['filename'] = path

	this.callServer({
		arguments : args,
		method : this.methods.torrents.add,
		tag : uuid()
	}, function(err, result) {
		if (err) {
			return callback(err)
		}
		var torrent = result['torrent-added']
		callback(err, torrent)
	})
}
Transmission.prototype.remove = function(ids, del, callback) {
	var ids = Array.isArray(ids) ? ids : [ids]
	if ( typeof del == 'function') {
		callback = del
		del = false
	}
	var options = {
		arguments : {
			ids : ids,
			"delete-local-data" : !!del
		},
		method : this.methods.torrents.remove,
		tag : uuid()
	}
	this.callServer(options, callback)
}
Transmission.prototype.get = function(ids, callback) {
	var options = {
		arguments : {
			fields : this.methods.torrents.fields,
			ids : ids
		},
		method : this.methods.torrents.get,
		tag : uuid()
	}

	if ( typeof ids == 'function') {
		callback = ids
		delete (options.arguments.ids)
	} else {
		options.arguments.ids = Array.isArray(ids) ? ids : [ids]
	}

	this.callServer(options, callback)
	return this
}
Transmission.prototype.peers = function(ids, callback) {
	var ids = Array.isArray(ids) ? ids : [ids]
	var options = {
		arguments : {
			fields : ['peers', 'hashString', 'id'],
			ids : ids
		},
		method : this.methods.torrents.get,
		tag : uuid()
	}
	this.callServer(options, function(err, result) {
		if (err) {
			return callback(err)
		}
		callback(null, result.torrents)
	})
	return this
}
Transmission.prototype.files = function(ids, callback) {
	var ids = Array.isArray(ids) ? ids : [ids]
	var options = {
		arguments : {
			fields : ['files', 'fileStats', 'hashString', 'id'],
			ids : ids
		},
		method : this.methods.torrents.get,
		tag : uuid()
	}
	this.callServer(options, function(err, result) {
		if (err) {
			return callback(err)
		}
		callback(null, result.torrents)
	})
	return this
}
Transmission.prototype.fast = function(ids, callback) {
	var ids = Array.isArray(ids) ? ids : [ids]
	var options = {
		arguments : {
			fields : ["id", "error", "errorString", "eta", "isFinished", "isStalled", "leftUntilDone", "metadataPercentComplete", "peersConnected", "peersGettingFromUs", "peersSendingToUs", "percentDone", "queuePosition", "rateDownload", "rateUpload", "recheckProgress", "seedRatioMode", "seedRatioLimit", "sizeWhenDone", "status", "trackers", "uploadedEver", "uploadRatio"],
			ids : ids
		},
		method : this.methods.torrents.get,
		tag : uuid()
	}
	this.callServer(options, function(err, result) {
		if (err) {
			return callback(err)
		}
		callback(null, result.torrents)
	})
	return this
}
Transmission.prototype.stop = function(ids, callback) {
	var ids = Array.isArray(ids) ? ids : [ids]
	this.callServer({
		arguments : {
			ids : ids
		},
		method : this.methods.torrents.stop,
		tag : uuid()
	}, callback)
	return this
}
Transmission.prototype.start = function(ids, callback) {
	var ids = Array.isArray(ids) ? ids : [ids]
	this.callServer({
		arguments : {
			ids : ids
		},
		method : this.methods.torrents.start,
		tag : uuid()
	}, callback)
	return this
}
Transmission.prototype.startNow = function(ids, callback) {
	
	var ids = Array.isArray(ids) ? ids : [ids]
	this.callServer({
		arguments : {
			ids : ids
		},
		method : this.methods.torrents.startNow,
		tag : uuid()
	}, callback)
	return this
}
Transmission.prototype.verify = function(ids, callback) {
	var ids = Array.isArray(ids) ? ids : [ids]
	this.callServer({
		arguments : {
			ids : ids
		},
		method : this.methods.torrents.verify,
		tag : uuid()
	}, callback)
	return this
}
Transmission.prototype.reannounce = function(ids, callback) {
	var ids = Array.isArray(ids) ? ids : [ids]
	this.callServer({
		arguments : {
			ids : ids
		},
		method : this.methods.torrents.reannounce,
		tag : uuid()
	}, callback)
	return this
}
Transmission.prototype.all = function(callback) {
	this.callServer({
		arguments : {
			fields : this.methods.torrents.fields
		},
		method : this.methods.torrents.get,
		tag : uuid()
	}, callback)
	return this
}

Transmission.prototype.active = function(callback) {
	var options = {
		arguments : {
			fields : this.methods.torrents.fields,
			ids : 'recently-active'
		},
		method : this.methods.torrents.get,
		tag : uuid()
	}
	this.callServer(options, callback)
	return this
}

Transmission.prototype.session = function(data, callback) {
	if ( typeof data !== 'function') {
		var keys = Object.keys(data)
		var key;
		for (var i = 0, j = keys.length; i < j; i++) {
			key = keys[i]
			if (!this.methods.session.setTypes[key]) {
				var error = new Error('Cant set type ' + key);
				error.result = page;
				callBack(error);
				return this
			}
		};
		var options = {
			arguments : data,
			method : this.methods.session.set,
			tag : uuid()
		}
	} else {
		var options = {
			method : this.methods.session.get,
			tag : uuid()
		}
	}
	this.callServer(options, data)
	return this
}

Transmission.prototype.sessionStats = function(callback) {
	var options = {
		method : this.methods.session.stats,
		tag : uuid()
	}
	this.callServer(options, callback)
}
Transmission.prototype.callServer = function(query, callBack) {
	var self = this;

	var options = {
		host : this.host,
		path : this.url,
		port : this.port,
		method : 'POST',
		headers : {
			'Time' : new Date(),
			'Host' : this.host + ':' + this.port,
			'X-Requested-With' : 'Node',
			'X-Transmission-Session-Id' : this.key || ''
		}
	};

	if (this.authHeader) {
		options.headers['Authorization'] = this.authHeader;
	}

	function onResponse(response) {
		var page = [];

		function onData(chunk) {
			page.push(chunk);
		}

		function onEnd() {
			if (response.statusCode == 409) {
				self.key = response.headers['x-transmission-session-id'];
				return self.callServer(query, callBack);
			} else if (response.statusCode == 200) {
				page = page.join('')
				try {
					var json = JSON.parse(page)
				} catch(err) {
					return callBack(err);
				}

				if (json.result === 'success') {
					callBack(null, json.arguments);
				} else {
					var error = new Error(json.result);
					error.result = page;
					callBack(error);
				}
			} else {
				var error = new Error('Status code mismatch');
				error.result = page;
				callBack(error);
			}
		}


		response.setEncoding('utf8');
		response.on('data', onData);
		response.on('end', onEnd);
	}

	var res = http.request(options, onResponse);
	res.on('error', callBack).end(JSON.stringify(query), 'utf8');

};

Transmission.prototype.statusArray = ['STOPPED', 'CHECK_WAIT', 'CHECK', 'DOWNLOAD_WAIT', 'DOWNLOAD', 'SEED_WAIT', 'SEED', 'ISOLATED']
Transmission.prototype.status = {}

Transmission.prototype.statusArray.forEach(function(status, i) {
	Transmission.prototype.status[status] = i
})

Transmission.prototype.methods = {
	torrents : {
		stop : 'torrent-stop',
		start : 'torrent-start',
		startNow : 'torrent-start-now',
		verify : 'torrent-verify',
		reannounce : 'torrent-reannounce',
		set : 'torrent-set',
		setTypes : {
			'bandwidthPriority' : true,
			'downloadLimit' : true,
			'downloadLimited' : true,
			'files-wanted' : true,
			'files-unwanted' : true,
			'honorsSessionLimits' : true,
			'ids' : true,
			'location' : true,
			'peer-limit' : true,
			'priority-high' : true,
			'priority-low' : true,
			'priority-normal' : true,
			'seedRatioLimit' : true,
			'seedRatioMode' : true,
			'uploadLimit' : true,
			'uploadLimited' : true
		},
		add : 'torrent-add',
		addTypes : {
			'download-dir' : true,
			'filename' : true,
			'metainfo' : true,
			'paused' : true,
			'peer-limit' : true,
			'files-wanted' : true,
			'files-unwanted' : true,
			'priority-high' : true,
			'priority-low' : true,
			'priority-normal' : true
		},
		remove : 'torrent-remove',
		removeTypes : {
			'ids' : true,
			'delete-local-data' : true
		},
		location : 'torrent-set-location',
		locationTypes : {
			'location' : true,
			'ids' : true,
			'move' : true
		},
		get : 'torrent-get',
		fields : ['activityDate', 'addedDate', 'bandwidthPriority', 'comment', 'corruptEver', 'creator', 'dateCreated', 'desiredAvailable', 'doneDate', 'downloadDir', 'downloadedEver', 'downloadLimit', 'downloadLimited', 'error', 'errorString', 'eta', 'files', 'fileStats', 'hashString', 'haveUnchecked', 'haveValid', 'honorsSessionLimits', 'id', 'isFinished', 'isPrivate', 'leftUntilDone', 'magnetLink', 'manualAnnounceTime', 'maxConnectedPeers', 'metadataPercentComplete', 'name', 'peer-limit', 'peers', 'peersConnected', 'peersFrom', 'peersGettingFromUs', 'peersKnown', 'peersSendingToUs', 'percentDone', 'pieces', 'pieceCount', 'pieceSize', 'priorities', 'rateDownload', 'rateUpload', 'recheckProgress', 'seedIdleLimit', 'seedIdleMode', 'seedRatioLimit', 'seedRatioMode', 'sizeWhenDone', 'startDate', 'status', 'trackers', 'trackerStats ', 'totalSize', 'torrentFile', 'uploadedEver', 'uploadLimit', 'uploadLimited', 'uploadRatio', 'wanted', 'webseeds', 'webseedsSendingToUs']
	},
	session : {
		stats : 'session-stats',
		get : 'session-get',
		set : 'session-set',
		setTypes : {
			'start-added-torrents' : true,
			'alt-speed-down' : true,
			'alt-speed-enabled' : true,
			'alt-speed-time-begin' : true,
			'alt-speed-time-enabled' : true,
			'alt-speed-time-end' : true,
			'alt-speed-time-day' : true,
			'alt-speed-up' : true,
			'blocklist-enabled' : true,
			'dht-enabled' : true,
			'encryption' : true,
			'download-dir' : true,
			'peer-limit-global' : true,
			'peer-limit-per-torrent' : true,
			'pex-enabled' : true,
			'peer-port' : true,
			'peer-port-random-on-start' : true,
			'port-forwarding-enabled' : true,
			'seedRatioLimit' : true,
			'seedRatioLimited' : true,
			'speed-limit-down' : true,
			'speed-limit-down-enabled' : true,
			'speed-limit-up' : true,
			'speed-limit-up-enabled' : true
		}
	},
	other : {
		blockList : 'blocklist-update',
		port : 'port-test'
	}
};
