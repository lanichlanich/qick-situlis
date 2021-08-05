@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.arsipPnsLainnya.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.arsip-pns-lainnyas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipPnsLainnya.fields.nama_ptk') }}
                        </th>
                        <td>
                            {{ $arsipPnsLainnya->nama_ptk->nama_lengkap ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipPnsLainnya.fields.no_karpeg') }}
                        </th>
                        <td>
                            {{ $arsipPnsLainnya->no_karpeg }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipPnsLainnya.fields.karpeg') }}
                        </th>
                        <td>
                            @if($arsipPnsLainnya->karpeg)
                                <a href="{{ $arsipPnsLainnya->karpeg->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipPnsLainnya.fields.no_karis_karsu') }}
                        </th>
                        <td>
                            {{ $arsipPnsLainnya->no_karis_karsu }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipPnsLainnya.fields.karis_karsu') }}
                        </th>
                        <td>
                            @if($arsipPnsLainnya->karis_karsu)
                                <a href="{{ $arsipPnsLainnya->karis_karsu->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.arsipPnsLainnya.fields.taspen') }}
                        </th>
                        <td>
                            @if($arsipPnsLainnya->taspen)
                                <a href="{{ $arsipPnsLainnya->taspen->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.arsip-pns-lainnyas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection