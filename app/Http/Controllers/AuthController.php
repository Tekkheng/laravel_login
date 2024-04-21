<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::connection("mysql")->table('users')->select('id', 'nama', 'email', 'password')->get();
        return response()->json($data, 200);
    }

    public function login(Request $req)
    {
        $user = Users::where('email', $req->email)->first();

        if ($user && Hash::check($req->password, $user->password)) {
            // JWTAuth
            $token = JWTAuth::attempt([
                "email" => $req->email,
                "password" => $req->password
            ]);

            if (!empty($token)) {
                $res = [
                    'success' => true,
                    'status' => 200,
                    'token' => $token,
                    'message' => 'User logged in succcessfully',
                    'data' => $user
                ];
                return response()->json($res);
            }
            return response()->json([
                "status" => false,
                "message" => "Invalid details"
            ]);
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
                    'password' => 'required|confirmed',
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
                'message' => 'User registered successfully',
                'data' => $data,
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ['status' => 500, 'message' => $th->getMessage()];
            return response()->json($response, 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function profile()
    {
        $userdata = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $userdata
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function refreshToken()
    {
        $newToken = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "New access token",
            "token" => $newToken
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "User logged out successfully"
        ]);
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
