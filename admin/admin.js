var express = require('express');
var app = express();
var stylus = require('stylus');
var nib = require('nib');

function compile(str, path) {
	return stylus(str).set('filename', path).use(nib());
}

app.set('views', __dirname + '/views');
app.set('view engine', 'jade');
app.use(express.logger('dev'));
app.use(stylus.middleware( { src: __dirname + '/public' , compile: compile } ));
app.use(express.static(__dirname + '/public'));
app.use(express.urlencoded());
app.use(express.json());
app.use(express.methodOverride());
app.use(app.router);

app.get('/index/:sid', function (req, res, next) {
});

module.exports = app;
