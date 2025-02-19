<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class AgendaMasukController extends Controller
{
    public function index()
    {
        return view('pages.agendamasuk.index');
    }

    public function data(Request $request)
    {
        // $dAwal = Carbon::createFromFormat('d-m-Y', $request->awal)->format('Y-m-d');
        // $dAkhir = Carbon::createFromFormat('d-m-Y', $request->akhir)->format('Y-m-d');

        if ($request->ajax()) {
            $datas = SuratMasuk::with('klasifikasi')->get();
            if ($request->filled('awal') && $request->filled('akhir')) {
                $datas = SuratMasuk::with('klasifikasi')
                    ->whereBetween('tgl_surat', [Carbon::createFromFormat('d-m-Y', $request->awal)->format('Y-m-d'), Carbon::createFromFormat('d-m-Y', $request->akhir)->format('Y-m-d')]);
            }

            return DataTables::of($datas)
                ->addColumn('tgl_surat', function ($row) {
                    return Carbon::parse($row->tgl_surat)->format('d-m-Y');
                })
                ->addColumn('tgl_terima', function ($row) {
                    return Carbon::parse($row->tgl_terima)->format('d-m-Y');
                })
                ->addColumn('lampiran', function ($row) {
                    if ($row->lampiran) {
                        return '
                    <button type="button" class="btn btn-sm btn-info" onclick="lihat(' . "'" . asset('app/incoming/' . $row->lampiran) . "'" . ')">Lihat</button>
                    ';
                    } else {
                        return '<span class="text-sm">No File</span>';
                    }
                })
                ->addColumn('aksi', function ($row) {
                    return '
                    <a  type="button" class="btn btn-sm btn-info" href="' . route('surat.suratmasuk.detail', $row->id) . '">Detail</a>
                    ';
                })
                ->rawColumns(['lampiran', 'aksi'])
                ->make(true);
        }
    }
}
