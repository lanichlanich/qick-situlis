<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPeminjamBukuRequest;
use App\Http\Requests\StorePeminjamBukuRequest;
use App\Http\Requests\UpdatePeminjamBukuRequest;
use App\Models\PeminjamBuku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PeminjamBukuController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('peminjam_buku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PeminjamBuku::query()->select(sprintf('%s.*', (new PeminjamBuku())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'peminjam_buku_show';
                $editGate = 'peminjam_buku_edit';
                $deleteGate = 'peminjam_buku_delete';
                $crudRoutePart = 'peminjam-bukus';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('nama_peminjam', function ($row) {
                return $row->nama_peminjam ? $row->nama_peminjam : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.peminjamBukus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('peminjam_buku_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.peminjamBukus.create');
    }

    public function store(StorePeminjamBukuRequest $request)
    {
        $peminjamBuku = PeminjamBuku::create($request->all());

        return redirect()->route('admin.peminjam-bukus.index');
    }

    public function edit(PeminjamBuku $peminjamBuku)
    {
        abort_if(Gate::denies('peminjam_buku_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.peminjamBukus.edit', compact('peminjamBuku'));
    }

    public function update(UpdatePeminjamBukuRequest $request, PeminjamBuku $peminjamBuku)
    {
        $peminjamBuku->update($request->all());

        return redirect()->route('admin.peminjam-bukus.index');
    }

    public function show(PeminjamBuku $peminjamBuku)
    {
        abort_if(Gate::denies('peminjam_buku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.peminjamBukus.show', compact('peminjamBuku'));
    }

    public function destroy(PeminjamBuku $peminjamBuku)
    {
        abort_if(Gate::denies('peminjam_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $peminjamBuku->delete();

        return back();
    }

    public function massDestroy(MassDestroyPeminjamBukuRequest $request)
    {
        PeminjamBuku::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
