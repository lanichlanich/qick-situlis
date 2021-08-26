<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRombonganBelajarRequest;
use App\Http\Requests\UpdateRombonganBelajarRequest;
use App\Http\Resources\Admin\RombonganBelajarResource;
use App\Models\RombonganBelajar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RombonganBelajarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rombongan_belajar_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RombonganBelajarResource(RombonganBelajar::all());
    }

    public function store(StoreRombonganBelajarRequest $request)
    {
        $rombonganBelajar = RombonganBelajar::create($request->all());

        return (new RombonganBelajarResource($rombonganBelajar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RombonganBelajar $rombonganBelajar)
    {
        abort_if(Gate::denies('rombongan_belajar_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RombonganBelajarResource($rombonganBelajar);
    }

    public function update(UpdateRombonganBelajarRequest $request, RombonganBelajar $rombonganBelajar)
    {
        $rombonganBelajar->update($request->all());

        return (new RombonganBelajarResource($rombonganBelajar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RombonganBelajar $rombonganBelajar)
    {
        abort_if(Gate::denies('rombongan_belajar_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rombonganBelajar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
