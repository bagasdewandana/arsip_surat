<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;
use Illuminate\Support\Facades\DB;
use App\Models\Arsip;
use Illuminate\Validation\Rules\Unique;

class ArsipController extends Controller
{
    public function index()
    {
        $data = Arsip::all();

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
        $this->validate($request, [
            'nomor' => 'unique:surat',
            'file_surat' => 'mimes:pdf',
        ]);

        $dokumen = $request->file('file_surat');
        $nama_dokumen = time() . "_" . $dokumen->getClientOriginalName();
        $tujuan_upload = 'dokumen';
        $dokumen->move($tujuan_upload, $nama_dokumen);

        $data = new Arsip();
        $data->nomor = $request->nomor;
        $data->kategori = $request->kategori;
        $data->judul = $request->judul;
        $data->file_surat = $nama_dokumen;
        $data->save();
        return redirect('/arsip');
    }
    public function hapus($judul)
    {
        // menghapus data surat berdasarkan nomor yang dipilih
        DB::table('surat')->where('judul', $judul)->delete();

        // alihkan halaman ke halaman arsip
        return redirect('/arsip');
    }
    public function download(Request $request, $file_surat)
    {
        return response()->download(public_path('dokumen/' . $file_surat));
    }
}
