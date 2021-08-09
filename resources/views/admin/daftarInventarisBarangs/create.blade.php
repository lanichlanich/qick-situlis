@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.daftarInventarisBarang.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.daftar-inventaris-barangs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_barang_id">{{ trans('cruds.daftarInventarisBarang.fields.nama_barang') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_barang') ? 'is-invalid' : '' }}" name="nama_barang_id" id="nama_barang_id" required>
                    @foreach($nama_barangs as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_barang_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_barang'))
                    <span class="text-danger">{{ $errors->first('nama_barang') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarInventarisBarang.fields.nama_barang_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="jumlah">{{ trans('cruds.daftarInventarisBarang.fields.jumlah') }}</label>
                <input class="form-control {{ $errors->has('jumlah') ? 'is-invalid' : '' }}" type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', '') }}" step="1" required>
                @if($errors->has('jumlah'))
                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarInventarisBarang.fields.jumlah_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="daftar_ruangan_id">{{ trans('cruds.daftarInventarisBarang.fields.daftar_ruangan') }}</label>
                <select class="form-control select2 {{ $errors->has('daftar_ruangan') ? 'is-invalid' : '' }}" name="daftar_ruangan_id" id="daftar_ruangan_id" required>
                    @foreach($daftar_ruangans as $id => $entry)
                        <option value="{{ $id }}" {{ old('daftar_ruangan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('daftar_ruangan'))
                    <span class="text-danger">{{ $errors->first('daftar_ruangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarInventarisBarang.fields.daftar_ruangan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.daftarInventarisBarang.fields.status') }}</label>
                @foreach(App\Models\DaftarInventarisBarang::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarInventarisBarang.fields.status_helper') }}</span>
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