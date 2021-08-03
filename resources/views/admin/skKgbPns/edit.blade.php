@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.skKgbPn.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sk-kgb-pns.update", [$skKgbPn->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="no_surat">{{ trans('cruds.skKgbPn.fields.no_surat') }}</label>
                <input class="form-control {{ $errors->has('no_surat') ? 'is-invalid' : '' }}" type="text" name="no_surat" id="no_surat" value="{{ old('no_surat', $skKgbPn->no_surat) }}" required>
                @if($errors->has('no_surat'))
                    <span class="text-danger">{{ $errors->first('no_surat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skKgbPn.fields.no_surat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tgl_surat">{{ trans('cruds.skKgbPn.fields.tgl_surat') }}</label>
                <input class="form-control date {{ $errors->has('tgl_surat') ? 'is-invalid' : '' }}" type="text" name="tgl_surat" id="tgl_surat" value="{{ old('tgl_surat', $skKgbPn->tgl_surat) }}" required>
                @if($errors->has('tgl_surat'))
                    <span class="text-danger">{{ $errors->first('tgl_surat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skKgbPn.fields.tgl_surat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_ptk_id">{{ trans('cruds.skKgbPn.fields.nama_ptk') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_ptk') ? 'is-invalid' : '' }}" name="nama_ptk_id" id="nama_ptk_id" required>
                    @foreach($nama_ptks as $id => $entry)
                        <option value="{{ $id }}" {{ (old('nama_ptk_id') ? old('nama_ptk_id') : $skKgbPn->nama_ptk->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_ptk'))
                    <span class="text-danger">{{ $errors->first('nama_ptk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skKgbPn.fields.nama_ptk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tmt_kgb">{{ trans('cruds.skKgbPn.fields.tmt_kgb') }}</label>
                <input class="form-control date {{ $errors->has('tmt_kgb') ? 'is-invalid' : '' }}" type="text" name="tmt_kgb" id="tmt_kgb" value="{{ old('tmt_kgb', $skKgbPn->tmt_kgb) }}" required>
                @if($errors->has('tmt_kgb'))
                    <span class="text-danger">{{ $errors->first('tmt_kgb') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skKgbPn.fields.tmt_kgb_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="masa_kerja_golongan">{{ trans('cruds.skKgbPn.fields.masa_kerja_golongan') }}</label>
                <input class="form-control {{ $errors->has('masa_kerja_golongan') ? 'is-invalid' : '' }}" type="number" name="masa_kerja_golongan" id="masa_kerja_golongan" value="{{ old('masa_kerja_golongan', $skKgbPn->masa_kerja_golongan) }}" step="1" required>
                @if($errors->has('masa_kerja_golongan'))
                    <span class="text-danger">{{ $errors->first('masa_kerja_golongan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skKgbPn.fields.masa_kerja_golongan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="masa_kerja_bulan">{{ trans('cruds.skKgbPn.fields.masa_kerja_bulan') }}</label>
                <input class="form-control {{ $errors->has('masa_kerja_bulan') ? 'is-invalid' : '' }}" type="number" name="masa_kerja_bulan" id="masa_kerja_bulan" value="{{ old('masa_kerja_bulan', $skKgbPn->masa_kerja_bulan) }}" step="1" required>
                @if($errors->has('masa_kerja_bulan'))
                    <span class="text-danger">{{ $errors->first('masa_kerja_bulan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skKgbPn.fields.masa_kerja_bulan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="softfile">{{ trans('cruds.skKgbPn.fields.softfile') }}</label>
                <div class="needsclick dropzone {{ $errors->has('softfile') ? 'is-invalid' : '' }}" id="softfile-dropzone">
                </div>
                @if($errors->has('softfile'))
                    <span class="text-danger">{{ $errors->first('softfile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.skKgbPn.fields.softfile_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.softfileDropzone = {
    url: '{{ route('admin.sk-kgb-pns.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="softfile"]').remove()
      $('form').append('<input type="hidden" name="softfile" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="softfile"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($skKgbPn) && $skKgbPn->softfile)
      var file = {!! json_encode($skKgbPn->softfile) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="softfile" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection