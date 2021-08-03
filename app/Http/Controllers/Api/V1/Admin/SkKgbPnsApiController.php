<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSkKgbPnRequest;
use App\Http\Requests\UpdateSkKgbPnRequest;
use App\Http\Resources\Admin\SkKgbPnResource;
use App\Models\SkKgbPn;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkKgbPnsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sk_kgb_pn_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkKgbPnResource(SkKgbPn::with(['nama_ptk'])->get());
    }

    public function store(StoreSkKgbPnRequest $request)
    {
        $skKgbPn = SkKgbPn::create($request->all());

        if ($request->input('softfile', false)) {
            $skKgbPn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        return (new SkKgbPnResource($skKgbPn))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SkKgbPn $skKgbPn)
    {
        abort_if(Gate::denies('sk_kgb_pn_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkKgbPnResource($skKgbPn->load(['nama_ptk']));
    }

    public function update(UpdateSkKgbPnRequest $request, SkKgbPn $skKgbPn)
    {
        $skKgbPn->update($request->all());

        if ($request->input('softfile', false)) {
            if (!$skKgbPn->softfile || $request->input('softfile') !== $skKgbPn->softfile->file_name) {
                if ($skKgbPn->softfile) {
                    $skKgbPn->softfile->delete();
                }
                $skKgbPn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
            }
        } elseif ($skKgbPn->softfile) {
            $skKgbPn->softfile->delete();
        }

        return (new SkKgbPnResource($skKgbPn))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SkKgbPn $skKgbPn)
    {
        abort_if(Gate::denies('sk_kgb_pn_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skKgbPn->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
