<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDaftarBukuRequest;
use App\Http\Requests\UpdateDaftarBukuRequest;
use App\Http\Resources\Admin\DaftarBukuResource;
use App\Models\DaftarBuku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DaftarBukuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('daftar_buku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarBukuResource(DaftarBuku::all());
    }

    public function store(StoreDaftarBukuRequest $request)
    {
        $daftarBuku = DaftarBuku::create($request->all());

        return (new DaftarBukuResource($daftarBuku))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DaftarBuku $daftarBuku)
    {
        abort_if(Gate::denies('daftar_buku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DaftarBukuResource($daftarBuku);
    }

    public function update(UpdateDaftarBukuRequest $request, DaftarBuku $daftarBuku)
    {
        $daftarBuku->update($request->all());

        return (new DaftarBukuResource($daftarBuku))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DaftarBuku $daftarBuku)
    {
        abort_if(Gate::denies('daftar_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarBuku->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
