@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.suratMasuk.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.surat-masuks.update", [$suratMasuk->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="no_surat">{{ trans('cruds.suratMasuk.fields.no_surat') }}</label>
                <input class="form-control {{ $errors->has('no_surat') ? 'is-invalid' : '' }}" type="text" name="no_surat" id="no_surat" value="{{ old('no_surat', $suratMasuk->no_surat) }}" required>
                @if($errors->has('no_surat'))
                    <span class="text-danger">{{ $errors->first('no_surat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suratMasuk.fields.no_surat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tgl_surat">{{ trans('cruds.suratMasuk.fields.tgl_surat') }}</label>
                <input class="form-control date {{ $errors->has('tgl_surat') ? 'is-invalid' : '' }}" type="text" name="tgl_surat" id="tgl_surat" value="{{ old('tgl_surat', $suratMasuk->tgl_surat) }}" required>
                @if($errors->has('tgl_surat'))
                    <span class="text-danger">{{ $errors->first('tgl_surat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suratMasuk.fields.tgl_surat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="keterangan">{{ trans('cruds.suratMasuk.fields.keterangan') }}</label>
                <input class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}" type="text" name="keterangan" id="keterangan" value="{{ old('keterangan', $suratMasuk->keterangan) }}" required>
                @if($errors->has('keterangan'))
                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suratMasuk.fields.keterangan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pengirim">{{ trans('cruds.suratMasuk.fields.pengirim') }}</label>
                <input class="form-control {{ $errors->has('pengirim') ? 'is-invalid' : '' }}" type="text" name="pengirim" id="pengirim" value="{{ old('pengirim', $suratMasuk->pengirim) }}" required>
                @if($errors->has('pengirim'))
                    <span class="text-danger">{{ $errors->first('pengirim') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suratMasuk.fields.pengirim_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="softfile">{{ trans('cruds.suratMasuk.fields.softfile') }}</label>
                <div class="needsclick dropzone {{ $errors->has('softfile') ? 'is-invalid' : '' }}" id="softfile-dropzone">
                </div>
                @if($errors->has('softfile'))
                    <span class="text-danger">{{ $errors->first('softfile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.suratMasuk.fields.softfile_helper') }}</span>
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
    url: '{{ route('admin.surat-masuks.storeMedia') }}',
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
@if(isset($suratMasuk) && $suratMasuk->softfile)
      var file = {!! json_encode($suratMasuk->softfile) !!}
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