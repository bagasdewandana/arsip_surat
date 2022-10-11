<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipController extends Controller
{
    public function index()
    {
        $surat = DB::table('surat')->get();

        return view('arsip', ['surat' => $surat]);
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
}
