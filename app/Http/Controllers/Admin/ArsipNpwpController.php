<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArsipNpwpRequest;
use App\Http\Requests\StoreArsipNpwpRequest;
use App\Http\Requests\UpdateArsipNpwpRequest;
use App\Models\ArsipNpwp;
use App\Models\Ptk;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArsipNpwpController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('arsip_npwp_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ArsipNpwp::with(['nama_ptk'])->select(sprintf('%s.*', (new ArsipNpwp())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'arsip_npwp_show';
                $editGate = 'arsip_npwp_edit';
                $deleteGate = 'arsip_npwp_delete';
                $crudRoutePart = 'arsip-npwps';

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

            $table->editColumn('no_npwp', function ($row) {
                return $row->no_npwp ? $row->no_npwp : '';
            });
            $table->editColumn('kartu_npwp', function ($row) {
                return $row->kartu_npwp ? '<a href="' . $row->kartu_npwp->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_ptk', 'kartu_npwp']);

            return $table->make(true);
        }

        return view('admin.arsipNpwps.index');
    }

    public function create()
    {
        abort_if(Gate::denies('arsip_npwp_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.arsipNpwps.create', compact('nama_ptks'));
    }

    public function store(StoreArsipNpwpRequest $request)
    {
        $arsipNpwp = ArsipNpwp::create($request->all());

        if ($request->input('kartu_npwp', false)) {
            $arsipNpwp->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_npwp'))))->toMediaCollection('kartu_npwp');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $arsipNpwp->id]);
        }

        return redirect()->route('admin.arsip-npwps.index');
    }

    public function edit(ArsipNpwp $arsipNpwp)
    {
        abort_if(Gate::denies('arsip_npwp_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $arsipNpwp->load('nama_ptk');

        return view('admin.arsipNpwps.edit', compact('nama_ptks', 'arsipNpwp'));
    }

    public function update(UpdateArsipNpwpRequest $request, ArsipNpwp $arsipNpwp)
    {
        $arsipNpwp->update($request->all());

        if ($request->input('kartu_npwp', false)) {
            if (!$arsipNpwp->kartu_npwp || $request->input('kartu_npwp') !== $arsipNpwp->kartu_npwp->file_name) {
                if ($arsipNpwp->kartu_npwp) {
                    $arsipNpwp->kartu_npwp->delete();
                }
                $arsipNpwp->addMedia(storage_path('tmp/uploads/' . basename($request->input('kartu_npwp'))))->toMediaCollection('kartu_npwp');
            }
        } elseif ($arsipNpwp->kartu_npwp) {
            $arsipNpwp->kartu_npwp->delete();
        }

        return redirect()->route('admin.arsip-npwps.index');
    }

    public function show(ArsipNpwp $arsipNpwp)
    {
        abort_if(Gate::denies('arsip_npwp_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipNpwp->load('nama_ptk');

        return view('admin.arsipNpwps.show', compact('arsipNpwp'));
    }

    public function destroy(ArsipNpwp $arsipNpwp)
    {
        abort_if(Gate::denies('arsip_npwp_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arsipNpwp->delete();

        return back();
    }

    public function massDestroy(MassDestroyArsipNpwpRequest $request)
    {
        ArsipNpwp::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('arsip_npwp_create') && Gate::denies('arsip_npwp_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ArsipNpwp();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
