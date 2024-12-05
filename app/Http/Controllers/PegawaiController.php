<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
// use Yajra\DataTables\DataTables; 
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function index(){
        // $pegawai = Pegawai::orderBy('nama')->get();

        //lalu dicompact diview
        return view('pegawai.index');
    }
    public function data(){
        // mengambil data
        $pegawai=Pegawai::orderBy('nama', 'desc')->get();
        // $pegawai = Pegawai::all();
        
        return datatables()
        ->of($pegawai)
        ->addIndexColumn()
        // ->DT_RowIndex()
            ->addColumn('aksi', function ($pegawai) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('pegawai.update', $pegawai->id) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pen"></i></button>
                    <button onclick="deleteData(`'. route('pegawai.destroy', $pegawai->id) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>';
            })
             //menampilkan kolom aksi
            ->rawColumns(['aksi'])
        ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'unique:pegawai,email', // Validasi untuk memastikan email unik
                function ($attribute, $value, $fail) {
                    if (!in_array(substr(strrchr($value, "@"), 1), ['gmail.com', 'yahoo.com'])) {
                        $fail($attribute.' harus menggunakan domain seperti @gmail.com atau @yahoo.com');
                    }
                }
            ],
            'nama' => 'required',
            'jabatan' => 'required',
            'tanggalmasuk' => 'required|date',
        ]);
        //menambah data
        $pegawai = new Pegawai();
        $pegawai->nama=$request->nama;
        $pegawai->email=$request->email;
        $pegawai->jabatan=$request->jabatan;
        $pegawai->tanggalmasuk = $request->tanggalmasuk;

        $pegawai->save();

        // return response()->json('Data berhasil disimpan', 200);
        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    public function show($id)
    {
        //menampilkan data
        // Menampilkan data berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);
        return response()->json($pegawai);
    }

    public function update(Request $request, $id)
    {
         $request->validate([
        'email' => [
            'required',
            'email',
            'unique:pegawai,email,' . $id, // Mengecualikan ID pegawai yang sedang diperbarui
            function ($attribute, $value, $fail) {
                if (!in_array(substr(strrchr($value, "@"), 1), ['gmail.com', 'yahoo.com'])) {
                    $fail($attribute.' harus menggunakan domain seperti @gmail.com atau @yahoo.com');
                }
            }
        ],
        'nama' => 'required',
        'jabatan' => 'required',
        'tanggalmasuk' => 'required|date',
    ]);
        //mengupadte data
        $pegawai = Pegawai::find($id);
        $pegawai->nama=$request->nama;
        $pegawai->email=$request->email;
        $pegawai->jabatan=$request->jabatan;
        $pegawai->tanggalmasuk = $request->tanggalmasuk;

        $pegawai->update();

        
        // return response()->json('Data berhasil disimpan', 200);
        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
    public function destroy($id)
    {
        //menghapus data
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return response(null, 204);
    }
}
