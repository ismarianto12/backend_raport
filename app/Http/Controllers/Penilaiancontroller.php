<?php

namespace App\Http\Controllers;

use App\Http\Traits\Oaweb;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class Penilaiancontroller extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function all()
    {
        try {
            $data = Penilaian::get();
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

            $data = Penilaian::where('id', $id)->get();
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
            $Penilaian = new Penilaian;
            $Penilaian->nama =  $this->request->nama;
            $Penilaian->nisn =  $this->request->nisn;
            $Penilaian->jk =  $this->request->jk;
            $Penilaian->alamat =  $this->request->alamat;
            $Penilaian->ttl =  $this->request->ttl;
            $Penilaian->kelas =  $this->request->kelas;
            $Penilaian->tahun_masuk =  $this->request->tahun_masuk;
            $Penilaian->nama_ibu =  $this->request->nama_ibu;
            $Penilaian->nama_ayah =  $this->request->nama_ayah;
            $Penilaian->save();
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
            $Penilaian = Penilaian::find($id);
            $Penilaian->nama =  $this->request->nama;
            $Penilaian->nisn =  $this->request->nisn;
            $Penilaian->jk =  $this->request->jk;
            $Penilaian->alamat =  $this->request->alamat;
            $Penilaian->ttl =  $this->request->ttl;
            $Penilaian->kelas =  $this->request->kelas;
            $Penilaian->tahun_masuk =  $this->request->tahun_masuk;
            $Penilaian->nama_ibu =  $this->request->nama_ibu;
            $Penilaian->nama_ayah =  $this->request->nama_ayah;
            $Penilaian->save();
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
            $Penilaian = Penilaian::find($id);
            $Penilaian->delete();
            return response()->json([
                'status' => 'ok',
                'msg' => 'data berhasil di hapus'
            ]);
        } catch (\Throwable $th) {
        }
    }


    //
}
