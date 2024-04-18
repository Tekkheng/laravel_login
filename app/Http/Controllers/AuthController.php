<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::connection("mysql")->table('users')->select('id', 'nama', 'email','password')->get();
        return response()->json($data,200);
    }

    public function login(Request $req)
    {
        $user = Users::where('email', $req->email)->first();
        if ($user && Hash::check($req->password, $user->password)) {
            $token = $user->createToken('Personal Token')->plainTextToken;
            $res = [
                'success' => true,
                'status' => 200,
                'token' => $token,
                'message' => 'Login Sukses!',
                'data' => $user
            ];
            return response()->json($res);
        } elseif (!$user) {
            $res = [
                'success' => false,
                'status' => 400,
                'message' => 'Akun Tidak ditemukan!',
            ];
            return response()->json($res);
        } else {
            $res = [
                'success' => false,
                'status' => 500,
                'message' => 'Email atau password salah!',
            ];
            return response()->json($res);
        }
    }

    public function register(Request $req)
    {   
        try {
            $validasi = Validator::make(
                $req->all(),
                [
                    'nama' => 'required|string|max:255',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string|min:8',
                ],
            );
            // return $req;
            if ($validasi->fails()) {
                return response()->json($validasi->errors(), 422);
            }

            $data = new Users();
            $data->nama = $req->nama;
            $data->email = $req->email;
            $data->password = Hash::make($req->password);
            $data->save();

            $response = [
                'status' => 200,
                'message' => 'register success',
                'data' => $data,
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => 500, 'message' => $th];
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Users $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Users $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users $user)
    {
        //
    }
}
