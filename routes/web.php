<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/greeting', function () {
    return 'Hello World';
});


Route::get('/test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('verticol22@gmail.com')
                ->subject('Test Email');
    });

    return 'Email sent successfully!';
});

Route::get('/download-pdf', function (Request $request) {
    $file = $request->query('file');  // Gunakan query() untuk mendapatkan parameter 'file' dari URL
    if (!Storage::exists($file)) {
        abort(404);
    }
    return Storage::download($file);
})->name('pdf.download')->middleware('signed');
