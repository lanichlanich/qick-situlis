<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyKabupatenRequest;
use App\Http\Requests\StoreKabupatenRequest;
use App\Http\Requests\UpdateKabupatenRequest;
use App\Models\Kabupaten;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KabupatenController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('kabupaten_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Kabupaten::query()->select(sprintf('%s.*', (new Kabupaten())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'kabupaten_show';
                $editGate = 'kabupaten_edit';
                $deleteGate = 'kabupaten_delete';
                $crudRoutePart = 'kabupatens';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('kabupaten', function ($row) {
                return $row->kabupaten ? $row->kabupaten : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.kabupatens.index');
    }

    public function create()
    {
        abort_if(Gate::denies('kabupaten_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kabupatens.create');
    }

    public function store(StoreKabupatenRequest $request)
    {
        $kabupaten = Kabupaten::create($request->all());

        return redirect()->route('admin.kabupatens.index');
    }

    public function edit(Kabupaten $kabupaten)
    {
        abort_if(Gate::denies('kabupaten_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kabupatens.edit', compact('kabupaten'));
    }

    public function update(UpdateKabupatenRequest $request, Kabupaten $kabupaten)
    {
        $kabupaten->update($request->all());

        return redirect()->route('admin.kabupatens.index');
    }

    public function show(Kabupaten $kabupaten)
    {
        abort_if(Gate::denies('kabupaten_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kabupatens.show', compact('kabupaten'));
    }

    public function destroy(Kabupaten $kabupaten)
    {
        abort_if(Gate::denies('kabupaten_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kabupaten->delete();

        return back();
    }

    public function massDestroy(MassDestroyKabupatenRequest $request)
    {
        Kabupaten::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
