<?php

namespace App\Http\Controllers;

use App\Http\Traits\Oaweb;
use App\Models\OpeningNew;
use App\Models\Pegawai;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class Raportcontroller extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        try {
            $data = Pegawai::get();
            return response()->json($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show($id)
    {

            $data = Penilaian::select('*')
                ->join('mapel', 'mapel.id', '=', 'penilaian.id_mapel', 'left')
                ->join('siswa', 'siswa.id', '=', 'penilaian.id_siswa', 'left')
                ->where('penilaian.id_siswa', $id)->get();

            // if ($data->count() > 0) {
                return response()->json([
                    'data' => $data,
                ]);
            // } else {
            //     return abort(404);
            // }

    }



    public function save()
    {

        try {
            $data = new Penilaian;
            $data->id_siswa = $this->request->id_siswa;
            $data->id_mapel = $this->request->mapel;
            $data->nilai = $this->request->nilai;
            $data->bobot = $this->request->bobot;
            $data->semester = $this->request->semester;
            $data->nilai_tugas = $this->request->nilai_tugas;
            $data->nilai_presensi = $this->request->nilai_presensi;

            $data->save();
            return response()->json([
                'nama' => $data->id_siswa,
                'msg' => 'data berhasil di simpan'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update($id)
    {
        try {
            $Pegawai = Pegawai::find($id);
            $Pegawai->nama =  $this->request->nama;
            $Pegawai->nisn =  $this->request->nisn;
            $Pegawai->jk =  $this->request->jk;
            $Pegawai->alamat =  $this->request->alamat;
            $Pegawai->ttl =  $this->request->ttl;
            $Pegawai->kelas =  $this->request->kelas;
            $Pegawai->tahun_masuk =  $this->request->tahun_masuk;
            $Pegawai->nama_ibu =  $this->request->nama_ibu;
            $Pegawai->nama_ayah =  $this->request->nama_ayah;
            $Pegawai->save();
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
            $Pegawai = Pegawai::find($id);
            $Pegawai->delete();
            return response()->json([
                'status' => 'ok',
                'msg' => 'data berhasil di hapus'
            ]);
        } catch (\Throwable $th) {
        }
    }


    //
}
