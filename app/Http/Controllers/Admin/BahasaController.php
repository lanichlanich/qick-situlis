<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBahasaRequest;
use App\Http\Requests\StoreBahasaRequest;
use App\Http\Requests\UpdateBahasaRequest;
use App\Models\Bahasa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BahasaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bahasa_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Bahasa::query()->select(sprintf('%s.*', (new Bahasa())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bahasa_show';
                $editGate = 'bahasa_edit';
                $deleteGate = 'bahasa_delete';
                $crudRoutePart = 'bahasas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('bahasa', function ($row) {
                return $row->bahasa ? $row->bahasa : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.bahasas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bahasa_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bahasas.create');
    }

    public function store(StoreBahasaRequest $request)
    {
        $bahasa = Bahasa::create($request->all());

        return redirect()->route('admin.bahasas.index');
    }

    public function edit(Bahasa $bahasa)
    {
        abort_if(Gate::denies('bahasa_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bahasas.edit', compact('bahasa'));
    }

    public function update(UpdateBahasaRequest $request, Bahasa $bahasa)
    {
        $bahasa->update($request->all());

        return redirect()->route('admin.bahasas.index');
    }

    public function show(Bahasa $bahasa)
    {
        abort_if(Gate::denies('bahasa_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bahasas.show', compact('bahasa'));
    }

    public function destroy(Bahasa $bahasa)
    {
        abort_if(Gate::denies('bahasa_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bahasa->delete();

        return back();
    }

    public function massDestroy(MassDestroyBahasaRequest $request)
    {
        Bahasa::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
