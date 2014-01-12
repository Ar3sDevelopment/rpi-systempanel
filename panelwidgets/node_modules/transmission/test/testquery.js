var bt = new (require('../lib/transmission.js'))({
	//port : 9091,
	//host : 'localhost',
	//username : 'hoge',
	//password : 'fuga'
})

bt.add('http://cdimage.debian.org/debian-cd/6.0.6/i386/bt-cd/debian-6.0.6-i386-netinst.iso.torrent', function(err, result) {
	if (err) {
		throw err
	}
	var id = result.id
	//console.log(result)
	bt.stop(id, function(err) {
		if (err) {
			throw err
		}
		bt.start(id, function(err) {
			if (err) {
				throw err
			}
			bt.get(id, function(err, result) {
				if (err) {
					throw err
				}
				//console.log(result)

				bt.remove(id, true, function(err) {
					if (err) {
						throw err
					}
				})
			})
		})
	})
})