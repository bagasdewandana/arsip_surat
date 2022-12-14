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
        if ($request) {
            $data = Arsip::where('judul', 'like', '%' . $request->cari . '%')->get();
        } else {
            $data = Arsip::all();
        }
        return view('arsip', compact('data'));
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
        $data = Arsip::where('judul', $judul)->first();
        unlink('dokumen/' . $data->file_surat);
        // menghapus data surat berdasarkan judul yang dipilih
        DB::table('surat')->where('judul', $judul)->delete();

        // alihkan halaman ke halaman arsip
        return redirect('/arsip');
    }
    public function download(Request $request, $file_surat)
    {
        return response()->download(public_path('dokumen/' . $file_surat));
    }
    public function lihat($judul)
    {
        $data = Arsip::where('judul', $judul)->first();
        return view('lihatsurat', compact('data'));
    }
    public function edit($judul)
    {
        $data = Arsip::where('judul', $judul)->first();
        return view('edit', compact('data'));
    }
    public function update(Request $request, $judul)
    {
        $this->validate($request, [
            'nomor' => 'unique:surat',
            'file_surat' => 'mimes:pdf',
        ]);

        $dokumen = $request->file('file_surat');
        $nama_dokumen = time() . "_" . $dokumen->getClientOriginalName();
        $tujuan_upload = 'dokumen';
        $dokumen->move($tujuan_upload, $nama_dokumen);

        $data = Arsip::where('judul', $judul)->first();
        unlink('dokumen/' . $data->file_surat);
        $data->nomor = $request->nomor;
        $data->kategori = $request->kategori;
        $data->judul = $request->judul;
        $data->file_surat = $nama_dokumen;
        $data->save();
        return Redirect('/arsip');
    }
}
