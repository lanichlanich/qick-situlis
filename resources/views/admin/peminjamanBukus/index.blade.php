@extends('layouts.admin')
@section('content')
@can('peminjaman_buku_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.peminjaman-bukus.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.peminjamanBuku.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.peminjamanBuku.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PeminjamanBuku">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.peminjamanBuku.fields.peminjam_buku') }}
                    </th>
                    <th>
                        {{ trans('cruds.peminjamanBuku.fields.nama_buku') }}
                    </th>
                    <th>
                        {{ trans('cruds.peminjamanBuku.fields.tempat_penyimpanan_buku') }}
                    </th>
                    <th>
                        {{ trans('cruds.peminjamanBuku.fields.jumlah_pinjam') }}
                    </th>
                    <th>
                        {{ trans('cruds.peminjamanBuku.fields.tanggal_pinjam') }}
                    </th>
                    <th>
                        {{ trans('cruds.peminjamanBuku.fields.tanggal_pengembalian') }}
                    </th>
                    <th>
                        {{ trans('cruds.peminjamanBuku.fields.status') }}
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
@can('peminjaman_buku_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.peminjaman-bukus.massDestroy') }}",
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
    ajax: "{{ route('admin.peminjaman-bukus.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'peminjam_buku_nama_peminjam', name: 'peminjam_buku.nama_peminjam' },
{ data: 'nama_buku_nama_buku', name: 'nama_buku.nama_buku' },
{ data: 'tempat_penyimpanan_buku_nama_tempat_penyimpaanan', name: 'tempat_penyimpanan_buku.nama_tempat_penyimpaanan' },
{ data: 'jumlah_pinjam', name: 'jumlah_pinjam' },
{ data: 'tanggal_pinjam', name: 'tanggal_pinjam' },
{ data: 'tanggal_pengembalian', name: 'tanggal_pengembalian' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-PeminjamanBuku').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection