@extends('layouts.admin')
@section('content')
@can('arsip_ijazah_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.arsip-ijazahs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.arsipIjazah.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.arsipIjazah.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ArsipIjazah">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.arsipIjazah.fields.nama_ptk') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipIjazah.fields.sd') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipIjazah.fields.smp_mts') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipIjazah.fields.sma_smk_ma') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipIjazah.fields.d_3') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipIjazah.fields.s_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.arsipIjazah.fields.s_2') }}
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
@can('arsip_ijazah_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.arsip-ijazahs.massDestroy') }}",
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
    ajax: "{{ route('admin.arsip-ijazahs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'nama_ptk_nama_lengkap', name: 'nama_ptk.nama_lengkap' },
{ data: 'sd', name: 'sd', sortable: false, searchable: false },
{ data: 'smp_mts', name: 'smp_mts', sortable: false, searchable: false },
{ data: 'sma_smk_ma', name: 'sma_smk_ma', sortable: false, searchable: false },
{ data: 'd_3', name: 'd_3', sortable: false, searchable: false },
{ data: 's_1', name: 's_1', sortable: false, searchable: false },
{ data: 's_2', name: 's_2', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ArsipIjazah').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection