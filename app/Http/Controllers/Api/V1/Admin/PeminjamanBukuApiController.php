<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePeminjamanBukuRequest;
use App\Http\Requests\UpdatePeminjamanBukuRequest;
use App\Http\Resources\Admin\PeminjamanBukuResource;
use App\Models\PeminjamanBuku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PeminjamanBukuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('peminjaman_buku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PeminjamanBukuResource(PeminjamanBuku::with(['peminjam_buku', 'nama_buku', 'tempat_penyimpanan_buku'])->get());
    }

    public function store(StorePeminjamanBukuRequest $request)
    {
        $peminjamanBuku = PeminjamanBuku::create($request->all());

        return (new PeminjamanBukuResource($peminjamanBuku))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PeminjamanBuku $peminjamanBuku)
    {
        abort_if(Gate::denies('peminjaman_buku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PeminjamanBukuResource($peminjamanBuku->load(['peminjam_buku', 'nama_buku', 'tempat_penyimpanan_buku']));
    }

    public function update(UpdatePeminjamanBukuRequest $request, PeminjamanBuku $peminjamanBuku)
    {
        $peminjamanBuku->update($request->all());

        return (new PeminjamanBukuResource($peminjamanBuku))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PeminjamanBuku $peminjamanBuku)
    {
        abort_if(Gate::denies('peminjaman_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $peminjamanBuku->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
