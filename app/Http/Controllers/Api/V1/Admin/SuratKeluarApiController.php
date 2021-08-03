<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSuratKeluarRequest;
use App\Http\Requests\UpdateSuratKeluarRequest;
use App\Http\Resources\Admin\SuratKeluarResource;
use App\Models\SuratKeluar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuratKeluarApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('surat_keluar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuratKeluarResource(SuratKeluar::all());
    }

    public function store(StoreSuratKeluarRequest $request)
    {
        $suratKeluar = SuratKeluar::create($request->all());

        if ($request->input('softfile', false)) {
            $suratKeluar->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        return (new SuratKeluarResource($suratKeluar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SuratKeluar $suratKeluar)
    {
        abort_if(Gate::denies('surat_keluar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuratKeluarResource($suratKeluar);
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

        return (new SuratKeluarResource($suratKeluar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SuratKeluar $suratKeluar)
    {
        abort_if(Gate::denies('surat_keluar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suratKeluar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
