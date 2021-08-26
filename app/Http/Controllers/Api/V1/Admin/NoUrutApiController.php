<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoUrutRequest;
use App\Http\Requests\UpdateNoUrutRequest;
use App\Http\Resources\Admin\NoUrutResource;
use App\Models\NoUrut;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoUrutApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('no_urut_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NoUrutResource(NoUrut::all());
    }

    public function store(StoreNoUrutRequest $request)
    {
        $noUrut = NoUrut::create($request->all());

        return (new NoUrutResource($noUrut))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(NoUrut $noUrut)
    {
        abort_if(Gate::denies('no_urut_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NoUrutResource($noUrut);
    }

    public function update(UpdateNoUrutRequest $request, NoUrut $noUrut)
    {
        $noUrut->update($request->all());

        return (new NoUrutResource($noUrut))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(NoUrut $noUrut)
    {
        abort_if(Gate::denies('no_urut_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $noUrut->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
