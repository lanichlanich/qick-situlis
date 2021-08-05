@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.peminjamanBuku.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.peminjaman-bukus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="peminjam_buku_id">{{ trans('cruds.peminjamanBuku.fields.peminjam_buku') }}</label>
                <select class="form-control select2 {{ $errors->has('peminjam_buku') ? 'is-invalid' : '' }}" name="peminjam_buku_id" id="peminjam_buku_id" required>
                    @foreach($peminjam_bukus as $id => $entry)
                        <option value="{{ $id }}" {{ old('peminjam_buku_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('peminjam_buku'))
                    <span class="text-danger">{{ $errors->first('peminjam_buku') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.peminjamanBuku.fields.peminjam_buku_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_buku_id">{{ trans('cruds.peminjamanBuku.fields.nama_buku') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_buku') ? 'is-invalid' : '' }}" name="nama_buku_id" id="nama_buku_id" required>
                    @foreach($nama_bukus as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_buku_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_buku'))
                    <span class="text-danger">{{ $errors->first('nama_buku') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.peminjamanBuku.fields.nama_buku_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tempat_penyimpanan_buku_id">{{ trans('cruds.peminjamanBuku.fields.tempat_penyimpanan_buku') }}</label>
                <select class="form-control select2 {{ $errors->has('tempat_penyimpanan_buku') ? 'is-invalid' : '' }}" name="tempat_penyimpanan_buku_id" id="tempat_penyimpanan_buku_id" required>
                    @foreach($tempat_penyimpanan_bukus as $id => $entry)
                        <option value="{{ $id }}" {{ old('tempat_penyimpanan_buku_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('tempat_penyimpanan_buku'))
                    <span class="text-danger">{{ $errors->first('tempat_penyimpanan_buku') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.peminjamanBuku.fields.tempat_penyimpanan_buku_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jumlah_pinjam">{{ trans('cruds.peminjamanBuku.fields.jumlah_pinjam') }}</label>
                <input class="form-control {{ $errors->has('jumlah_pinjam') ? 'is-invalid' : '' }}" type="number" name="jumlah_pinjam" id="jumlah_pinjam" value="{{ old('jumlah_pinjam', '') }}" step="1" required>
                @if($errors->has('jumlah_pinjam'))
                    <span class="text-danger">{{ $errors->first('jumlah_pinjam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.peminjamanBuku.fields.jumlah_pinjam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tanggal_pinjam">{{ trans('cruds.peminjamanBuku.fields.tanggal_pinjam') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_pinjam') ? 'is-invalid' : '' }}" type="text" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}" required>
                @if($errors->has('tanggal_pinjam'))
                    <span class="text-danger">{{ $errors->first('tanggal_pinjam') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.peminjamanBuku.fields.tanggal_pinjam_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tanggal_pengembalian">{{ trans('cruds.peminjamanBuku.fields.tanggal_pengembalian') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_pengembalian') ? 'is-invalid' : '' }}" type="text" name="tanggal_pengembalian" id="tanggal_pengembalian" value="{{ old('tanggal_pengembalian') }}" required>
                @if($errors->has('tanggal_pengembalian'))
                    <span class="text-danger">{{ $errors->first('tanggal_pengembalian') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.peminjamanBuku.fields.tanggal_pengembalian_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.peminjamanBuku.fields.status') }}</label>
                @foreach(App\Models\PeminjamanBuku::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.peminjamanBuku.fields.status_helper') }}</span>
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