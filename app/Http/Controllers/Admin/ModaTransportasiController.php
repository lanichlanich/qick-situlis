<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyModaTransportasiRequest;
use App\Http\Requests\StoreModaTransportasiRequest;
use App\Http\Requests\UpdateModaTransportasiRequest;
use App\Models\ModaTransportasi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ModaTransportasiController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('moda_transportasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ModaTransportasi::query()->select(sprintf('%s.*', (new ModaTransportasi())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'moda_transportasi_show';
                $editGate = 'moda_transportasi_edit';
                $deleteGate = 'moda_transportasi_delete';
                $crudRoutePart = 'moda-transportasis';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('moda_transportasi', function ($row) {
                return $row->moda_transportasi ? $row->moda_transportasi : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.modaTransportasis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('moda_transportasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.modaTransportasis.create');
    }

    public function store(StoreModaTransportasiRequest $request)
    {
        $modaTransportasi = ModaTransportasi::create($request->all());

        return redirect()->route('admin.moda-transportasis.index');
    }

    public function edit(ModaTransportasi $modaTransportasi)
    {
        abort_if(Gate::denies('moda_transportasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.modaTransportasis.edit', compact('modaTransportasi'));
    }

    public function update(UpdateModaTransportasiRequest $request, ModaTransportasi $modaTransportasi)
    {
        $modaTransportasi->update($request->all());

        return redirect()->route('admin.moda-transportasis.index');
    }

    public function show(ModaTransportasi $modaTransportasi)
    {
        abort_if(Gate::denies('moda_transportasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.modaTransportasis.show', compact('modaTransportasi'));
    }

    public function destroy(ModaTransportasi $modaTransportasi)
    {
        abort_if(Gate::denies('moda_transportasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modaTransportasi->delete();

        return back();
    }

    public function massDestroy(MassDestroyModaTransportasiRequest $request)
    {
        ModaTransportasi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
