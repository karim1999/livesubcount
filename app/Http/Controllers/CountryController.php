<?php

namespace App\Http\Controllers;

use App\Country;
use App\Services\Helper;
use App\Timezone;
use Carbon\Carbon;

class CountryController extends Controller
{
    public function show(Country $country, $city_name)
    {
        $cityName = substr($city_name, 0, strpos($city_name, ','));
        $timezone = Timezone::where('name', 'LIKE', '%' . $cityName . '%')->firstOrFail();
        $now = Carbon::createFromTimestamp(Carbon::now()->timestamp, $timezone->name);
        $displayName = str_replace('_', ' ', $city_name);
        $sunData = Helper::getDayData($country->lat, $country->lng);
        $sunRise = Carbon::parse($sunData->sunrise);
        $sunSet = Carbon::parse($sunData->sunset);
        $hoursToSunset = gmdate('H:i', $sunSet->diffInSeconds(Carbon::now()));
        $formatedHoursToSunset = substr($hoursToSunset, 0, 2) . 'h ' . substr($hoursToSunset, 3, 4) . 'm';
        $getOffset = $now->getOffset() / 60 / 60;
        $dayLength = (string)number_format($sunData->day_length / 60 / 60, 2);
        $formatedDayLength = substr($dayLength, 0, strpos($dayLength, '.')) . 'h ' . substr($dayLength, strpos($dayLength, '.') + 1, strlen($dayLength)) . 'm';
        $solarNoon = Carbon::parse($sunData->solar_noon);
        $timeDiffrence = $this->timeDiffrence($now);


        return view('town', compact('country', 'now', 'displayName', 'city_name', 'sunRise', 'sunSet', 'formatedHoursToSunset', 'getOffset', 'timezone', 'formatedDayLength', 'solarNoon', 'timeDiffrence'));
    }

    private function timeDiffrence($time)
    {
        $diffrences = [];
        $now = Carbon::now()->timestamp;

        $los_ang = Carbon::createFromTimestamp($now, 'America/Los_Angeles');
        $london = Carbon::createFromTimestamp($now, 'Europe/London');
        $paris = Carbon::createFromTimestamp($now, 'Europe/Paris');
        $istanbul = Carbon::createFromTimestamp($now, 'Europe/Istanbul');
        $sydney = Carbon::createFromTimestamp($now, 'Australia/Sydney');
        $dubai = Carbon::createFromTimestamp($now, 'Asia/Dubai');
        $india = Carbon::createFromTimestamp($now, 'Asia/Kolkata');
        $beijing = Carbon::createFromTimestamp($now, 'Asia/Shanghai');
        $singapore = Carbon::createFromTimestamp($now, 'Asia/Singapore');
        $tokyo = Carbon::createFromTimestamp($now, 'Asia/Tokyo');
        $moscow = Carbon::createFromTimestamp($now, 'Europe/Moscow');

        $diffrences['los_angeles'] = $this->diffBetweenTwoTimezones($time, $los_ang);
        $diffrences['london'] = $this->diffBetweenTwoTimezones($time, $london);
        $diffrences['paris'] = $this->diffBetweenTwoTimezones($time, $paris);
        $diffrences['istanbul'] = $this->diffBetweenTwoTimezones($time, $istanbul);
        $diffrences['sydney'] = $this->diffBetweenTwoTimezones($time, $sydney);
        $diffrences['dubai'] = $this->diffBetweenTwoTimezones($time, $dubai);
        $diffrences['india'] = $this->diffBetweenTwoTimezones($time, $india);
        $diffrences['beijing'] = $this->diffBetweenTwoTimezones($time, $beijing);
        $diffrences['singapore'] = $this->diffBetweenTwoTimezones($time, $singapore);
        $diffrences['tokyo'] = $this->diffBetweenTwoTimezones($time, $tokyo);
        $diffrences['moscow'] = $this->diffBetweenTwoTimezones($time, $moscow);

        $timeInUct = Carbon::now();
        $timeInUct->setTimezone('UCT');
        $diffrences['uct'] = $this->diffBetweenTwoTimezones($time, $timeInUct);

        return $diffrences;
    }

    private function diffBetweenTwoTimezones($first_date, $second_date)
    {
        return ($second_date->getOffset() / 3600) - ($first_date->getOffset() / 3600);
    }
}
