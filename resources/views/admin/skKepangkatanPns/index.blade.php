@extends('layouts.admin')
@section('content')
@can('sk_kepangkatan_pn_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sk-kepangkatan-pns.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.skKepangkatanPn.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.skKepangkatanPn.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SkKepangkatanPn">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.skKepangkatanPn.fields.no_surat') }}
                    </th>
                    <th>
                        {{ trans('cruds.skKepangkatanPn.fields.tgl_surat') }}
                    </th>
                    <th>
                        {{ trans('cruds.skKepangkatanPn.fields.nama_ptk') }}
                    </th>
                    <th>
                        {{ trans('cruds.skKepangkatanPn.fields.tmt_cpns') }}
                    </th>
                    <th>
                        {{ trans('cruds.skKepangkatanPn.fields.masa_kerja_golongan') }}
                    </th>
                    <th>
                        {{ trans('cruds.skKepangkatanPn.fields.masa_kerja_bulan') }}
                    </th>
                    <th>
                        {{ trans('cruds.skKepangkatanPn.fields.softfile') }}
                    </th>
                    <th>
                        {{ trans('cruds.skKepangkatanPn.fields.pangkat_golongan') }}
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
@can('sk_kepangkatan_pn_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sk-kepangkatan-pns.massDestroy') }}",
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
    ajax: "{{ route('admin.sk-kepangkatan-pns.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'no_surat', name: 'no_surat' },
{ data: 'tgl_surat', name: 'tgl_surat' },
{ data: 'nama_ptk_nama_lengkap', name: 'nama_ptk.nama_lengkap' },
{ data: 'tmt_cpns', name: 'tmt_cpns' },
{ data: 'masa_kerja_golongan', name: 'masa_kerja_golongan' },
{ data: 'masa_kerja_bulan', name: 'masa_kerja_bulan' },
{ data: 'softfile', name: 'softfile', sortable: false, searchable: false },
{ data: 'pangkat_golongan', name: 'pangkat_golongan' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SkKepangkatanPn').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection