<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBahasaRequest;
use App\Http\Requests\UpdateBahasaRequest;
use App\Http\Resources\Admin\BahasaResource;
use App\Models\Bahasa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BahasaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bahasa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BahasaResource(Bahasa::all());
    }

    public function store(StoreBahasaRequest $request)
    {
        $bahasa = Bahasa::create($request->all());

        return (new BahasaResource($bahasa))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bahasa $bahasa)
    {
        abort_if(Gate::denies('bahasa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BahasaResource($bahasa);
    }

    public function update(UpdateBahasaRequest $request, Bahasa $bahasa)
    {
        $bahasa->update($request->all());

        return (new BahasaResource($bahasa))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bahasa $bahasa)
    {
        abort_if(Gate::denies('bahasa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bahasa->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
