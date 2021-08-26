<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTahunAjaranRequest;
use App\Http\Requests\StoreTahunAjaranRequest;
use App\Http\Requests\UpdateTahunAjaranRequest;
use App\Models\TahunAjaran;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TahunAjaranController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tahun_ajaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TahunAjaran::query()->select(sprintf('%s.*', (new TahunAjaran())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tahun_ajaran_show';
                $editGate = 'tahun_ajaran_edit';
                $deleteGate = 'tahun_ajaran_delete';
                $crudRoutePart = 'tahun-ajarans';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('tahun_ajaran', function ($row) {
                return $row->tahun_ajaran ? $row->tahun_ajaran : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.tahunAjarans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tahun_ajaran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tahunAjarans.create');
    }

    public function store(StoreTahunAjaranRequest $request)
    {
        $tahunAjaran = TahunAjaran::create($request->all());

        return redirect()->route('admin.tahun-ajarans.index');
    }

    public function edit(TahunAjaran $tahunAjaran)
    {
        abort_if(Gate::denies('tahun_ajaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tahunAjarans.edit', compact('tahunAjaran'));
    }

    public function update(UpdateTahunAjaranRequest $request, TahunAjaran $tahunAjaran)
    {
        $tahunAjaran->update($request->all());

        return redirect()->route('admin.tahun-ajarans.index');
    }

    public function show(TahunAjaran $tahunAjaran)
    {
        abort_if(Gate::denies('tahun_ajaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tahunAjarans.show', compact('tahunAjaran'));
    }

    public function destroy(TahunAjaran $tahunAjaran)
    {
        abort_if(Gate::denies('tahun_ajaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahunAjaran->delete();

        return back();
    }

    public function massDestroy(MassDestroyTahunAjaranRequest $request)
    {
        TahunAjaran::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
