<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTempatPenyimpananBukuRequest;
use App\Http\Requests\StoreTempatPenyimpananBukuRequest;
use App\Http\Requests\UpdateTempatPenyimpananBukuRequest;
use App\Models\TempatPenyimpananBuku;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TempatPenyimpananBukuController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('tempat_penyimpanan_buku_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TempatPenyimpananBuku::query()->select(sprintf('%s.*', (new TempatPenyimpananBuku())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tempat_penyimpanan_buku_show';
                $editGate = 'tempat_penyimpanan_buku_edit';
                $deleteGate = 'tempat_penyimpanan_buku_delete';
                $crudRoutePart = 'tempat-penyimpanan-bukus';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('nama_tempat_penyimpaanan', function ($row) {
                return $row->nama_tempat_penyimpaanan ? $row->nama_tempat_penyimpaanan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.tempatPenyimpananBukus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tempat_penyimpanan_buku_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tempatPenyimpananBukus.create');
    }

    public function store(StoreTempatPenyimpananBukuRequest $request)
    {
        $tempatPenyimpananBuku = TempatPenyimpananBuku::create($request->all());

        return redirect()->route('admin.tempat-penyimpanan-bukus.index');
    }

    public function edit(TempatPenyimpananBuku $tempatPenyimpananBuku)
    {
        abort_if(Gate::denies('tempat_penyimpanan_buku_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tempatPenyimpananBukus.edit', compact('tempatPenyimpananBuku'));
    }

    public function update(UpdateTempatPenyimpananBukuRequest $request, TempatPenyimpananBuku $tempatPenyimpananBuku)
    {
        $tempatPenyimpananBuku->update($request->all());

        return redirect()->route('admin.tempat-penyimpanan-bukus.index');
    }

    public function show(TempatPenyimpananBuku $tempatPenyimpananBuku)
    {
        abort_if(Gate::denies('tempat_penyimpanan_buku_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tempatPenyimpananBukus.show', compact('tempatPenyimpananBuku'));
    }

    public function destroy(TempatPenyimpananBuku $tempatPenyimpananBuku)
    {
        abort_if(Gate::denies('tempat_penyimpanan_buku_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tempatPenyimpananBuku->delete();

        return back();
    }

    public function massDestroy(MassDestroyTempatPenyimpananBukuRequest $request)
    {
        TempatPenyimpananBuku::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
