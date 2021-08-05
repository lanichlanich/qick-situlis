<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySkCpnRequest;
use App\Http\Requests\StoreSkCpnRequest;
use App\Http\Requests\UpdateSkCpnRequest;
use App\Models\Ptk;
use App\Models\SkCpn;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SkCpnsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('sk_cpn_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SkCpn::with(['nama_ptk'])->select(sprintf('%s.*', (new SkCpn())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'sk_cpn_show';
                $editGate = 'sk_cpn_edit';
                $deleteGate = 'sk_cpn_delete';
                $crudRoutePart = 'sk-cpns';

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

            $table->editColumn('masa_kerja_golongan', function ($row) {
                return $row->masa_kerja_golongan ? $row->masa_kerja_golongan : '';
            });
            $table->editColumn('masa_kerja_bulan', function ($row) {
                return $row->masa_kerja_bulan ? $row->masa_kerja_bulan : '';
            });
            $table->editColumn('softfile', function ($row) {
                return $row->softfile ? '<a href="' . $row->softfile->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('pangkat_golongan', function ($row) {
                return $row->pangkat_golongan ? SkCpn::PANGKAT_GOLONGAN_SELECT[$row->pangkat_golongan] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'nama_ptk', 'softfile']);

            return $table->make(true);
        }

        return view('admin.skCpns.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sk_cpn_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.skCpns.create', compact('nama_ptks'));
    }

    public function store(StoreSkCpnRequest $request)
    {
        $skCpn = SkCpn::create($request->all());

        if ($request->input('softfile', false)) {
            $skCpn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $skCpn->id]);
        }

        return redirect()->route('admin.sk-cpns.index');
    }

    public function edit(SkCpn $skCpn)
    {
        abort_if(Gate::denies('sk_cpn_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nama_ptks = Ptk::pluck('nama_lengkap', 'id')->prepend(trans('global.pleaseSelect'), '');

        $skCpn->load('nama_ptk');

        return view('admin.skCpns.edit', compact('nama_ptks', 'skCpn'));
    }

    public function update(UpdateSkCpnRequest $request, SkCpn $skCpn)
    {
        $skCpn->update($request->all());

        if ($request->input('softfile', false)) {
            if (!$skCpn->softfile || $request->input('softfile') !== $skCpn->softfile->file_name) {
                if ($skCpn->softfile) {
                    $skCpn->softfile->delete();
                }
                $skCpn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
            }
        } elseif ($skCpn->softfile) {
            $skCpn->softfile->delete();
        }

        return redirect()->route('admin.sk-cpns.index');
    }

    public function show(SkCpn $skCpn)
    {
        abort_if(Gate::denies('sk_cpn_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skCpn->load('nama_ptk');

        return view('admin.skCpns.show', compact('skCpn'));
    }

    public function destroy(SkCpn $skCpn)
    {
        abort_if(Gate::denies('sk_cpn_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skCpn->delete();

        return back();
    }

    public function massDestroy(MassDestroySkCpnRequest $request)
    {
        SkCpn::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sk_cpn_create') && Gate::denies('sk_cpn_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SkCpn();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
