<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySuratMasukRequest;
use App\Http\Requests\StoreSuratMasukRequest;
use App\Http\Requests\UpdateSuratMasukRequest;
use App\Models\SuratMasuk;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SuratMasukController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('surat_masuk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SuratMasuk::query()->select(sprintf('%s.*', (new SuratMasuk())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'surat_masuk_show';
                $editGate = 'surat_masuk_edit';
                $deleteGate = 'surat_masuk_delete';
                $crudRoutePart = 'surat-masuks';

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
            $table->editColumn('pengirim', function ($row) {
                return $row->pengirim ? $row->pengirim : '';
            });
            $table->editColumn('softfile', function ($row) {
                return $row->softfile ? '<a href="' . $row->softfile->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'softfile']);

            return $table->make(true);
        }

        return view('admin.suratMasuks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('surat_masuk_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.suratMasuks.create');
    }

    public function store(StoreSuratMasukRequest $request)
    {
        $suratMasuk = SuratMasuk::create($request->all());

        if ($request->input('softfile', false)) {
            $suratMasuk->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $suratMasuk->id]);
        }

        return redirect()->route('admin.surat-masuks.index');
    }

    public function edit(SuratMasuk $suratMasuk)
    {
        abort_if(Gate::denies('surat_masuk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.suratMasuks.edit', compact('suratMasuk'));
    }

    public function update(UpdateSuratMasukRequest $request, SuratMasuk $suratMasuk)
    {
        $suratMasuk->update($request->all());

        if ($request->input('softfile', false)) {
            if (!$suratMasuk->softfile || $request->input('softfile') !== $suratMasuk->softfile->file_name) {
                if ($suratMasuk->softfile) {
                    $suratMasuk->softfile->delete();
                }
                $suratMasuk->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
            }
        } elseif ($suratMasuk->softfile) {
            $suratMasuk->softfile->delete();
        }

        return redirect()->route('admin.surat-masuks.index');
    }

    public function show(SuratMasuk $suratMasuk)
    {
        abort_if(Gate::denies('surat_masuk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.suratMasuks.show', compact('suratMasuk'));
    }

    public function destroy(SuratMasuk $suratMasuk)
    {
        abort_if(Gate::denies('surat_masuk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suratMasuk->delete();

        return back();
    }

    public function massDestroy(MassDestroySuratMasukRequest $request)
    {
        SuratMasuk::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('surat_masuk_create') && Gate::denies('surat_masuk_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SuratMasuk();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
