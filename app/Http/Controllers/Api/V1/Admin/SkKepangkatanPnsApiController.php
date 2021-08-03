<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSkKepangkatanPnRequest;
use App\Http\Requests\UpdateSkKepangkatanPnRequest;
use App\Http\Resources\Admin\SkKepangkatanPnResource;
use App\Models\SkKepangkatanPn;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkKepangkatanPnsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkKepangkatanPnResource(SkKepangkatanPn::with(['nama_ptk'])->get());
    }

    public function store(StoreSkKepangkatanPnRequest $request)
    {
        $skKepangkatanPn = SkKepangkatanPn::create($request->all());

        if ($request->input('softfile', false)) {
            $skKepangkatanPn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        return (new SkKepangkatanPnResource($skKepangkatanPn))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SkKepangkatanPn $skKepangkatanPn)
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkKepangkatanPnResource($skKepangkatanPn->load(['nama_ptk']));
    }

    public function update(UpdateSkKepangkatanPnRequest $request, SkKepangkatanPn $skKepangkatanPn)
    {
        $skKepangkatanPn->update($request->all());

        if ($request->input('softfile', false)) {
            if (!$skKepangkatanPn->softfile || $request->input('softfile') !== $skKepangkatanPn->softfile->file_name) {
                if ($skKepangkatanPn->softfile) {
                    $skKepangkatanPn->softfile->delete();
                }
                $skKepangkatanPn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
            }
        } elseif ($skKepangkatanPn->softfile) {
            $skKepangkatanPn->softfile->delete();
        }

        return (new SkKepangkatanPnResource($skKepangkatanPn))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SkKepangkatanPn $skKepangkatanPn)
    {
        abort_if(Gate::denies('sk_kepangkatan_pn_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skKepangkatanPn->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
