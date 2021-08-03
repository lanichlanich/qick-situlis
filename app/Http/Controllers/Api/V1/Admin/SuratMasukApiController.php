<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSuratMasukRequest;
use App\Http\Requests\UpdateSuratMasukRequest;
use App\Http\Resources\Admin\SuratMasukResource;
use App\Models\SuratMasuk;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuratMasukApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('surat_masuk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuratMasukResource(SuratMasuk::all());
    }

    public function store(StoreSuratMasukRequest $request)
    {
        $suratMasuk = SuratMasuk::create($request->all());

        if ($request->input('softfile', false)) {
            $suratMasuk->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        return (new SuratMasukResource($suratMasuk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SuratMasuk $suratMasuk)
    {
        abort_if(Gate::denies('surat_masuk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuratMasukResource($suratMasuk);
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

        return (new SuratMasukResource($suratMasuk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SuratMasuk $suratMasuk)
    {
        abort_if(Gate::denies('surat_masuk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suratMasuk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
