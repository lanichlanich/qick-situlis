<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPangkatGolonganRequest;
use App\Http\Requests\StorePangkatGolonganRequest;
use App\Http\Requests\UpdatePangkatGolonganRequest;
use App\Models\PangkatGolongan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PangkatGolonganController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pangkat_golongan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PangkatGolongan::query()->select(sprintf('%s.*', (new PangkatGolongan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pangkat_golongan_show';
                $editGate = 'pangkat_golongan_edit';
                $deleteGate = 'pangkat_golongan_delete';
                $crudRoutePart = 'pangkat-golongans';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('pangkat', function ($row) {
                return $row->pangkat ? $row->pangkat : '';
            });
            $table->editColumn('golongan', function ($row) {
                return $row->golongan ? $row->golongan : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.pangkatGolongans.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pangkat_golongan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pangkatGolongans.create');
    }

    public function store(StorePangkatGolonganRequest $request)
    {
        $pangkatGolongan = PangkatGolongan::create($request->all());

        return redirect()->route('admin.pangkat-golongans.index');
    }

    public function edit(PangkatGolongan $pangkatGolongan)
    {
        abort_if(Gate::denies('pangkat_golongan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pangkatGolongans.edit', compact('pangkatGolongan'));
    }

    public function update(UpdatePangkatGolonganRequest $request, PangkatGolongan $pangkatGolongan)
    {
        $pangkatGolongan->update($request->all());

        return redirect()->route('admin.pangkat-golongans.index');
    }

    public function show(PangkatGolongan $pangkatGolongan)
    {
        abort_if(Gate::denies('pangkat_golongan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pangkatGolongans.show', compact('pangkatGolongan'));
    }

    public function destroy(PangkatGolongan $pangkatGolongan)
    {
        abort_if(Gate::denies('pangkat_golongan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pangkatGolongan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPangkatGolonganRequest $request)
    {
        PangkatGolongan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
