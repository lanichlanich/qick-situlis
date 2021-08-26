<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDesaRequest;
use App\Http\Requests\StoreDesaRequest;
use App\Http\Requests\UpdateDesaRequest;
use App\Models\Desa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DesaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('desa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Desa::query()->select(sprintf('%s.*', (new Desa())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'desa_show';
                $editGate = 'desa_edit';
                $deleteGate = 'desa_delete';
                $crudRoutePart = 'desas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('desa', function ($row) {
                return $row->desa ? $row->desa : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.desas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('desa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.desas.create');
    }

    public function store(StoreDesaRequest $request)
    {
        $desa = Desa::create($request->all());

        return redirect()->route('admin.desas.index');
    }

    public function edit(Desa $desa)
    {
        abort_if(Gate::denies('desa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.desas.edit', compact('desa'));
    }

    public function update(UpdateDesaRequest $request, Desa $desa)
    {
        $desa->update($request->all());

        return redirect()->route('admin.desas.index');
    }

    public function show(Desa $desa)
    {
        abort_if(Gate::denies('desa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.desas.show', compact('desa'));
    }

    public function destroy(Desa $desa)
    {
        abort_if(Gate::denies('desa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $desa->delete();

        return back();
    }

    public function massDestroy(MassDestroyDesaRequest $request)
    {
        Desa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
