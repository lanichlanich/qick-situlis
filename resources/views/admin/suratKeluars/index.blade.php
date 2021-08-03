@extends('layouts.admin')
@section('content')
@can('surat_keluar_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.surat-keluars.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.suratKeluar.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.suratKeluar.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SuratKeluar">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.suratKeluar.fields.no_surat') }}
                    </th>
                    <th>
                        {{ trans('cruds.suratKeluar.fields.tgl_surat') }}
                    </th>
                    <th>
                        {{ trans('cruds.suratKeluar.fields.keterangan') }}
                    </th>
                    <th>
                        {{ trans('cruds.suratKeluar.fields.tujuan') }}
                    </th>
                    <th>
                        {{ trans('cruds.suratKeluar.fields.softfile') }}
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
@can('surat_keluar_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.surat-keluars.massDestroy') }}",
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
    ajax: "{{ route('admin.surat-keluars.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'no_surat', name: 'no_surat' },
{ data: 'tgl_surat', name: 'tgl_surat' },
{ data: 'keterangan', name: 'keterangan' },
{ data: 'tujuan', name: 'tujuan' },
{ data: 'softfile', name: 'softfile', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SuratKeluar').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection