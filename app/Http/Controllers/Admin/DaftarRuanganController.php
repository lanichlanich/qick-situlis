<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDaftarRuanganRequest;
use App\Http\Requests\StoreDaftarRuanganRequest;
use App\Http\Requests\UpdateDaftarRuanganRequest;
use App\Models\DaftarRuangan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DaftarRuanganController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('daftar_ruangan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DaftarRuangan::query()->select(sprintf('%s.*', (new DaftarRuangan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'daftar_ruangan_show';
                $editGate = 'daftar_ruangan_edit';
                $deleteGate = 'daftar_ruangan_delete';
                $crudRoutePart = 'daftar-ruangans';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('nama_ruangan', function ($row) {
                return $row->nama_ruangan ? $row->nama_ruangan : '';
            });
            $table->editColumn('kondisi_ruangan', function ($row) {
                return $row->kondisi_ruangan ? DaftarRuangan::KONDISI_RUANGAN_RADIO[$row->kondisi_ruangan] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.daftarRuangans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('daftar_ruangan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.daftarRuangans.create');
    }

    public function store(StoreDaftarRuanganRequest $request)
    {
        $daftarRuangan = DaftarRuangan::create($request->all());

        return redirect()->route('admin.daftar-ruangans.index');
    }

    public function edit(DaftarRuangan $daftarRuangan)
    {
        abort_if(Gate::denies('daftar_ruangan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.daftarRuangans.edit', compact('daftarRuangan'));
    }

    public function update(UpdateDaftarRuanganRequest $request, DaftarRuangan $daftarRuangan)
    {
        $daftarRuangan->update($request->all());

        return redirect()->route('admin.daftar-ruangans.index');
    }

    public function show(DaftarRuangan $daftarRuangan)
    {
        abort_if(Gate::denies('daftar_ruangan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.daftarRuangans.show', compact('daftarRuangan'));
    }

    public function destroy(DaftarRuangan $daftarRuangan)
    {
        abort_if(Gate::denies('daftar_ruangan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daftarRuangan->delete();

        return back();
    }

    public function massDestroy(MassDestroyDaftarRuanganRequest $request)
    {
        DaftarRuangan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
