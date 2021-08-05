@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.daftarBuku.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-bukus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarBuku.fields.id') }}
                        </th>
                        <td>
                            {{ $daftarBuku->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daftarBuku.fields.nama_buku') }}
                        </th>
                        <td>
                            {{ $daftarBuku->nama_buku }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daftar-bukus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection