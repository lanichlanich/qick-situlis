@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.arsipBpj.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.arsip-bpjs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_ptk_id">{{ trans('cruds.arsipBpj.fields.nama_ptk') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_ptk') ? 'is-invalid' : '' }}" name="nama_ptk_id" id="nama_ptk_id" required>
                    @foreach($nama_ptks as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_ptk_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_ptk'))
                    <span class="text-danger">{{ $errors->first('nama_ptk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.nama_ptk_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="no_bpjs_pegawai">{{ trans('cruds.arsipBpj.fields.no_bpjs_pegawai') }}</label>
                <input class="form-control {{ $errors->has('no_bpjs_pegawai') ? 'is-invalid' : '' }}" type="text" name="no_bpjs_pegawai" id="no_bpjs_pegawai" value="{{ old('no_bpjs_pegawai', '') }}" required>
                @if($errors->has('no_bpjs_pegawai'))
                    <span class="text-danger">{{ $errors->first('no_bpjs_pegawai') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.no_bpjs_pegawai_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kartu_bpjs_pegawai">{{ trans('cruds.arsipBpj.fields.kartu_bpjs_pegawai') }}</label>
                <div class="needsclick dropzone {{ $errors->has('kartu_bpjs_pegawai') ? 'is-invalid' : '' }}" id="kartu_bpjs_pegawai-dropzone">
                </div>
                @if($errors->has('kartu_bpjs_pegawai'))
                    <span class="text-danger">{{ $errors->first('kartu_bpjs_pegawai') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.kartu_bpjs_pegawai_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_bpjs_suami_istri">{{ trans('cruds.arsipBpj.fields.no_bpjs_suami_istri') }}</label>
                <input class="form-control {{ $errors->has('no_bpjs_suami_istri') ? 'is-invalid' : '' }}" type="text" name="no_bpjs_suami_istri" id="no_bpjs_suami_istri" value="{{ old('no_bpjs_suami_istri', '') }}">
                @if($errors->has('no_bpjs_suami_istri'))
                    <span class="text-danger">{{ $errors->first('no_bpjs_suami_istri') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.no_bpjs_suami_istri_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kartu_bpjs_suami_istri">{{ trans('cruds.arsipBpj.fields.kartu_bpjs_suami_istri') }}</label>
                <div class="needsclick dropzone {{ $errors->has('kartu_bpjs_suami_istri') ? 'is-invalid' : '' }}" id="kartu_bpjs_suami_istri-dropzone">
                </div>
                @if($errors->has('kartu_bpjs_suami_istri'))
                    <span class="text-danger">{{ $errors->first('kartu_bpjs_suami_istri') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.kartu_bpjs_suami_istri_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_bpjs_anak_1">{{ trans('cruds.arsipBpj.fields.no_bpjs_anak_1') }}</label>
                <input class="form-control {{ $errors->has('no_bpjs_anak_1') ? 'is-invalid' : '' }}" type="text" name="no_bpjs_anak_1" id="no_bpjs_anak_1" value="{{ old('no_bpjs_anak_1', '') }}">
                @if($errors->has('no_bpjs_anak_1'))
                    <span class="text-danger">{{ $errors->first('no_bpjs_anak_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.no_bpjs_anak_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kartu_anak_1">{{ trans('cruds.arsipBpj.fields.kartu_anak_1') }}</label>
                <div class="needsclick dropzone {{ $errors->has('kartu_anak_1') ? 'is-invalid' : '' }}" id="kartu_anak_1-dropzone">
                </div>
                @if($errors->has('kartu_anak_1'))
                    <span class="text-danger">{{ $errors->first('kartu_anak_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.kartu_anak_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_bpjs_anak_2">{{ trans('cruds.arsipBpj.fields.no_bpjs_anak_2') }}</label>
                <input class="form-control {{ $errors->has('no_bpjs_anak_2') ? 'is-invalid' : '' }}" type="text" name="no_bpjs_anak_2" id="no_bpjs_anak_2" value="{{ old('no_bpjs_anak_2', '') }}">
                @if($errors->has('no_bpjs_anak_2'))
                    <span class="text-danger">{{ $errors->first('no_bpjs_anak_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.no_bpjs_anak_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kartu_anak_2">{{ trans('cruds.arsipBpj.fields.kartu_anak_2') }}</label>
                <div class="needsclick dropzone {{ $errors->has('kartu_anak_2') ? 'is-invalid' : '' }}" id="kartu_anak_2-dropzone">
                </div>
                @if($errors->has('kartu_anak_2'))
                    <span class="text-danger">{{ $errors->first('kartu_anak_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.kartu_anak_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_bpjs_anak_3">{{ trans('cruds.arsipBpj.fields.no_bpjs_anak_3') }}</label>
                <input class="form-control {{ $errors->has('no_bpjs_anak_3') ? 'is-invalid' : '' }}" type="text" name="no_bpjs_anak_3" id="no_bpjs_anak_3" value="{{ old('no_bpjs_anak_3', '') }}">
                @if($errors->has('no_bpjs_anak_3'))
                    <span class="text-danger">{{ $errors->first('no_bpjs_anak_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.no_bpjs_anak_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kartu_anak_3">{{ trans('cruds.arsipBpj.fields.kartu_anak_3') }}</label>
                <div class="needsclick dropzone {{ $errors->has('kartu_anak_3') ? 'is-invalid' : '' }}" id="kartu_anak_3-dropzone">
                </div>
                @if($errors->has('kartu_anak_3'))
                    <span class="text-danger">{{ $errors->first('kartu_anak_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipBpj.fields.kartu_anak_3_helper') }}</span>
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
    Dropzone.options.kartuBpjsPegawaiDropzone = {
    url: '{{ route('admin.arsip-bpjs.storeMedia') }}',
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
      $('form').find('input[name="kartu_bpjs_pegawai"]').remove()
      $('form').append('<input type="hidden" name="kartu_bpjs_pegawai" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="kartu_bpjs_pegawai"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipBpj) && $arsipBpj->kartu_bpjs_pegawai)
      var file = {!! json_encode($arsipBpj->kartu_bpjs_pegawai) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="kartu_bpjs_pegawai" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.kartuBpjsSuamiIstriDropzone = {
    url: '{{ route('admin.arsip-bpjs.storeMedia') }}',
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
      $('form').find('input[name="kartu_bpjs_suami_istri"]').remove()
      $('form').append('<input type="hidden" name="kartu_bpjs_suami_istri" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="kartu_bpjs_suami_istri"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipBpj) && $arsipBpj->kartu_bpjs_suami_istri)
      var file = {!! json_encode($arsipBpj->kartu_bpjs_suami_istri) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="kartu_bpjs_suami_istri" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.kartuAnak1Dropzone = {
    url: '{{ route('admin.arsip-bpjs.storeMedia') }}',
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
      $('form').find('input[name="kartu_anak_1"]').remove()
      $('form').append('<input type="hidden" name="kartu_anak_1" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="kartu_anak_1"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipBpj) && $arsipBpj->kartu_anak_1)
      var file = {!! json_encode($arsipBpj->kartu_anak_1) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="kartu_anak_1" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.kartuAnak2Dropzone = {
    url: '{{ route('admin.arsip-bpjs.storeMedia') }}',
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
      $('form').find('input[name="kartu_anak_2"]').remove()
      $('form').append('<input type="hidden" name="kartu_anak_2" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="kartu_anak_2"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipBpj) && $arsipBpj->kartu_anak_2)
      var file = {!! json_encode($arsipBpj->kartu_anak_2) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="kartu_anak_2" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.kartuAnak3Dropzone = {
    url: '{{ route('admin.arsip-bpjs.storeMedia') }}',
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
      $('form').find('input[name="kartu_anak_3"]').remove()
      $('form').append('<input type="hidden" name="kartu_anak_3" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="kartu_anak_3"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipBpj) && $arsipBpj->kartu_anak_3)
      var file = {!! json_encode($arsipBpj->kartu_anak_3) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="kartu_anak_3" value="' + file.file_name + '">')
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