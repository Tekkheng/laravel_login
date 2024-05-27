<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckSchedule extends Model
{
    use HasFactory;

    // protected $table = 'truck_schedules';
    protected $fillable = ['nama_driver','plat_no','tipe_truck','tgl_berangkat','tgl_sampai'];

    public function truckType()
    {
        return $this->belongsTo(TruckType::class, 'tipe_truck', 'no');
    }
    // ****
    public function driverName()
    {
        return $this->belongsTo(Driver::class, 'nama_driver', 'id');
    }
}
