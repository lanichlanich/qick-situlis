@extends('layouts.admin')
@section('content')
@can('sk_pengangkatan_honorer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sk-pengangkatan-honorers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.skPengangkatanHonorer.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.skPengangkatanHonorer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SkPengangkatanHonorer">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.skPengangkatanHonorer.fields.no_surat') }}
                    </th>
                    <th>
                        {{ trans('cruds.skPengangkatanHonorer.fields.tgl_surat') }}
                    </th>
                    <th>
                        {{ trans('cruds.skPengangkatanHonorer.fields.nama_ptk') }}
                    </th>
                    <th>
                        {{ trans('cruds.skPengangkatanHonorer.fields.tmt_sk') }}
                    </th>
                    <th>
                        {{ trans('cruds.skPengangkatanHonorer.fields.masa_kerja') }}
                    </th>
                    <th>
                        {{ trans('cruds.skPengangkatanHonorer.fields.masa_kerja_bulan') }}
                    </th>
                    <th>
                        {{ trans('cruds.skPengangkatanHonorer.fields.softfile') }}
                    </th>
                    <th>
                        {{ trans('cruds.skPengangkatanHonorer.fields.jenis_ptk') }}
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
@can('sk_pengangkatan_honorer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sk-pengangkatan-honorers.massDestroy') }}",
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
    ajax: "{{ route('admin.sk-pengangkatan-honorers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'no_surat', name: 'no_surat' },
{ data: 'tgl_surat', name: 'tgl_surat' },
{ data: 'nama_ptk_nama_lengkap', name: 'nama_ptk.nama_lengkap' },
{ data: 'tmt_sk', name: 'tmt_sk' },
{ data: 'masa_kerja', name: 'masa_kerja' },
{ data: 'masa_kerja_bulan', name: 'masa_kerja_bulan' },
{ data: 'softfile', name: 'softfile', sortable: false, searchable: false },
{ data: 'jenis_ptk', name: 'jenis_ptk' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SkPengangkatanHonorer').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection