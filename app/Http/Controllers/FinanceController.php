<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index_finance(){
        $data = DB::table('finance')->get();
        $total = DB::table('finance')->where('Jenis_Transaksi', 'Keluar')->sum('Jumlah');
        // return $total;
        return view('finance', compact('data', 'total'));
    }

    public function store_finance(Request $req){
        DB::table('finance')->insert([
            'Jenis_Transaksi' => $req->Jenis_Transaksi,
            'Tanggal_Transaksi' => now()->format('Y-m-d'),
            'Jumlah' => $req->Jumlah,
            'Keterangan' => $req->Keterangan,
        ]);
        return redirect()->back()->with('pesan', 'Data Transaksi Berhasil Ditambahkan');
    }

    public function buku(){
        $data = DB::table('buku')->get();

        return view('buku', compact('data'));
    }

    public function store_buku(Request $req){

        $req->validate([
            'cover' => 'required|image|mimes:jpeg,png,jpg',
            'file' => 'required|mimes:pdf',
        ]);
        
        // return 'a';
        $coverName = time() . '_cover.' . $req->cover->extension();
        $fileTitle = time() . '_file.' . $req->file->extension();
    
        $coverPath = $req->file('cover')->storeAs('public/covers', $coverName);
        $filePath = $req->file('file')->storeAs('public/files', $fileTitle);
    
        DB::table('buku')->insert([
            'kategori' => $req->kategori,
            'judul_buku' => $req->judul_buku,
            'cover' => $coverName,
            'user_id' => Auth::user()->id,
            'file' => $fileTitle
        ]);

        return redirect()->back()->with('pesan', 'Data Berhasil Disimpan');
    }
    public function detail_buku($id){
        $item = DB::table('buku')->where('id', $id)->first();

    // Periksa apakah item ditemukan
    if (!$item) {
        return abort(404); // Tampilkan halaman 404 jika item tidak ditemukan
    }

    // Kirimkan data item ke tampilan detail
    return view('detail_buku', compact('item'));
    }

    public function hapusData(Request $req)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Hapus data dari tabel 'krs' berdasarkan NPM
            DB::table('buku')->where('user_id', $req->id)->delete();

            // Hapus data dari tabel 'bimbingankrs' yang sesuai berdasarkan NPM
            DB::table('kategori')->where('user_id', $req->id)->delete();

            // Commit transaksi
            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
