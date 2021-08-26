<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAgamaRequest;
use App\Http\Requests\StoreAgamaRequest;
use App\Http\Requests\UpdateAgamaRequest;
use App\Models\Agama;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgamaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('agama_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Agama::query()->select(sprintf('%s.*', (new Agama())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'agama_show';
                $editGate = 'agama_edit';
                $deleteGate = 'agama_delete';
                $crudRoutePart = 'agamas';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('agama', function ($row) {
                return $row->agama ? $row->agama : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.agamas.index');
    }

    public function create()
    {
        abort_if(Gate::denies('agama_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agamas.create');
    }

    public function store(StoreAgamaRequest $request)
    {
        $agama = Agama::create($request->all());

        return redirect()->route('admin.agamas.index');
    }

    public function edit(Agama $agama)
    {
        abort_if(Gate::denies('agama_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agamas.edit', compact('agama'));
    }

    public function update(UpdateAgamaRequest $request, Agama $agama)
    {
        $agama->update($request->all());

        return redirect()->route('admin.agamas.index');
    }

    public function show(Agama $agama)
    {
        abort_if(Gate::denies('agama_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agamas.show', compact('agama'));
    }

    public function destroy(Agama $agama)
    {
        abort_if(Gate::denies('agama_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agama->delete();

        return back();
    }

    public function massDestroy(MassDestroyAgamaRequest $request)
    {
        Agama::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
