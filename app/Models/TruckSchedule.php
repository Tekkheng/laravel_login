<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckSchedule extends Model
{
    use HasFactory;

    // protected $table = 'truck_schedules';
    protected $fillable = ['plat_no','tipe_truck','tgl_berangkat','tgl_sampai'];
}
