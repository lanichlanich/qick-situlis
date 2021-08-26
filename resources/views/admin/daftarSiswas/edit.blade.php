@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.daftarSiswa.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.daftar-siswas.update", [$daftarSiswa->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="no_induk">{{ trans('cruds.daftarSiswa.fields.no_induk') }}</label>
                <input class="form-control {{ $errors->has('no_induk') ? 'is-invalid' : '' }}" type="text" name="no_induk" id="no_induk" value="{{ old('no_induk', $daftarSiswa->no_induk) }}" required>
                @if($errors->has('no_induk'))
                    <span class="text-danger">{{ $errors->first('no_induk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarSiswa.fields.no_induk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_siswa">{{ trans('cruds.daftarSiswa.fields.nama_siswa') }}</label>
                <input class="form-control {{ $errors->has('nama_siswa') ? 'is-invalid' : '' }}" type="text" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa', $daftarSiswa->nama_siswa) }}" required>
                @if($errors->has('nama_siswa'))
                    <span class="text-danger">{{ $errors->first('nama_siswa') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarSiswa.fields.nama_siswa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nisn">{{ trans('cruds.daftarSiswa.fields.nisn') }}</label>
                <input class="form-control {{ $errors->has('nisn') ? 'is-invalid' : '' }}" type="text" name="nisn" id="nisn" value="{{ old('nisn', $daftarSiswa->nisn) }}" required>
                @if($errors->has('nisn'))
                    <span class="text-danger">{{ $errors->first('nisn') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarSiswa.fields.nisn_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tgl_masuk">{{ trans('cruds.daftarSiswa.fields.tgl_masuk') }}</label>
                <input class="form-control date {{ $errors->has('tgl_masuk') ? 'is-invalid' : '' }}" type="text" name="tgl_masuk" id="tgl_masuk" value="{{ old('tgl_masuk', $daftarSiswa->tgl_masuk) }}" required>
                @if($errors->has('tgl_masuk'))
                    <span class="text-danger">{{ $errors->first('tgl_masuk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarSiswa.fields.tgl_masuk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="asal_sekolah_id">{{ trans('cruds.daftarSiswa.fields.asal_sekolah') }}</label>
                <select class="form-control select2 {{ $errors->has('asal_sekolah') ? 'is-invalid' : '' }}" name="asal_sekolah_id" id="asal_sekolah_id" required>
                    @foreach($asal_sekolahs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('asal_sekolah_id') ? old('asal_sekolah_id') : $daftarSiswa->asal_sekolah->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('asal_sekolah'))
                    <span class="text-danger">{{ $errors->first('asal_sekolah') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarSiswa.fields.asal_sekolah_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.daftarSiswa.fields.status') }}</label>
                @foreach(App\Models\DaftarSiswa::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $daftarSiswa->status) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarSiswa.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tgl_keluar">{{ trans('cruds.daftarSiswa.fields.tgl_keluar') }}</label>
                <input class="form-control date {{ $errors->has('tgl_keluar') ? 'is-invalid' : '' }}" type="text" name="tgl_keluar" id="tgl_keluar" value="{{ old('tgl_keluar', $daftarSiswa->tgl_keluar) }}">
                @if($errors->has('tgl_keluar'))
                    <span class="text-danger">{{ $errors->first('tgl_keluar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarSiswa.fields.tgl_keluar_helper') }}</span>
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