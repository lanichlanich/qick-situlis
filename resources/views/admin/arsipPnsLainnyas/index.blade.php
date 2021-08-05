@extends('layouts.admin')
@section('content')
@can('arsip_pns_lainnya_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.arsip-pns-lainnyas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.arsipPnsLainnya.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.arsipPnsLainnya.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ArsipPnsLainnya">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.arsipPnsLainnya.fields.nama_ptk') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipPnsLainnya.fields.no_karpeg') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipPnsLainnya.fields.karpeg') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipPnsLainnya.fields.no_karis_karsu') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipPnsLainnya.fields.karis_karsu') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipPnsLainnya.fields.taspen') }}
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
@can('arsip_pns_lainnya_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.arsip-pns-lainnyas.massDestroy') }}",
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
    ajax: "{{ route('admin.arsip-pns-lainnyas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'nama_ptk_nama_lengkap', name: 'nama_ptk.nama_lengkap' },
{ data: 'no_karpeg', name: 'no_karpeg' },
{ data: 'karpeg', name: 'karpeg', sortable: false, searchable: false },
{ data: 'no_karis_karsu', name: 'no_karis_karsu' },
{ data: 'karis_karsu', name: 'karis_karsu', sortable: false, searchable: false },
{ data: 'taspen', name: 'taspen', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ArsipPnsLainnya').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection