<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Arsip;

class ArsipController extends Controller
{
    public function index()
    {
        // $surat = DB::table('surat')->get();
        $data = arsip::all();

        return view('arsip', compact('data'));
    }
    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table surat sesuai pencarian data
        $surat = DB::table('surat')
            ->where('judul', 'like', "%" . $cari . "%")
            ->paginate();

        // mengirim data pegawai ke view arsip
        return view('arsip', ['surat' => $surat]);
    }
    public function tambah()
    {
        return view('/tambah');
    }
    public function insert(Request $request)
    {
        $data = new Arsip();
    }
    public function hapus($judul)
    {
        // menghapus data surat berdasarkan nomor yang dipilih
        DB::table('surat')->where('judul', $judul)->delete();

        // alihkan halaman ke halaman arsip
        return redirect('/arsip');
    }
}
