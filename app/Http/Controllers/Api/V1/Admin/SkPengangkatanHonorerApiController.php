<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSkPengangkatanHonorerRequest;
use App\Http\Requests\UpdateSkPengangkatanHonorerRequest;
use App\Http\Resources\Admin\SkPengangkatanHonorerResource;
use App\Models\SkPengangkatanHonorer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkPengangkatanHonorerApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkPengangkatanHonorerResource(SkPengangkatanHonorer::with(['nama_ptk'])->get());
    }

    public function store(StoreSkPengangkatanHonorerRequest $request)
    {
        $skPengangkatanHonorer = SkPengangkatanHonorer::create($request->all());

        if ($request->input('softfile', false)) {
            $skPengangkatanHonorer->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        return (new SkPengangkatanHonorerResource($skPengangkatanHonorer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SkPengangkatanHonorer $skPengangkatanHonorer)
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkPengangkatanHonorerResource($skPengangkatanHonorer->load(['nama_ptk']));
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

        return (new SkPengangkatanHonorerResource($skPengangkatanHonorer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SkPengangkatanHonorer $skPengangkatanHonorer)
    {
        abort_if(Gate::denies('sk_pengangkatan_honorer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skPengangkatanHonorer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
