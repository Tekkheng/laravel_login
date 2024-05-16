<?php

namespace App\Http\Controllers;

use App\Models\TruckType;
use Illuminate\Http\Request;

class TypeTruckController extends Controller
{
    public function index()
    {
        $data = TruckType::get();
        return response()->json($data, 200);
    }

}
