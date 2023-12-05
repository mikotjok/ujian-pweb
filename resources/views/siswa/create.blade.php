@extends('layout.template')
@section('konten')

<!-- START FORM -->
<form action='{{url('siswa')}}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href="{{url('siswa')}}" class="btn btn-secondary"><< Kembali</a>
        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">NIS</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='nis' value="{{Session::get('nis')}}" id="nis">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{Session::get('nama')}}" id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='kelas' value="{{Session::get('kelas')}}" id="kelas">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="judul_buku" class="col-sm-2 col-form-label">Judul Buku</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='judul_buku' value="{{Session::get('judul_buku')}}" id="judul_buku">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="judul_buku" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
<!-- AKHIR FORM -->
@endsection