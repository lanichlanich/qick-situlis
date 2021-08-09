@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.daftarRuangan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.daftar-ruangans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_ruangan">{{ trans('cruds.daftarRuangan.fields.nama_ruangan') }}</label>
                <input class="form-control {{ $errors->has('nama_ruangan') ? 'is-invalid' : '' }}" type="text" name="nama_ruangan" id="nama_ruangan" value="{{ old('nama_ruangan', '') }}" required>
                @if($errors->has('nama_ruangan'))
                    <span class="text-danger">{{ $errors->first('nama_ruangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarRuangan.fields.nama_ruangan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.daftarRuangan.fields.kondisi_ruangan') }}</label>
                @foreach(App\Models\DaftarRuangan::KONDISI_RUANGAN_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('kondisi_ruangan') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="kondisi_ruangan_{{ $key }}" name="kondisi_ruangan" value="{{ $key }}" {{ old('kondisi_ruangan', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="kondisi_ruangan_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('kondisi_ruangan'))
                    <span class="text-danger">{{ $errors->first('kondisi_ruangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.daftarRuangan.fields.kondisi_ruangan_helper') }}</span>
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