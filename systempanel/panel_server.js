var express = require('express');
var app = express();
var url = require('url');
var fs = require('fs');
var path = require('path');
Bliss = require('bliss');
bliss = new Bliss();

app.engine('html', function(path, options, fn) {
	fn(null, bliss.render(path, options));
});

app.set('views', __dirname);
app.use('/css', express.static(__dirname + '/css'));
app.use('/fonts', express.static(__dirname + '/fonts'));
app.use('/images', express.static(__dirname + '/images'));
app.use('/js', express.static(__dirname + '/js'));
app.use('/tmp', express.static(__dirname + '/tmp'));

app.get('/:sid', function(req, res) {
	require('./index.js').page(req, res, app);
});

app.get('/login', function(req, res) {
	require('./login.js').page(req, res, app);
});

app.post('/login', function(req, res) {
	require('./login.js').page(req, res, app);
});

app.get('/logout', function (req, res) {
	res.redirect('/login');
});

app.listen(1338);
