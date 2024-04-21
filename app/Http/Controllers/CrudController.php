<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
    public function index()
    {
        // $con = DB::connection('mysql')->table('master_truck')->get();
        $conn = Truck::get();
        return response($conn, 200);
    }

    public function create(Request $req)
    {
        try {
            $validasi = Validator::make(
                $req->all(),
                [
                    'plat_no' => 'required|string|max:255',
                    'tipe_truck' => 'required|exists:master_tipe_truck,no',
                ],
            );
            // if ($validasi->fails()) {
            //     return response()->json($validasi->errors(), 422);
            // }
            if ($validasi->fails()) {
                return response()->json('field Plat No dan tipe truck harus di isi dengan benar!', 422);
            }

            $data = new Truck();
            $data->plat_no = $req->plat_no;
            $data->tipe_truck = $req->tipe_truck;
            $data->save();

            $response = [
                'status' => 200,
                'message' => 'success add new data',
                'data' => $data,
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($response, 500);
        }
    }

    public function show($id)
    {
        try {
            // $conn = DB::connection('mysql')->table('master_truck')->find($id);
            $conn = Truck::find($id);
            if ($conn == NULL) {
                return response()->json("data pada id=$id, tidak ada!", 404);
            } else {
                return response()->json($conn, 200);
            }
        } catch (\Throwable $th) {
            $res = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($res, 500);
        }
    }
    
    public function update(Request $req, $id)
    {
        try {
            $validasi = Validator::make(
                $req->all(),
                [
                    'plat_no' => 'required|string|max:255',
                    'tipe_truck' => 'required|exists:master_tipe_truck,no',
                ],
            );
            if ($validasi->fails()) {
                return response()->json('field Plat No dan tipe truck harus di isi dengan benar!', 422);
            }
            // return $req;
            $data = Truck::find($id);
            if ($data == null) {
                return response()->json("data pada id=$id tidak ada!", 404);
            }

            $timestamp = Carbon::now()->toDateTimeString();
            $data->plat_no = $req->plat_no;
            $data->tipe_truck = $req->tipe_truck;
            $data['updated_at'] = $timestamp;
            $data->save();
            $response = [
                'status' => 200,
                'message' => 'success update data',
                'data' => $data,
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            $res = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($res, 500);
        }
    }

    public function destroy($id)
    {
        try {
            $conn = Truck::find($id);
            if ($conn == null) {
                return response()->json("data pada id=$id, tidak ada!", 404);
            } else {
                $conn->delete();
                return response()->json("data pada id=$id, berhasil di hapus!", 200);
            }
        } catch (\Throwable $th) {
            $res = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($res, 500);
        }
    }
}
