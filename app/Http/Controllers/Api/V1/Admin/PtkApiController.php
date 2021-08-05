<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePtkRequest;
use App\Http\Requests\UpdatePtkRequest;
use App\Http\Resources\Admin\PtkResource;
use App\Models\Ptk;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PtkApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ptk_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PtkResource(Ptk::all());
    }

    public function store(StorePtkRequest $request)
    {
        $ptk = Ptk::create($request->all());

        return (new PtkResource($ptk))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ptk $ptk)
    {
        abort_if(Gate::denies('ptk_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PtkResource($ptk);
    }

    public function update(UpdatePtkRequest $request, Ptk $ptk)
    {
        $ptk->update($request->all());

        return (new PtkResource($ptk))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ptk $ptk)
    {
        abort_if(Gate::denies('ptk_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ptk->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
