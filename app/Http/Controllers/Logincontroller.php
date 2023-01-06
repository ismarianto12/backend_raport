<?php

namespace App\Http\Controllers;

use App\Http\Traits\Oaweb;
use App\Models\OpeningNew;
use App\Models\Login;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;

class Logincontroller extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function accesslogin()
    {
        $username = $this->request->username;
        $password = $this->request->password;
        $data = Login::where([
            'username' => $username,
            'password' => $password
        ])->get();

        if ($data->count() > 0) {
            $Resp = [
                'username' => $data->first()->username,
                'nama' => $data->first()->nama,
                'token' => app('hash')->make($password),
                'level' => $data->first()->level
            ];
            return response()->json($Resp);
        } else {
            return response()->json([
                'status' => 'failed',
                'messages' => 'username dan password salah',
                'token' => $password,
                'data' => $data,
            ], 400);
        }
    }
    public function all()
    {
        try {
            $data = Login::get();
            return response()->json([
                'status' => 'ok',
                'messages' => '',
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {
        try {

            $data = Login::where('id', $id)->get();
            if ($data->count() > 0) {
                return response()->json([
                    'data' => $data,
                ]);
            } else {
                return abort(404);
            }
        } catch (\Throwable $th) {
        }
    }



    public function store()
    {

        try {
            $Login = new Login;
            $Login->nama =  $this->request->nama;
            $Login->nisn =  $this->request->nisn;
            $Login->jk =  $this->request->jk;
            $Login->alamat =  $this->request->alamat;
            $Login->ttl =  $this->request->ttl;
            $Login->kelas =  $this->request->kelas;
            $Login->tahun_masuk =  $this->request->tahun_masuk;
            $Login->nama_ibu =  $this->request->nama_ibu;
            $Login->nama_ayah =  $this->request->nama_ayah;
            $Login->save();
            return response()->json([
                'status' => 'ok',
                'msg' => 'data berhasil di simpan'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update($id)
    {
        try {
            $Login = Login::find($id);
            $Login->nama =  $this->request->nama;
            $Login->nisn =  $this->request->nisn;
            $Login->jk =  $this->request->jk;
            $Login->alamat =  $this->request->alamat;
            $Login->ttl =  $this->request->ttl;
            $Login->kelas =  $this->request->kelas;
            $Login->tahun_masuk =  $this->request->tahun_masuk;
            $Login->nama_ibu =  $this->request->nama_ibu;
            $Login->nama_ayah =  $this->request->nama_ayah;
            $Login->save();
            return response()->json([
                'status' => 'ok',
                'msg' => 'data berhasil di simpan'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function delete($id)
    {
        try {
            $Login = Login::find($id);
            $Login->delete();
            return response()->json([
                'status' => 'ok',
                'msg' => 'data berhasil di hapus'
            ]);
        } catch (\Throwable $th) {
        }
    }


    //
}
