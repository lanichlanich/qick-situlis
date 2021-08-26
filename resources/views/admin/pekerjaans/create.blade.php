@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pekerjaan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pekerjaans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="pekerjaan">{{ trans('cruds.pekerjaan.fields.pekerjaan') }}</label>
                <input class="form-control {{ $errors->has('pekerjaan') ? 'is-invalid' : '' }}" type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan', '') }}" required>
                @if($errors->has('pekerjaan'))
                    <span class="text-danger">{{ $errors->first('pekerjaan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pekerjaan.fields.pekerjaan_helper') }}</span>
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