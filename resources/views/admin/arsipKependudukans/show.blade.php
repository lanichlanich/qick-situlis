@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.arsipKependudukan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.arsip-kependudukans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipKependudukan.fields.nama_ptk') }}
                        </th>
                        <td>
                            {{ $arsipKependudukan->nama_ptk->nama_lengkap ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipKependudukan.fields.no_nik') }}
                        </th>
                        <td>
                            {{ $arsipKependudukan->no_nik }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipKependudukan.fields.ktp') }}
                        </th>
                        <td>
                            @if($arsipKependudukan->ktp)
                                <a href="{{ $arsipKependudukan->ktp->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipKependudukan.fields.no_kk') }}
                        </th>
                        <td>
                            {{ $arsipKependudukan->no_kk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipKependudukan.fields.kartu_keluarga') }}
                        </th>
                        <td>
                            @if($arsipKependudukan->kartu_keluarga)
                                <a href="{{ $arsipKependudukan->kartu_keluarga->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipKependudukan.fields.akta_lahir') }}
                        </th>
                        <td>
                            @if($arsipKependudukan->akta_lahir)
                                <a href="{{ $arsipKependudukan->akta_lahir->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.arsip-kependudukans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection