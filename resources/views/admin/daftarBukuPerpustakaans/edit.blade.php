@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.daftarBukuPerpustakaan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.daftar-buku-perpustakaans.update", [$daftarBukuPerpustakaan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nama_buku_id">{{ trans('cruds.daftarBukuPerpustakaan.fields.nama_buku') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_buku') ? 'is-invalid' : '' }}" name="nama_buku_id" id="nama_buku_id" required>
                    @foreach($nama_bukus as $id => $entry)
                        <option value="{{ $id }}" {{ (old('nama_buku_id') ? old('nama_buku_id') : $daftarBukuPerpustakaan->nama_buku->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_buku'))
                    <span class="text-danger">{{ $errors->first('nama_buku') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarBukuPerpustakaan.fields.nama_buku_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jumlah">{{ trans('cruds.daftarBukuPerpustakaan.fields.jumlah') }}</label>
                <input class="form-control {{ $errors->has('jumlah') ? 'is-invalid' : '' }}" type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $daftarBukuPerpustakaan->jumlah) }}" step="1" required>
                @if($errors->has('jumlah'))
                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarBukuPerpustakaan.fields.jumlah_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tempat_penyimpanan_id">{{ trans('cruds.daftarBukuPerpustakaan.fields.tempat_penyimpanan') }}</label>
                <select class="form-control select2 {{ $errors->has('tempat_penyimpanan') ? 'is-invalid' : '' }}" name="tempat_penyimpanan_id" id="tempat_penyimpanan_id" required>
                    @foreach($tempat_penyimpanans as $id => $entry)
                        <option value="{{ $id }}" {{ (old('tempat_penyimpanan_id') ? old('tempat_penyimpanan_id') : $daftarBukuPerpustakaan->tempat_penyimpanan->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tempat_penyimpanan'))
                    <span class="text-danger">{{ $errors->first('tempat_penyimpanan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarBukuPerpustakaan.fields.tempat_penyimpanan_helper') }}</span>
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