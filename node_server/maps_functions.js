var dist = require('google-distance');
var nodeGeocoder = require('node-geocoder');

var options = {
    provider: 'google',
    httpAdapter: 'https'
}

var geocoder = nodeGeocoder(options);

var radian = function(x) {
    var calculated = x * Math.PI / 180;
    return calculated;
}

function googleCalculatingDistance(point1, point2, index) {
    var p1 = point1.lat + ',' + point1.lng;
    var p2 = point2.lat + ',' + point2.lng;

    dist.get({
            'index': index,
            'origin': p1,
            'destination': p2
        },
        function(err, data) {
            if (err) return console.log(err);
            // console.log(data)
        })
}

function calculateDistance(point1, point2) {
    var lat1 = point1.lat;
    var lng1 = point1.lng;
    var lat2 = point2.lat;
    var lng2 = point2.lng;

    var p = 0.017453292519943295;
    var c = Math.cos;
    var a = 0.5 - c((lat2 - lat1) * p) / 2 +
        c(lat1 * p) * c(lat2 * p) *
        (1 - c((lng2 - lng1) * p)) / 2;
    return 12742 * Math.asin(Math.sqrt(a));
}

function getCityName(latlng,callback) {
  var lat = latlng.lat;
  var lon = latlng.lng;
    geocoder.reverse({
        lat: lat,
        lon: lon
    },callback);
}

module.exports = {
    calculateDistance: calculateDistance,
    getCityName: getCityName
};
