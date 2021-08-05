@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.arsipPnsLainnya.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.arsip-pns-lainnyas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nama_ptk_id">{{ trans('cruds.arsipPnsLainnya.fields.nama_ptk') }}</label>
                <select class="form-control select2 {{ $errors->has('nama_ptk') ? 'is-invalid' : '' }}" name="nama_ptk_id" id="nama_ptk_id" required>
                    @foreach($nama_ptks as $id => $entry)
                        <option value="{{ $id }}" {{ old('nama_ptk_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('nama_ptk'))
                    <span class="text-danger">{{ $errors->first('nama_ptk') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipPnsLainnya.fields.nama_ptk_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_karpeg">{{ trans('cruds.arsipPnsLainnya.fields.no_karpeg') }}</label>
                <input class="form-control {{ $errors->has('no_karpeg') ? 'is-invalid' : '' }}" type="text" name="no_karpeg" id="no_karpeg" value="{{ old('no_karpeg', '') }}">
                @if($errors->has('no_karpeg'))
                    <span class="text-danger">{{ $errors->first('no_karpeg') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipPnsLainnya.fields.no_karpeg_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="karpeg">{{ trans('cruds.arsipPnsLainnya.fields.karpeg') }}</label>
                <div class="needsclick dropzone {{ $errors->has('karpeg') ? 'is-invalid' : '' }}" id="karpeg-dropzone">
                </div>
                @if($errors->has('karpeg'))
                    <span class="text-danger">{{ $errors->first('karpeg') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipPnsLainnya.fields.karpeg_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="no_karis_karsu">{{ trans('cruds.arsipPnsLainnya.fields.no_karis_karsu') }}</label>
                <input class="form-control {{ $errors->has('no_karis_karsu') ? 'is-invalid' : '' }}" type="text" name="no_karis_karsu" id="no_karis_karsu" value="{{ old('no_karis_karsu', '') }}">
                @if($errors->has('no_karis_karsu'))
                    <span class="text-danger">{{ $errors->first('no_karis_karsu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipPnsLainnya.fields.no_karis_karsu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="karis_karsu">{{ trans('cruds.arsipPnsLainnya.fields.karis_karsu') }}</label>
                <div class="needsclick dropzone {{ $errors->has('karis_karsu') ? 'is-invalid' : '' }}" id="karis_karsu-dropzone">
                </div>
                @if($errors->has('karis_karsu'))
                    <span class="text-danger">{{ $errors->first('karis_karsu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipPnsLainnya.fields.karis_karsu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="taspen">{{ trans('cruds.arsipPnsLainnya.fields.taspen') }}</label>
                <div class="needsclick dropzone {{ $errors->has('taspen') ? 'is-invalid' : '' }}" id="taspen-dropzone">
                </div>
                @if($errors->has('taspen'))
                    <span class="text-danger">{{ $errors->first('taspen') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.arsipPnsLainnya.fields.taspen_helper') }}</span>
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
    Dropzone.options.karpegDropzone = {
    url: '{{ route('admin.arsip-pns-lainnyas.storeMedia') }}',
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
      $('form').find('input[name="karpeg"]').remove()
      $('form').append('<input type="hidden" name="karpeg" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="karpeg"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipPnsLainnya) && $arsipPnsLainnya->karpeg)
      var file = {!! json_encode($arsipPnsLainnya->karpeg) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="karpeg" value="' + file.file_name + '">')
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
    Dropzone.options.karisKarsuDropzone = {
    url: '{{ route('admin.arsip-pns-lainnyas.storeMedia') }}',
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
      $('form').find('input[name="karis_karsu"]').remove()
      $('form').append('<input type="hidden" name="karis_karsu" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="karis_karsu"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipPnsLainnya) && $arsipPnsLainnya->karis_karsu)
      var file = {!! json_encode($arsipPnsLainnya->karis_karsu) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="karis_karsu" value="' + file.file_name + '">')
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
    Dropzone.options.taspenDropzone = {
    url: '{{ route('admin.arsip-pns-lainnyas.storeMedia') }}',
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
      $('form').find('input[name="taspen"]').remove()
      $('form').append('<input type="hidden" name="taspen" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="taspen"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($arsipPnsLainnya) && $arsipPnsLainnya->taspen)
      var file = {!! json_encode($arsipPnsLainnya->taspen) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="taspen" value="' + file.file_name + '">')
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