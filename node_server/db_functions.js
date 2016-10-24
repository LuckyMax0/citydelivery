var mysql = require('mysql');
var config = require('../config/config.json');

var pool = mysql.createPool({
    connectionLimit: 100,
    host: config.dbHost,
    user: config.dbUser,
    password: config.dbPassword,
    database: config.dbName
})


function getCityPackages(city,callback) {
  pool.query('SELECT * FROM packages WHERE start_city=?',[city],callback);
}

module.exports = {
    getCityPackages: getCityPackages
}
