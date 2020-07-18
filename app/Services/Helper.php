<?php


namespace App\Services;


class Helper
{
    public static function getUserTimezone()
    {
        $ip = file_get_contents("http://ipecho.net/plain");
        $url = 'http://ip-api.com/json/' . $ip;
        $tz = file_get_contents($url);
        $data['timezone'] = json_decode($tz, true)['timezone'];
        $data['city'] = json_decode($tz, true)['city'];
        $data['country'] = json_decode($tz, true)['country'];
        return $data;
    }

    public static function getDayData($lat, $lng)
    {
        $link = "https://api.sunrise-sunset.org/json?lat=" . $lat . "&lng=" . $lng . "&date=today&formatted=0";
        return json_decode(file_get_contents($link))->results;
    }
}
