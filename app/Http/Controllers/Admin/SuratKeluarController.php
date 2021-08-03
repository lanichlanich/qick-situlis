<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySuratKeluarRequest;
use App\Http\Requests\StoreSuratKeluarRequest;
use App\Http\Requests\UpdateSuratKeluarRequest;
use App\Models\SuratKeluar;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SuratKeluarController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('surat_keluar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SuratKeluar::query()->select(sprintf('%s.*', (new SuratKeluar())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'surat_keluar_show';
                $editGate = 'surat_keluar_edit';
                $deleteGate = 'surat_keluar_delete';
                $crudRoutePart = 'surat-keluars';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('no_surat', function ($row) {
                return $row->no_surat ? $row->no_surat : '';
            });

            $table->editColumn('keterangan', function ($row) {
                return $row->keterangan ? $row->keterangan : '';
            });
            $table->editColumn('tujuan', function ($row) {
                return $row->tujuan ? $row->tujuan : '';
            });
            $table->editColumn('softfile', function ($row) {
                return $row->softfile ? '<a href="' . $row->softfile->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'softfile']);

            return $table->make(true);
        }

        return view('admin.suratKeluars.index');
    }

    public function create()
    {
        abort_if(Gate::denies('surat_keluar_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.suratKeluars.create');
    }

    public function store(StoreSuratKeluarRequest $request)
    {
        $suratKeluar = SuratKeluar::create($request->all());

        if ($request->input('softfile', false)) {
            $suratKeluar->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $suratKeluar->id]);
        }

        return redirect()->route('admin.surat-keluars.index');
    }

    public function edit(SuratKeluar $suratKeluar)
    {
        abort_if(Gate::denies('surat_keluar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.suratKeluars.edit', compact('suratKeluar'));
    }

    public function update(UpdateSuratKeluarRequest $request, SuratKeluar $suratKeluar)
    {
        $suratKeluar->update($request->all());

        if ($request->input('softfile', false)) {
            if (!$suratKeluar->softfile || $request->input('softfile') !== $suratKeluar->softfile->file_name) {
                if ($suratKeluar->softfile) {
                    $suratKeluar->softfile->delete();
                }
                $suratKeluar->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
            }
        } elseif ($suratKeluar->softfile) {
            $suratKeluar->softfile->delete();
        }

        return redirect()->route('admin.surat-keluars.index');
    }

    public function show(SuratKeluar $suratKeluar)
    {
        abort_if(Gate::denies('surat_keluar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.suratKeluars.show', compact('suratKeluar'));
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        abort_if(Gate::denies('surat_keluar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suratKeluar->delete();

        return back();
    }

    public function massDestroy(MassDestroySuratKeluarRequest $request)
    {
        SuratKeluar::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('surat_keluar_create') && Gate::denies('surat_keluar_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SuratKeluar();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
