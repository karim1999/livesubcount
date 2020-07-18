<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\Timezone;

class CountryWithTimezoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path() . '/app/public/countries.json';
        $countries = json_decode(file_get_contents($path), true);

        foreach ($countries as $country)
        {
            $c = Country::create([
                'en_name' => $country['en_name'],
                'ar_name' => $country['ar_name'],
                'code' => $country['country_code'],
                'en_capital' => $country['en_capital'],
                'ar_capital' => $country['ar_capital'],
                'lat' => $country['latlng'][0],
                'lng' => $country['latlng'][1],
            ]);
            foreach ($country['timezones'] as $timezone)
            {
                Timezone::create([
                    'country_id' => $c->id,
                    'name' => $timezone
                ]);
            }
        }
    }
}
