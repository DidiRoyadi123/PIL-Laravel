@extends('layouts.app')
@section ('title','Friends')

@section ('content')

<form action="/friends" method="POST">
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nama</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="nama" aria-describedby="emailHelp" value="{{old('nama')}} ">
        @error('nama')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nomor Telpon</label>
        <input type="text" class="form-control" name="no_tlp" id="exampleInputPassword1" value="{{old('no_tlp')}} ">
        @error('Nomor Telpon')
        <div class=" alert alert-danger">{{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Alamat</label>
        <input type="text" class="form-control" name="alamat" id="exampleInputPassword1" value="{{old('alamat')}} ">
        @error('Alamat')
        <div class=" alert alert-danger">{{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<br>
<div class="d-grid gap-2 d-md-block">
    <button class="btn btn-warning" type="button"> <a href="/friends" style="text-decoration:none " class="link-light">Kembali</a></button>
</div>

@endsection