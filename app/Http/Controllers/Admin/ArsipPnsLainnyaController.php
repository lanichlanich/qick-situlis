<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArsipPnsLainnyaRequest;
use App\Http\Requests\StoreArsipPnsLainnyaRequest;
use App\Http\Requests\UpdateArsipPnsLainnyaRequest;
use App\Models\ArsipPnsLainnya;
use App\Models\Ptk;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArsipPnsLainnyaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('arsip_pns_lainnya_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArsipPnsLainnya::with(['nama_ptk'])->select(sprintf('%s.*', (new ArsipPnsLainnya())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'arsip_pns_lainnya_show';
                $editGate = 'arsip_pns_lainnya_edit';
                $deleteGate = 'arsip_pns_lainnya_delete';
                $crudRoutePart = 'arsip-pns-lainnyas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->addColumn('nama_ptk_nama_lengkap', function ($row) {
                return $row->nama_ptk ? $row->nama_ptk->nama_lengkap : '';
            });

            $table->editColumn('no_karpeg', function ($row) {
                return $row->no_karpeg ? $row->no_karpeg : '';
            });
            $table->editColumn('karpeg', function ($row) {
                return $row->karpeg ? '<a href="' . $row->karpeg->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('no_karis_karsu', function ($row) {
                return $row->no_karis_karsu ? $row->no_karis_karsu : '';
            });
            $table->editColumn('karis_karsu', function ($row) {
                return $row->karis_karsu ? '<a href="' . $row->karis_karsu->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('taspen', function ($row) {
                return $row->taspen ? '<a href="' . $row->taspen->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_ptk', 'karpeg', 'karis_karsu', 'taspen']);

            return $table->make(true);
        }

        return view('admin.arsipPnsLainnyas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('arsip_pns_lainnya_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.arsipPnsLainnyas.create', compact('nama_ptks'));
    }

    public function store(StoreArsipPnsLainnyaRequest $request)
    {
        $arsipPnsLainnya = ArsipPnsLainnya::create($request->all());

        if ($request->input('karpeg', false)) {
            $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('karpeg'))))->toMediaCollection('karpeg');
        }

        if ($request->input('karis_karsu', false)) {
            $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('karis_karsu'))))->toMediaCollection('karis_karsu');
        }

        if ($request->input('taspen', false)) {
            $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('taspen'))))->toMediaCollection('taspen');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $arsipPnsLainnya->id]);
        }

        return redirect()->route('admin.arsip-pns-lainnyas.index');
    }

    public function edit(ArsipPnsLainnya $arsipPnsLainnya)
    {
        abort_if(Gate::denies('arsip_pns_lainnya_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $arsipPnsLainnya->load('nama_ptk');

        return view('admin.arsipPnsLainnyas.edit', compact('nama_ptks', 'arsipPnsLainnya'));
    }

    public function update(UpdateArsipPnsLainnyaRequest $request, ArsipPnsLainnya $arsipPnsLainnya)
    {
        $arsipPnsLainnya->update($request->all());

        if ($request->input('karpeg', false)) {
            if (!$arsipPnsLainnya->karpeg || $request->input('karpeg') !== $arsipPnsLainnya->karpeg->file_name) {
                if ($arsipPnsLainnya->karpeg) {
                    $arsipPnsLainnya->karpeg->delete();
                }
                $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('karpeg'))))->toMediaCollection('karpeg');
            }
        } elseif ($arsipPnsLainnya->karpeg) {
            $arsipPnsLainnya->karpeg->delete();
        }

        if ($request->input('karis_karsu', false)) {
            if (!$arsipPnsLainnya->karis_karsu || $request->input('karis_karsu') !== $arsipPnsLainnya->karis_karsu->file_name) {
                if ($arsipPnsLainnya->karis_karsu) {
                    $arsipPnsLainnya->karis_karsu->delete();
                }
                $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('karis_karsu'))))->toMediaCollection('karis_karsu');
            }
        } elseif ($arsipPnsLainnya->karis_karsu) {
            $arsipPnsLainnya->karis_karsu->delete();
        }

        if ($request->input('taspen', false)) {
            if (!$arsipPnsLainnya->taspen || $request->input('taspen') !== $arsipPnsLainnya->taspen->file_name) {
                if ($arsipPnsLainnya->taspen) {
                    $arsipPnsLainnya->taspen->delete();
                }
                $arsipPnsLainnya->addMedia(storage_path('tmp/uploads/' . basename($request->input('taspen'))))->toMediaCollection('taspen');
            }
        } elseif ($arsipPnsLainnya->taspen) {
            $arsipPnsLainnya->taspen->delete();
        }

        return redirect()->route('admin.arsip-pns-lainnyas.index');
    }

    public function show(ArsipPnsLainnya $arsipPnsLainnya)
    {
        abort_if(Gate::denies('arsip_pns_lainnya_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipPnsLainnya->load('nama_ptk');

        return view('admin.arsipPnsLainnyas.show', compact('arsipPnsLainnya'));
    }

    public function destroy(ArsipPnsLainnya $arsipPnsLainnya)
    {
        abort_if(Gate::denies('arsip_pns_lainnya_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipPnsLainnya->delete();

        return back();
    }

    public function massDestroy(MassDestroyArsipPnsLainnyaRequest $request)
    {
        ArsipPnsLainnya::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('arsip_pns_lainnya_create') && Gate::denies('arsip_pns_lainnya_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ArsipPnsLainnya();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
