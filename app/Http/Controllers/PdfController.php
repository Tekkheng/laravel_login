<?php

namespace App\Http\Controllers;

use App\Models\TruckSchedule;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function generate_pdf($id){
        $item = TruckSchedule::with(['truckType','driverName'])->find($id);
        $template = [
            'title' => 'TRUCK SCHEDULE',
            'date' => date('m/d/Y'),
            'data' => $item
        ];
        $pdf = Pdf::loadView('generate-data-pdf', $template);
        return $pdf->download('truck-schedule.pdf');
    }
}
