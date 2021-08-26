<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePangkatGolonganRequest;
use App\Http\Requests\UpdatePangkatGolonganRequest;
use App\Http\Resources\Admin\PangkatGolonganResource;
use App\Models\PangkatGolongan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PangkatGolonganApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pangkat_golongan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PangkatGolonganResource(PangkatGolongan::all());
    }

    public function store(StorePangkatGolonganRequest $request)
    {
        $pangkatGolongan = PangkatGolongan::create($request->all());

        return (new PangkatGolonganResource($pangkatGolongan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PangkatGolongan $pangkatGolongan)
    {
        abort_if(Gate::denies('pangkat_golongan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PangkatGolonganResource($pangkatGolongan);
    }

    public function update(UpdatePangkatGolonganRequest $request, PangkatGolongan $pangkatGolongan)
    {
        $pangkatGolongan->update($request->all());

        return (new PangkatGolonganResource($pangkatGolongan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PangkatGolongan $pangkatGolongan)
    {
        abort_if(Gate::denies('pangkat_golongan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pangkatGolongan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
