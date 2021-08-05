<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDaftarBukuRequest;
use App\Http\Requests\StoreDaftarBukuRequest;
use App\Http\Requests\UpdateDaftarBukuRequest;
use App\Models\DaftarBuku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DaftarBukuController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('daftar_buku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DaftarBuku::query()->select(sprintf('%s.*', (new DaftarBuku())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'daftar_buku_show';
                $editGate = 'daftar_buku_edit';
                $deleteGate = 'daftar_buku_delete';
                $crudRoutePart = 'daftar-bukus';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nama_buku', function ($row) {
                return $row->nama_buku ? $row->nama_buku : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.daftarBukus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('daftar_buku_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.daftarBukus.create');
    }

    public function store(StoreDaftarBukuRequest $request)
    {
        $daftarBuku = DaftarBuku::create($request->all());

        return redirect()->route('admin.daftar-bukus.index');
    }

    public function edit(DaftarBuku $daftarBuku)
    {
        abort_if(Gate::denies('daftar_buku_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.daftarBukus.edit', compact('daftarBuku'));
    }

    public function update(UpdateDaftarBukuRequest $request, DaftarBuku $daftarBuku)
    {
        $daftarBuku->update($request->all());

        return redirect()->route('admin.daftar-bukus.index');
    }

    public function show(DaftarBuku $daftarBuku)
    {
        abort_if(Gate::denies('daftar_buku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.daftarBukus.show', compact('daftarBuku'));
    }

    public function destroy(DaftarBuku $daftarBuku)
    {
        abort_if(Gate::denies('daftar_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarBuku->delete();

        return back();
    }

    public function massDestroy(MassDestroyDaftarBukuRequest $request)
    {
        DaftarBuku::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
