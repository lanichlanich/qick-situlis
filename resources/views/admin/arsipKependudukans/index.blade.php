@extends('layouts.admin')
@section('content')
@can('arsip_kependudukan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.arsip-kependudukans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.arsipKependudukan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.arsipKependudukan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ArsipKependudukan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.arsipKependudukan.fields.nama_ptk') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipKependudukan.fields.no_nik') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipKependudukan.fields.ktp') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipKependudukan.fields.no_kk') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipKependudukan.fields.kartu_keluarga') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipKependudukan.fields.akta_lahir') }}
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
@can('arsip_kependudukan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.arsip-kependudukans.massDestroy') }}",
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
    ajax: "{{ route('admin.arsip-kependudukans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'nama_ptk_nama_lengkap', name: 'nama_ptk.nama_lengkap' },
{ data: 'no_nik', name: 'no_nik' },
{ data: 'ktp', name: 'ktp', sortable: false, searchable: false },
{ data: 'no_kk', name: 'no_kk' },
{ data: 'kartu_keluarga', name: 'kartu_keluarga', sortable: false, searchable: false },
{ data: 'akta_lahir', name: 'akta_lahir', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ArsipKependudukan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection