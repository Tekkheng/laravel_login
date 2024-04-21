<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    protected $table = 'master_truck';
    protected $primaryKey = 'no';

    protected $fillable = ['plat_no', 'tipe_truck'];
}
