@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.peminjamBuku.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.peminjam-bukus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_peminjam">{{ trans('cruds.peminjamBuku.fields.nama_peminjam') }}</label>
                <input class="form-control {{ $errors->has('nama_peminjam') ? 'is-invalid' : '' }}" type="text" name="nama_peminjam" id="nama_peminjam" value="{{ old('nama_peminjam', '') }}" required>
                @if($errors->has('nama_peminjam'))
                    <span class="text-danger">{{ $errors->first('nama_peminjam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.peminjamBuku.fields.nama_peminjam_helper') }}</span>
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