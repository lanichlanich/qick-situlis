<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSkCpnRequest;
use App\Http\Requests\UpdateSkCpnRequest;
use App\Http\Resources\Admin\SkCpnResource;
use App\Models\SkCpn;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkCpnsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sk_cpn_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkCpnResource(SkCpn::with(['nama_ptk'])->get());
    }

    public function store(StoreSkCpnRequest $request)
    {
        $skCpn = SkCpn::create($request->all());

        if ($request->input('softfile', false)) {
            $skCpn->addMedia(storage_path('tmp/uploads/' . basename($request->input('softfile'))))->toMediaCollection('softfile');
        }

        return (new SkCpnResource($skCpn))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SkCpn $skCpn)
    {
        abort_if(Gate::denies('sk_cpn_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SkCpnResource($skCpn->load(['nama_ptk']));
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

        return (new SkCpnResource($skCpn))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SkCpn $skCpn)
    {
        abort_if(Gate::denies('sk_cpn_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $skCpn->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
