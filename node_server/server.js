var express = require('express');
var cors = require('cors')
var bodyParser = require('body-parser');
var request = require('request');
var db = require('./db_functions.js');
var app = express();

var map = require('./maps_functions.js');
var sortlib = require('./sorting_functions.js')

var log = require('simple-node-logger').createSimpleLogger('project.log');var log = require('simple-node-logger').createSimpleLogger('project.log');var log = require('simple-node-logger').createSimpleLogger('project.log');

log.info("Server starting!!!");

app.use(cors());
app.use(bodyParser.urlencoded());
app.use(bodyParser.json());

app.listen((process.env.PORT || 3030));



app.post('/getCityPackages', function(req, res) {
    var coords = req.body;
    var userCoords = {
        lat: coords.location.pos.lat,
        lng: coords.location.pos.lng
    }
    map.getCityName(userCoords, (err, data) => {
        if (err) {
            console.log(err);
            return;
        }
        var city = data[0].city;
        db.getCityPackages(city, (err,packages)=>{
          if(err){
            console.log(err);
            res.sendStatus(500).end();
            return;
          }
          var all = packages.length;
          var distances = [];
          packages.forEach((package)=>{
            var packageLatLng = package.start_latlng;
            var targetLatLng = package.end_latlng;
            packageLatLng = packageLatLng.split(',');
			targetLatLng = targetLatLng.split(',');
            var startCoords = {lat : packageLatLng[0],lng : packageLatLng[1]}; //!!!!!!! MUSI BYĆ OBLICZANE PRZY REJESTRACJI
			var endCoords = {lat : targetLatLng[0],lng : targetLatLng[1]};
            var meters = map.calculateDistance(endCoords,startCoords);
            var startAddress = package.start_address;
			var startCity = package.start_city;
			var startZipcode = package.start_zipcode;
            var endAddress = package.end_address;
			var endCity = package.end_city;
			var endZipcode = package.end_zipcode;
            var pst = package.prefered_send_time;
            var dimensions = package.dimensions;
            var mass = package.mass;
            var userID = package.senderid;
            var id = package.id;

            var distance = {
              "distance" : meters,
              "startPoint" : packageLatLng,
              "endPoint" : targetLatLng,
              "startAddress" : startAddress,
			  "startCity" : startCity,
			  "startZipcode" : startZipcode,
              "endAddress" : endAddress,
			  "endCity" : endCity,
			  "endZipcode" : endZipcode,
              "preferedSendTime" : pst,
              "dimensions" : dimensions,
              "mass" : mass,
              id : id
            }
            distances.push(distance);
          })
          distances.sort(sortlib.dynamicSort("distance"));
          res.setHeader('Content-Type', 'application/json');
          res.writeHead(200,{'Content-Type': 'application/json'})
          res.end(JSON.stringify(distances));

        });
    })






})
