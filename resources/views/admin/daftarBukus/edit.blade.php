@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.daftarBuku.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.daftar-bukus.update", [$daftarBuku->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_buku">{{ trans('cruds.daftarBuku.fields.nama_buku') }}</label>
                <input class="form-control {{ $errors->has('nama_buku') ? 'is-invalid' : '' }}" type="text" name="nama_buku" id="nama_buku" value="{{ old('nama_buku', $daftarBuku->nama_buku) }}" required>
                @if($errors->has('nama_buku'))
                    <span class="text-danger">{{ $errors->first('nama_buku') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarBuku.fields.nama_buku_helper') }}</span>
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