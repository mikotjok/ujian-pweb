<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if (strlen($katakunci)) {
            $data = siswa::where('nis', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('kelas', 'like', "%$katakunci%")
                ->orWhere('judul_buku', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = siswa::orderBy('nis', 'desc')->paginate($jumlahbaris);
        }
        return view('siswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nis', $request->nis);
        Session::flash('nama', $request->nama);
        Session::flash('kelas', $request->kelas);
        Session::flash('judul_buku', $request->judul_buku);

        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama' => 'required',
            'kelas' => 'required',
            'judul_buku' => 'required'
        ], [
            'nis.required' => 'NIS Wajib Diisi !',
            'nis.numeric' => 'NIS Wajib Diisi Angka !',
            'nis.unique' => 'NIS Sudah Terdaftar dalam Database !',
            'nama.required' => 'Nama Wajib Diisi !',
            'kelas.required' => 'Kelas Wajib Diisi !',
            'judul_buku.required' => 'Judul Buku Wajib Diisi !'
        ]);
        $data = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'judul_buku' => $request->judul_buku,
        ];
        siswa::create($data);
        return redirect()->to('siswa')->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = siswa::where('nis', $id)->first();
        return view('siswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'judul_buku' => 'required'
        ], [
            'nama.required' => 'Nama wajib diisi',
            'kelas.required' => 'Kelas wajib diisi',
            'judul_buku.required' => 'Judul Buku wajib diisi'
        ]);
        $data = [
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'judul_buku' => $request->judul_buku
        ];
        siswa::where('nis', $id)->update($data);
        return redirect()->to('siswa')->with('success', 'Berhasil Update Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        siswa::where('nis', $id)->delete();
        return redirect()->to('siswa')->with('success', 'Berhasil Menghapus Data');
    }
}
