<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyNoUrutRequest;
use App\Http\Requests\StoreNoUrutRequest;
use App\Http\Requests\UpdateNoUrutRequest;
use App\Models\NoUrut;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NoUrutController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('no_urut_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NoUrut::query()->select(sprintf('%s.*', (new NoUrut())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'no_urut_show';
                $editGate = 'no_urut_edit';
                $deleteGate = 'no_urut_delete';
                $crudRoutePart = 'no-uruts';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('no', function ($row) {
                return $row->no ? $row->no : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.noUruts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('no_urut_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.noUruts.create');
    }

    public function store(StoreNoUrutRequest $request)
    {
        $noUrut = NoUrut::create($request->all());

        return redirect()->route('admin.no-uruts.index');
    }

    public function edit(NoUrut $noUrut)
    {
        abort_if(Gate::denies('no_urut_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.noUruts.edit', compact('noUrut'));
    }

    public function update(UpdateNoUrutRequest $request, NoUrut $noUrut)
    {
        $noUrut->update($request->all());

        return redirect()->route('admin.no-uruts.index');
    }

    public function show(NoUrut $noUrut)
    {
        abort_if(Gate::denies('no_urut_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.noUruts.show', compact('noUrut'));
    }

    public function destroy(NoUrut $noUrut)
    {
        abort_if(Gate::denies('no_urut_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $noUrut->delete();

        return back();
    }

    public function massDestroy(MassDestroyNoUrutRequest $request)
    {
        NoUrut::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
