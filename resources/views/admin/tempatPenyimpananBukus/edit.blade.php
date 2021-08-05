@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tempatPenyimpananBuku.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tempat-penyimpanan-bukus.update", [$tempatPenyimpananBuku->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_tempat_penyimpaanan">{{ trans('cruds.tempatPenyimpananBuku.fields.nama_tempat_penyimpaanan') }}</label>
                <input class="form-control {{ $errors->has('nama_tempat_penyimpaanan') ? 'is-invalid' : '' }}" type="text" name="nama_tempat_penyimpaanan" id="nama_tempat_penyimpaanan" value="{{ old('nama_tempat_penyimpaanan', $tempatPenyimpananBuku->nama_tempat_penyimpaanan) }}" required>
                @if($errors->has('nama_tempat_penyimpaanan'))
                    <span class="text-danger">{{ $errors->first('nama_tempat_penyimpaanan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tempatPenyimpananBuku.fields.nama_tempat_penyimpaanan_helper') }}</span>
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