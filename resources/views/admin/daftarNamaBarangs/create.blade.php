@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.daftarNamaBarang.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.daftar-nama-barangs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_barang">{{ trans('cruds.daftarNamaBarang.fields.nama_barang') }}</label>
                <input class="form-control {{ $errors->has('nama_barang') ? 'is-invalid' : '' }}" type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', '') }}" required>
                @if($errors->has('nama_barang'))
                    <span class="text-danger">{{ $errors->first('nama_barang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarNamaBarang.fields.nama_barang_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="keterangan">{{ trans('cruds.daftarNamaBarang.fields.keterangan') }}</label>
                <textarea class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan">{{ old('keterangan') }}</textarea>
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarNamaBarang.fields.keterangan_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection