<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySkPengangkatanHonorerRequest;
use App\Http\Requests\StoreSkPengangkatanHonorerRequest;
use App\Http\Requests\UpdateSkPengangkatanHonorerRequest;
use App\Models\Ptk;
use App\Models\SkPengangkatanHonorer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SkPengangkatanHonorerController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SkPengangkatanHonorer::with(['nama_ptk'])->select(sprintf('%s.*', (new SkPengangkatanHonorer())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sk_pengangkatan_honorer_show';
                $editGate = 'sk_pengangkatan_honorer_edit';
                $deleteGate = 'sk_pengangkatan_honorer_delete';
                $crudRoutePart = 'sk-pengangkatan-honorers';

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

            $table->addColumn('nama_ptk_nama_lengkap', function ($row) {
                return $row->nama_ptk ? $row->nama_ptk->nama_lengkap : '';
            });

            $table->editColumn('masa_kerja', function ($row) {
                return $row->masa_kerja ? $row->masa_kerja : '';
            });
            $table->editColumn('masa_kerja_bulan', function ($row) {
                return $row->masa_kerja_bulan ? $row->masa_kerja_bulan : '';
            });
            $table->editColumn('softfile', function ($row) {
                return $row->softfile ? '<a href="' . $row->softfile->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('jenis_ptk', function ($row) {
                return $row->jenis_ptk ? SkPengangkatanHonorer::JENIS_PTK_SELECT[$row->jenis_ptk] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_ptk', 'softfile']);

            return $table->make(true);
        }

        return view('admin.skPengangkatanHonorers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.skPengangkatanHonorers.create', compact('nama_ptks'));
    }

    public function store(StoreSkPengangkatanHonorerRequest $request)
    {
        $skPengangkatanHonorer = SkPengangkatanHonorer::create($request->all());

        if ($request->input('softfile', false)) {
            $skPengangkatanHonorer->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $skPengangkatanHonorer->id]);
        }

        return redirect()->route('admin.sk-pengangkatan-honorers.index');
    }

    public function edit(SkPengangkatanHonorer $skPengangkatanHonorer)
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skPengangkatanHonorer->load('nama_ptk');

        return view('admin.skPengangkatanHonorers.edit', compact('nama_ptks', 'skPengangkatanHonorer'));
    }

    public function update(UpdateSkPengangkatanHonorerRequest $request, SkPengangkatanHonorer $skPengangkatanHonorer)
    {
        $skPengangkatanHonorer->update($request->all());

        if ($request->input('softfile', false)) {
            if (!$skPengangkatanHonorer->softfile || $request->input('softfile') !== $skPengangkatanHonorer->softfile->file_name) {
                if ($skPengangkatanHonorer->softfile) {
                    $skPengangkatanHonorer->softfile->delete();
                }
                $skPengangkatanHonorer->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
            }
        } elseif ($skPengangkatanHonorer->softfile) {
            $skPengangkatanHonorer->softfile->delete();
        }

        return redirect()->route('admin.sk-pengangkatan-honorers.index');
    }

    public function show(SkPengangkatanHonorer $skPengangkatanHonorer)
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skPengangkatanHonorer->load('nama_ptk');

        return view('admin.skPengangkatanHonorers.show', compact('skPengangkatanHonorer'));
    }

    public function destroy(SkPengangkatanHonorer $skPengangkatanHonorer)
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skPengangkatanHonorer->delete();

        return back();
    }

    public function massDestroy(MassDestroySkPengangkatanHonorerRequest $request)
    {
        SkPengangkatanHonorer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_create') && Gate::denies('sk_pengangkatan_honorer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SkPengangkatanHonorer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
