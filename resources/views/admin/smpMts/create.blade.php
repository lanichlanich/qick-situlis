@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.smpMt.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.smp-mts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="smp_mts">{{ trans('cruds.smpMt.fields.smp_mts') }}</label>
                <input class="form-control {{ $errors->has('smp_mts') ? 'is-invalid' : '' }}" type="text" name="smp_mts" id="smp_mts" value="{{ old('smp_mts', '') }}" required>
                @if($errors->has('smp_mts'))
                    <span class="text-danger">{{ $errors->first('smp_mts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.smpMt.fields.smp_mts_helper') }}</span>
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