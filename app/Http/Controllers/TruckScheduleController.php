<?php

namespace App\Http\Controllers;

use App\Models\TruckSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TruckScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TruckSchedule::get();
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        try {
            $validasi = Validator::make(
                $req->all(),
                [
                    'plat_no' => 'required|string|max:255',
                    'tipe_truck' => 'required|string|max:255',
                    'tgl_berangkat' => 'required|string|max:255',
                    'tgl_sampai' => 'required|string|max:255',
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
            $data = new TruckSchedule();
            $data->plat_no = $req->plat_no;
            $data->tipe_truck = $req->tipe_truck;
            $data->tgl_berangkat = $req->tgl_berangkat;
            $data->tgl_sampai = $req->tgl_sampai;

            $data->save();
            $res = [
                'status' => 200,
                'message' => 'success add new data',
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
            $dataId = TruckSchedule::find($id);
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
                    'plat_no' => 'required|string|max:255',
                    'tgl_berangkat' => 'required|string|max:255',
                    'tgl_sampai' => 'required|string|max:255',
                ],
            );
            if ($validasi->fails()) {
                return response()->json($validasi->errors(), 422);
            }

            $data = TruckSchedule::find($id);
            if ($data == null) {
                return response()->json("data pada id=$id, tidak ada!", 404);
            }
            $data->plat_no = $req->plat_no;
            $data->tipe_truck = $req->tipe_truck;
            $data->tgl_berangkat = $req->tgl_berangkat;
            $data->tgl_sampai = $req->tgl_sampai;

            $data->save();
            $res = [
                'status' => 200,
                'message' => 'success update data schedule!',
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
            $dataId = TruckSchedule::find($id);
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
