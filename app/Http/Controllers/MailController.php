<?php

namespace App\Http\Controllers;

use App\Models\TruckSchedule;
use Illuminate\Http\Request;

// pdf
use Barryvdh\DomPDF\Facade\Pdf;

// kirim mail
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use App\Mail\SendTruckSchedule;
// use Illuminate\Support\Carbon;
// hash token
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;


class MailController extends Controller
{
    public function schedule_pdf($id)
    {
        $item = TruckSchedule::with(['truckType', 'driverName'])->find($id);
        $template = [
            'title' => 'TRUCK SCHEDULE',
            'date' => date('m/d/Y'),
            'data' => $item
        ];
        $pdf = Pdf::loadView('generate-data-pdf', $template);
        $filePath = 'public/pdfs/truck-schedule-' . $id . '.pdf';
        Storage::put($filePath, $pdf->output());
    
        return $filePath;
        // $url = url('/') . Storage::url($filePath);
        // return response()->json(['url' => $url]);
    }

    public function send_email(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'id' => 'required|integer|exists:truck_schedules,id',
        ]);

        $filePath = $this->schedule_pdf($validated['id']);

        // Generate the PDF and get the download link
        // $response = $this->schedule_pdf($validated['id']);
        // $pdfLink = $response->getData()->url;
        
        // $pdfLink = URL::temporarySignedRoute('pdf.download', now()->addHour(), ['path' => $filePath]);
        
        // $pdfLink = URL::temporarySignedRoute('pdf.download', now()->addHour(), ['file' => $filePath]);
        $pdfLink = URL::temporarySignedRoute('pdf.download', now()->addMinutes(1), ['file' => $filePath]);

        // Send the email
        Mail::to($validated['email'])->send(new SendTruckSchedule($pdfLink));

        return response()->json(['message' => 'Email sent successfully']);
    }

    // public function schedule_pdf($id)
    // {
    //     $item = TruckSchedule::with(['truckType', 'driverName'])->find($id);
    //     $template = [
    //         'title' => 'TRUCK SCHEDULE',
    //         'date' => date('m/d/Y'),
    //         'data' => $item
    //     ];
    //     $pdf = Pdf::loadView('generate-data-pdf', $template);
    //     $filePath = 'public/pdfs/truck-schedule-' . $id . '.pdf';
    //     Storage::put($filePath, $pdf->output());
    
    //     $url = url('/') . Storage::url($filePath);
    //     return response()->json(['url' => $url]);
    // }
    // public function send_email(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //         'id' => 'required|integer|exists:truck_schedules,id',
    //     ]);

    //     // Generate the PDF and get the download link
    //     $response = $this->schedule_pdf($validated['id']);
    //     $pdfLink = $response->getData()->url;

    //     // Send the email
    //     Mail::to($validated['email'])->send(new SendTruckSchedule($pdfLink));

    //     return response()->json(['message' => 'Email sent successfully']);
    // }
}
