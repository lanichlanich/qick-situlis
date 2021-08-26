@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pangkatGolongan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pangkat-golongans.update", [$pangkatGolongan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="pangkat">{{ trans('cruds.pangkatGolongan.fields.pangkat') }}</label>
                <input class="form-control {{ $errors->has('pangkat') ? 'is-invalid' : '' }}" type="text" name="pangkat" id="pangkat" value="{{ old('pangkat', $pangkatGolongan->pangkat) }}" required>
                @if($errors->has('pangkat'))
                    <span class="text-danger">{{ $errors->first('pangkat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pangkatGolongan.fields.pangkat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="golongan">{{ trans('cruds.pangkatGolongan.fields.golongan') }}</label>
                <input class="form-control {{ $errors->has('golongan') ? 'is-invalid' : '' }}" type="text" name="golongan" id="golongan" value="{{ old('golongan', $pangkatGolongan->golongan) }}" required>
                @if($errors->has('golongan'))
                    <span class="text-danger">{{ $errors->first('golongan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.pangkatGolongan.fields.golongan_helper') }}</span>
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