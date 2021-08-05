@extends('layouts.admin')
@section('content')
@can('daftar_buku_perpustakaan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.daftar-buku-perpustakaans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.daftarBukuPerpustakaan.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.daftarBukuPerpustakaan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-DaftarBukuPerpustakaan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.daftarBukuPerpustakaan.fields.nama_buku') }}
                    </th>
                    <th>
                        {{ trans('cruds.daftarBukuPerpustakaan.fields.jumlah') }}
                    </th>
                    <th>
                        {{ trans('cruds.daftarBukuPerpustakaan.fields.tempat_penyimpanan') }}
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
@can('daftar_buku_perpustakaan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.daftar-buku-perpustakaans.massDestroy') }}",
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
    ajax: "{{ route('admin.daftar-buku-perpustakaans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'nama_buku_nama_buku', name: 'nama_buku.nama_buku' },
{ data: 'jumlah', name: 'jumlah' },
{ data: 'tempat_penyimpanan_nama_tempat_penyimpaanan', name: 'tempat_penyimpanan.nama_tempat_penyimpaanan' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-DaftarBukuPerpustakaan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection