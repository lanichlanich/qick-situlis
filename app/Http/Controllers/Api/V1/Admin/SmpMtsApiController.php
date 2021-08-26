<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSmpMtRequest;
use App\Http\Requests\UpdateSmpMtRequest;
use App\Http\Resources\Admin\SmpMtResource;
use App\Models\SmpMt;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SmpMtsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('smp_mt_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SmpMtResource(SmpMt::all());
    }

    public function store(StoreSmpMtRequest $request)
    {
        $smpMt = SmpMt::create($request->all());

        return (new SmpMtResource($smpMt))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SmpMt $smpMt)
    {
        abort_if(Gate::denies('smp_mt_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SmpMtResource($smpMt);
    }

    public function update(UpdateSmpMtRequest $request, SmpMt $smpMt)
    {
        $smpMt->update($request->all());

        return (new SmpMtResource($smpMt))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SmpMt $smpMt)
    {
        abort_if(Gate::denies('smp_mt_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $smpMt->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
