<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeoLocation extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'geo_locations';

    protected $fillable = [
        'user_id',
        'lot',
        'area',
        'state_id',
        'district_id',
        'city_id',
        'latitude_map',
        'longitude_map',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

}
