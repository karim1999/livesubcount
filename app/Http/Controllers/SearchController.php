<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $results = DB::table('countries')
            ->select('countries.id', 'countries.en_name', 'countries.ar_name', 'en_capital', 'ar_capital')
            ->join('timezones', 'timezones.country_id', '=', 'countries.id')
            ->where('countries.en_name', 'LIKE', '%' . $request->city . '%')
            ->orWhere('countries.ar_name', 'LIKE', '%' . $request->city . '%')
            ->orWhere('countries.en_capital', 'LIKE', '%' . $request->city . '%')
            ->orWhere('countries.ar_capital', 'LIKE', '%' . $request->city . '%')
            ->orWhere('timezones.name', 'LIKE', '%' . $request->city . '%')
            ->get();

        $timezonesFinal['data'] = [];
        foreach ($results as $result) {
            $c = Country::with('timezones')->where('id', $result->id)->first();
            foreach ($c->timezones as $timezone) {
                if (strpos(strtolower($timezone->name), strtolower($request->city))) {
                    array_push($timezonesFinal['data'], ['id' => $c->id, 'name' => substr($timezone->name, strrpos($timezone->name, '/') + 1) . ', ' . $c->en_name]);
                }
            }
        }
        $timezonesFinal['data'] = array_unique($timezonesFinal['data'], SORT_REGULAR);
        return $timezonesFinal;
    }
}
