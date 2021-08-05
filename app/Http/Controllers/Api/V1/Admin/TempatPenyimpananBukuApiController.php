<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTempatPenyimpananBukuRequest;
use App\Http\Requests\UpdateTempatPenyimpananBukuRequest;
use App\Http\Resources\Admin\TempatPenyimpananBukuResource;
use App\Models\TempatPenyimpananBuku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TempatPenyimpananBukuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tempat_penyimpanan_buku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TempatPenyimpananBukuResource(TempatPenyimpananBuku::all());
    }

    public function store(StoreTempatPenyimpananBukuRequest $request)
    {
        $tempatPenyimpananBuku = TempatPenyimpananBuku::create($request->all());

        return (new TempatPenyimpananBukuResource($tempatPenyimpananBuku))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TempatPenyimpananBuku $tempatPenyimpananBuku)
    {
        abort_if(Gate::denies('tempat_penyimpanan_buku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TempatPenyimpananBukuResource($tempatPenyimpananBuku);
    }

    public function update(UpdateTempatPenyimpananBukuRequest $request, TempatPenyimpananBuku $tempatPenyimpananBuku)
    {
        $tempatPenyimpananBuku->update($request->all());

        return (new TempatPenyimpananBukuResource($tempatPenyimpananBuku))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TempatPenyimpananBuku $tempatPenyimpananBuku)
    {
        abort_if(Gate::denies('tempat_penyimpanan_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tempatPenyimpananBuku->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
