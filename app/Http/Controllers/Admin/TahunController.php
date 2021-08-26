<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTahunRequest;
use App\Http\Requests\StoreTahunRequest;
use App\Http\Requests\UpdateTahunRequest;
use App\Models\Tahun;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TahunController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tahun_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Tahun::query()->select(sprintf('%s.*', (new Tahun())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tahun_show';
                $editGate = 'tahun_edit';
                $deleteGate = 'tahun_delete';
                $crudRoutePart = 'tahuns';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('tahun', function ($row) {
                return $row->tahun ? $row->tahun : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.tahuns.index');
    }

    public function create()
    {
        abort_if(Gate::denies('tahun_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tahuns.create');
    }

    public function store(StoreTahunRequest $request)
    {
        $tahun = Tahun::create($request->all());

        return redirect()->route('admin.tahuns.index');
    }

    public function edit(Tahun $tahun)
    {
        abort_if(Gate::denies('tahun_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tahuns.edit', compact('tahun'));
    }

    public function update(UpdateTahunRequest $request, Tahun $tahun)
    {
        $tahun->update($request->all());

        return redirect()->route('admin.tahuns.index');
    }

    public function show(Tahun $tahun)
    {
        abort_if(Gate::denies('tahun_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tahuns.show', compact('tahun'));
    }

    public function destroy(Tahun $tahun)
    {
        abort_if(Gate::denies('tahun_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tahun->delete();

        return back();
    }

    public function massDestroy(MassDestroyTahunRequest $request)
    {
        Tahun::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
