<?php

namespace App\Http\Controllers;

use App\Models\DeliverySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class DeliveryController extends Controller
{
    public function index()
    {
        $data = DeliverySchedule::get();
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
                    'no_delivery' => 'required|string|unique:delivery_schedules',
                    'plat_no' => 'required|integer|max:255',
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
            $data = new DeliverySchedule();
            $data->no_delivery = $req->no_delivery;
            $data->plat_no = $req->plat_no;
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
            $dataId = DeliverySchedule::find($id);
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
                    'no_delivery' => 'required|string|unique:delivery_schedules',
                    'plat_no' => 'required|integer|max:255',
                    'tgl_berangkat' => 'required|string|max:255',
                    'tgl_sampai' => 'required|string|max:255',
                ],
            );
            if ($validasi->fails()) {
                return response()->json($validasi->errors(), 422);
            }

            $data = DeliverySchedule::find($id);
            if ($data == null) {
                return response()->json("data pada id=$id, tidak ada!", 404);
            }
            $data->no_delivery = $req->no_delivery;
            $data->plat_no = $req->plat_no;
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
            $dataId = DeliverySchedule::find($id);
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




