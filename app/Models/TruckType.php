<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Truck;
// use App\Models\Driver;

class TruckType extends Model
{
    use HasFactory;
    protected $table = 'master_tipe_truck';
    protected $primaryKey = 'no';
    protected $fillable = ['tipe_truck'];

    public function trucks()
    {
        return $this->hasMany(Truck::class);
    }
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function truckschedules()
    {
        return $this->hasMany(TruckSchedule::class);
    }
}
