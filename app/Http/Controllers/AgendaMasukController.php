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

    public function detail($id)
    {
        $masuks = SuratMasuk::with('klasifikasi')->where('id', $id)->first();
        return $masuks;
    }

    public function data()
    {
        $datas = SuratMasuk::with('klasifikasi')->get();

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
                    <a  type="button" class="btn btn-sm btn-info" href="' . route('agenda.agendamasuk.detail', $row->id) . '">Detail</a>
                    ';
            })
            ->rawColumns(['lampiran', 'aksi'])
            ->make(true);
    }
}
