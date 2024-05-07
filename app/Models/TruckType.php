<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truck;

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
}
