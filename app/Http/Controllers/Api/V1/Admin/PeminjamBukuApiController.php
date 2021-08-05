<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePeminjamBukuRequest;
use App\Http\Requests\UpdatePeminjamBukuRequest;
use App\Http\Resources\Admin\PeminjamBukuResource;
use App\Models\PeminjamBuku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PeminjamBukuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('peminjam_buku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PeminjamBukuResource(PeminjamBuku::all());
    }

    public function store(StorePeminjamBukuRequest $request)
    {
        $peminjamBuku = PeminjamBuku::create($request->all());

        return (new PeminjamBukuResource($peminjamBuku))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PeminjamBuku $peminjamBuku)
    {
        abort_if(Gate::denies('peminjam_buku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PeminjamBukuResource($peminjamBuku);
    }

    public function update(UpdatePeminjamBukuRequest $request, PeminjamBuku $peminjamBuku)
    {
        $peminjamBuku->update($request->all());

        return (new PeminjamBukuResource($peminjamBuku))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PeminjamBuku $peminjamBuku)
    {
        abort_if(Gate::denies('peminjam_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $peminjamBuku->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
