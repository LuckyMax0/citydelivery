<?php

$config['db']['host'] = 'localhost';
$config['db']['user'] = 'admin_cityadmin';
$config['db']['password'] = 'HmbbGgCDmU';
$config['db']['database'] = 'admin_cityd';

function geocode($address)
{
    $address = urlencode($address);
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
    $resp_json = file_get_contents($url);
    $resp = json_decode($resp_json, true);
    if ($resp['status'] == 'OK') {
        // get the important data
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        $formatted_address = $resp['results'][0]['formatted_address'];
        if ($lati && $longi && $formatted_address) {
            $data_arr = array();
            array_push(
                $data_arr,
                    $lati,
                    $longi,
                    $formatted_address
                );
            return $data_arr;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
