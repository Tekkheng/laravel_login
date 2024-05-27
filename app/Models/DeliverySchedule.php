<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySchedule extends Model
{
    use HasFactory;

    protected $table = 'delivery_schedules';
    protected $fillable = ['no_delivery','plat_no','tgl_berangkat','tgl_sampai'];

    public function platNo()
    {
        return $this->belongsTo(Truck::class, 'plat_no', 'no');
    }
}
