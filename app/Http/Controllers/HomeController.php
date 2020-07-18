<?php

namespace App\Http\Controllers;

use App\Services\Helper;
use App\Timezone;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $data = Helper::getUserTimezone();
        $userTimezone = $data['timezone'];
        $timezone = Timezone::where('name', $userTimezone)->firstOrFail();
        $country = $timezone->country;
        $cityName = substr($timezone->name, strrpos($timezone->name, '/') + 1);
        $displayName = $cityName . ', ' . $country->en_name;
        $sunData = Helper::getDayData($country->lat, $country->lng);
        $sunRise = Carbon::parse($sunData->sunrise);
        $sunSet = Carbon::parse($sunData->sunset);
        $hoursToSunset = gmdate('H:i', $sunSet->diffInSeconds(Carbon::now()));
        $formatedHoursToSunset = substr($hoursToSunset, 0, 2) . 'h ' . substr($hoursToSunset, 3, 4) . 'm';

        $now = Carbon::createFromTimestamp(Carbon::now()->timestamp, $userTimezone);
        $getOffset = $now->getOffset() / 60 / 60;

        return view('index', compact('now', 'country', 'displayName', 'sunRise', 'sunSet', 'formatedHoursToSunset', 'getOffset'));
    }
}
