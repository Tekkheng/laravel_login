<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $data = Driver::with('truckType')->get();
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function updateStatus(Request $request, Driver $driver)
    // {
    //     $request->validate([
    //         'isActive' => 'required|boolean', // Assuming isActive is a boolean field in the trucks table
    //     ]);

    //     $driver->update([
    //         'isActive' => $request->isActive,
    //     ]);

    //     return response()->json($driver);
    // }
    public function updateStatus(Request $req, $id)
    {
        try{
            $validasi = Validator::make(
                $req->all(),
                [
                    'isActive' => 'required|boolean',
                ],
            );
            if ($validasi->fails()) {
                $res = [
                    'success' => false,
                    'status' => 422,
                    'message' => $validasi->errors(),
                ];
                return response()->json($res, 422);
            }
            $driver = Driver::find($id);
        
            // Periksa apakah driver ditemukan
            if (!$driver) {
                return response()->json(['message' => 'Driver not found'], 404);
            }
    
            // Update nilai isActive
            $driver->isActive = $req->isActive;
            
            $driver->save();
            return response()->json($driver,200);
        }catch(\Throwable $th){
            $response = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($response, 500);
        }
    }
    public function create(Request $req)
    {
        try {
            $validasi = Validator::make(
                $req->all(),
                [
                    'nama_driver' => 'required|string|max:255',
                    'tipe_driver_truck' => 'required|integer|max:255',
                ],
            );
            if ($validasi->fails()) {
                $res = [
                    'success' => false,
                    'status' => 422,
                    'message' => $validasi->errors(),
                ];
                return response()->json($res, 422);
            }
            // if ($validasi->fails()) {
            //     return response()->json('field Plat No dan tipe truck harus di isi dengan benar!', 422);
            // }
            $data = new Driver();
            $data->nama_driver = $req->nama_driver;
            $data->tipe_driver_truck = $req->tipe_driver_truck;
            // $data->isActive = $req->isActive;

            $data->save();
            $res = [
                'status' => 200,
                'message' => 'success add new data drivers',
                'data' => $data,
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $response = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($response, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $dataId = Driver::find($id);
            if ($dataId == null) {
                return response()->json("data pada id=$id, tidak ada!", 404);
            }
            return response()->json($dataId, 200);
        } catch (\Throwable $th) {
            $response = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($response, 500);
        }
    }
    public function update(Request $req, $id)
    {
        try {
            $validasi = Validator::make(
                $req->all(),
                [
                    'nama_driver' => 'required|string|max:255',
                    'tipe_driver_truck' => 'required|integer|max:255',
                    'isActive' => 'required|boolean',
                ],
            );
            if ($validasi->fails()) {
                return response()->json($validasi->errors(), 422);
            }

            $data = Driver::find($id);
            if ($data == null) {
                return response()->json("data pada id=$id, tidak ada!", 404);
            }
            $data->nama_driver = $req->nama_driver;
            $data->tipe_driver_truck = $req->tipe_driver_truck;
            $data->isActive = $req->isActive;

            $data->save();
            $res = [
                'status' => 200,
                'message' => 'success update data drivers!',
                'data' => $data,
            ];
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            $response = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($response, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $dataId = Driver::find($id);
            if ($dataId == null) {
                return response()->json(["data pada id=$id, tidak ada!", 404]);
            } else {
                $dataId->delete();
                return response()->json("data pada id=$id, berhasil di hapus!", 200);
            }
        } catch (\Throwable $th) {
            $res = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($res, 500);
        }
    }
}
