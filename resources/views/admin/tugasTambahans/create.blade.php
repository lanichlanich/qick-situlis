@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tugasTambahan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tugas-tambahans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="tugas_tambahan">{{ trans('cruds.tugasTambahan.fields.tugas_tambahan') }}</label>
                <input class="form-control {{ $errors->has('tugas_tambahan') ? 'is-invalid' : '' }}" type="text" name="tugas_tambahan" id="tugas_tambahan" value="{{ old('tugas_tambahan', '') }}" required>
                @if($errors->has('tugas_tambahan'))
                    <span class="text-danger">{{ $errors->first('tugas_tambahan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tugasTambahan.fields.tugas_tambahan_helper') }}</span>
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