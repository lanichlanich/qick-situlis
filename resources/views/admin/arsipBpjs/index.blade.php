@extends('layouts.admin')
@section('content')
@can('arsip_bpj_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.arsip-bpjs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.arsipBpj.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.arsipBpj.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ArsipBpj">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.nama_ptk') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.no_bpjs_pegawai') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.kartu_bpjs_pegawai') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.no_bpjs_suami_istri') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.kartu_bpjs_suami_istri') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.no_bpjs_anak_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.kartu_anak_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.no_bpjs_anak_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.kartu_anak_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.no_bpjs_anak_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipBpj.fields.kartu_anak_3') }}
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
@can('arsip_bpj_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.arsip-bpjs.massDestroy') }}",
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
    ajax: "{{ route('admin.arsip-bpjs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'nama_ptk_nama_lengkap', name: 'nama_ptk.nama_lengkap' },
{ data: 'no_bpjs_pegawai', name: 'no_bpjs_pegawai' },
{ data: 'kartu_bpjs_pegawai', name: 'kartu_bpjs_pegawai', sortable: false, searchable: false },
{ data: 'no_bpjs_suami_istri', name: 'no_bpjs_suami_istri' },
{ data: 'kartu_bpjs_suami_istri', name: 'kartu_bpjs_suami_istri', sortable: false, searchable: false },
{ data: 'no_bpjs_anak_1', name: 'no_bpjs_anak_1' },
{ data: 'kartu_anak_1', name: 'kartu_anak_1', sortable: false, searchable: false },
{ data: 'no_bpjs_anak_2', name: 'no_bpjs_anak_2' },
{ data: 'kartu_anak_2', name: 'kartu_anak_2', sortable: false, searchable: false },
{ data: 'no_bpjs_anak_3', name: 'no_bpjs_anak_3' },
{ data: 'kartu_anak_3', name: 'kartu_anak_3', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ArsipBpj').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection