@extends('layouts.admin')
@section('content')
@can('surat_masuk_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.surat-masuks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.suratMasuk.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.suratMasuk.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SuratMasuk">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.suratMasuk.fields.no_surat') }}
                    </th>
                    <th>
                        {{ trans('cruds.suratMasuk.fields.tgl_surat') }}
                    </th>
                    <th>
                        {{ trans('cruds.suratMasuk.fields.keterangan') }}
                    </th>
                    <th>
                        {{ trans('cruds.suratMasuk.fields.pengirim') }}
                    </th>
                    <th>
                        {{ trans('cruds.suratMasuk.fields.softfile') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('surat_masuk_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.surat-masuks.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.surat-masuks.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'no_surat', name: 'no_surat' },
{ data: 'tgl_surat', name: 'tgl_surat' },
{ data: 'keterangan', name: 'keterangan' },
{ data: 'pengirim', name: 'pengirim' },
{ data: 'softfile', name: 'softfile', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SuratMasuk').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection