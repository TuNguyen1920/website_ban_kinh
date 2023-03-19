<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    const CITY = 0;
    const LEVEL_CITY = 1;
    protected $fillable = [
        'loc_name',
        'loc_name_lower',
        'loc_slug',
        'loc_parent_id',
        'loc_city_id',
        'loc_district_id',
        'loc_street_id',
        'loc_ward_id',
        'loc_level',
        'loc_code',
        'loc_type',
        'loc_description',
        'loc_description_full',
        'loc_status',
        'created_at',
        'updated_at'
    ];

    public function getCity()
    {
        return Locations::where('loc_city_id',Locations::CITY)->select('id','loc_name')->get();
    }

}
