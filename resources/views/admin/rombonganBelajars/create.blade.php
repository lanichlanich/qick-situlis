@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.rombonganBelajar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.rombongan-belajars.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_rombel">{{ trans('cruds.rombonganBelajar.fields.nama_rombel') }}</label>
                <input class="form-control {{ $errors->has('nama_rombel') ? 'is-invalid' : '' }}" type="text" name="nama_rombel" id="nama_rombel" value="{{ old('nama_rombel', '') }}" required>
                @if($errors->has('nama_rombel'))
                    <span class="text-danger">{{ $errors->first('nama_rombel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rombonganBelajar.fields.nama_rombel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.rombonganBelajar.fields.jurusan') }}</label>
                @foreach(App\Models\RombonganBelajar::JURUSAN_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('jurusan') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="jurusan_{{ $key }}" name="jurusan" value="{{ $key }}" {{ old('jurusan', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="jurusan_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('jurusan'))
                    <span class="text-danger">{{ $errors->first('jurusan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rombonganBelajar.fields.jurusan_helper') }}</span>
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