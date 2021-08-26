<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgamaRequest;
use App\Http\Requests\UpdateAgamaRequest;
use App\Http\Resources\Admin\AgamaResource;
use App\Models\Agama;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgamaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('agama_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AgamaResource(Agama::all());
    }

    public function store(StoreAgamaRequest $request)
    {
        $agama = Agama::create($request->all());

        return (new AgamaResource($agama))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Agama $agama)
    {
        abort_if(Gate::denies('agama_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AgamaResource($agama);
    }

    public function update(UpdateAgamaRequest $request, Agama $agama)
    {
        $agama->update($request->all());

        return (new AgamaResource($agama))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Agama $agama)
    {
        abort_if(Gate::denies('agama_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agama->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
