<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = ['nama_driver','tipe_driver_truck','isActive'];

    protected $attributes = [
        'isActive' => true,
    ];

    public function truckType()
    {
        return $this->belongsTo(TruckType::class, 'tipe_driver_truck', 'no');
    }

    // ***
    public function truckschedules()
    {
        return $this->hasMany(TruckSchedule::class);
    }
}
