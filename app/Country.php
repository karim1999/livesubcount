<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['en_name', 'ar_name', 'code', 'en_capital', 'ar_capital', 'lat', 'lng'];
    public $timestamps = false;

    public function timezones()
    {
        return $this->hasMany(Timezone::class);
    }
}
