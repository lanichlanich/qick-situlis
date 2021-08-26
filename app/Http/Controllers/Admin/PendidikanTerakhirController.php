<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPendidikanTerakhirRequest;
use App\Http\Requests\StorePendidikanTerakhirRequest;
use App\Http\Requests\UpdatePendidikanTerakhirRequest;
use App\Models\PendidikanTerakhir;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PendidikanTerakhirController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pendidikan_terakhir_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PendidikanTerakhir::query()->select(sprintf('%s.*', (new PendidikanTerakhir())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pendidikan_terakhir_show';
                $editGate = 'pendidikan_terakhir_edit';
                $deleteGate = 'pendidikan_terakhir_delete';
                $crudRoutePart = 'pendidikan-terakhirs';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('pendidikan_terakhir', function ($row) {
                return $row->pendidikan_terakhir ? $row->pendidikan_terakhir : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.pendidikanTerakhirs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pendidikan_terakhir_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pendidikanTerakhirs.create');
    }

    public function store(StorePendidikanTerakhirRequest $request)
    {
        $pendidikanTerakhir = PendidikanTerakhir::create($request->all());

        return redirect()->route('admin.pendidikan-terakhirs.index');
    }

    public function edit(PendidikanTerakhir $pendidikanTerakhir)
    {
        abort_if(Gate::denies('pendidikan_terakhir_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pendidikanTerakhirs.edit', compact('pendidikanTerakhir'));
    }

    public function update(UpdatePendidikanTerakhirRequest $request, PendidikanTerakhir $pendidikanTerakhir)
    {
        $pendidikanTerakhir->update($request->all());

        return redirect()->route('admin.pendidikan-terakhirs.index');
    }

    public function show(PendidikanTerakhir $pendidikanTerakhir)
    {
        abort_if(Gate::denies('pendidikan_terakhir_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pendidikanTerakhirs.show', compact('pendidikanTerakhir'));
    }

    public function destroy(PendidikanTerakhir $pendidikanTerakhir)
    {
        abort_if(Gate::denies('pendidikan_terakhir_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pendidikanTerakhir->delete();

        return back();
    }

    public function massDestroy(MassDestroyPendidikanTerakhirRequest $request)
    {
        PendidikanTerakhir::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
