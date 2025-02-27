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
        if ($request->ajax()) {
            if (!empty($request->awal)) {
                $data = SuratMasuk::with('klasifikasi')
                    ->whereBetween('tgl_surat', [Carbon::createFromFormat('d-m-Y', $request->awal)->format('Y-m-d'), Carbon::createFromFormat('d-m-Y', $request->akhir)->format('Y-m-d')])
                    ->get();
            } else {
                $data = SuratMasuk::with('klasifikasi')->get();
            }

            return DataTables::of($data)
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

    public function print(Request $request)
    {
        if ($request->filled('awal') && $request->filled('akhir')) {
            $data = SuratMasuk::with('klasifikasi')
                ->whereBetween('tgl_surat', [Carbon::createFromFormat('d-m-Y', $request->awal)->format('Y-m-d'), Carbon::createFromFormat('d-m-Y', $request->akhir)->format('Y-m-d')])
                ->get();
        } else {
            $data = SuratMasuk::with('klasifikasi')->get();
        }

        return view('pages.suratmasuk.cetak', compact('data'));
    }

    public function cetakpertanggal($awal = '', $akhir = '')
    {
        // if ($awal && $akhir) {
        //     $data = SuratMasuk::with('klasifikasi')
        //         ->whereBetween('tgl_surat', [Carbon::createFromFormat('d-m-Y', $awal)->format('Y-m-d'), Carbon::createFromFormat('d-m-Y', $akhir)->format('Y-m-d')])
        //         ->get();
        // } else {
        //     $data = SuratMasuk::with('klasifikasi')->get();
        // }




        $data = SuratMasuk::with('klasifikasi')->get();
        if ($awal = '' or $awal = '') {
        }

        return $data;
    }
}
