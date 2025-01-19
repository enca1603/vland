<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class SuratKeluarController extends Controller
{
    public function index()
    {
        return view('pages.suratkeluar.index');
    }

    public function create()
    {
        $klasifikasi = Klasifikasi::all();
        return view('pages.suratkeluar.create', compact('klasifikasi'));
    }

    public function edit(string $id)
    {
        $klasifikasi = Klasifikasi::all();
        $data = SuratKeluar::whereId($id)->first();

        return view('pages.suratkeluar.edit', compact('klasifikasi', 'data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_agenda' => 'required',
            'no_surat' => 'required|unique:surat_keluar,no_surat',
            'klasifikasi_id' => 'required',
            'lampiran' => 'file|mimes:png,jpg,jpeg,pdf|max:1000'
        ], [
            'required' => 'wajib di isi',
            'unique' => 'harus unik',
            'lampiran.mimes' => 'file tidak di dukung',
            'lampiran.max' => 'ukuran maks. 1000 KB'
        ]);

        try {
            $store = new SuratKeluar();
            $store->no_agenda = $request->no_agenda;
            $store->no_surat = $request->no_surat;
            $store->tujuan = $request->tujuan;
            $store->prihal = $request->prihal;
            $store->tgl_surat = Carbon::createFromFormat('d-m-Y', $request->tgl_surat)->format('Y-m-d');
            $store->isi_surat = $request->isi_surat;
            $store->klasifikasi_id = $request->klasifikasi_id;
            $store->user_id = Auth::user()->id;

            if ($request->hasFile('lampiran')) {
                $xfile = $request->file('lampiran');
                $ext = $xfile->getClientOriginalExtension();
                $filename = 'out_' . time() . '_' . $xfile->getClientOriginalName();
                $filename = str_replace(' ', '_', $filename);
                $xfile->move(public_path('app/outgoing'), $filename);
                $store->lampiran = $filename;
            }
            $store->save();
            return redirect()->route('surat.suratkeluar.index')->with('success', 'Data berhasil di simpan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_agenda' => 'required',
            'no_surat' => 'required|unique:surat_keluar,no_surat,' . $id,
            'klasifikasi_id' => 'required',
            'lampiran' => 'file|mimes:png,jpg,jpeg,pdf|max:1000'
        ], [
            'required' => 'wajib di isi',
            'unique' => 'harus unik',
            'lampiran.mimes' => 'file tidak di dukung',
            'lampiran.max' => 'ukuran maks. 1000 KB'
        ]);
        // dd($request->all());
        try {
            $store = SuratKeluar::where('id', $id)->first();
            $store->no_agenda = $request->no_agenda;
            $store->no_surat = $request->no_surat;
            $store->tujuan = $request->tujuan;
            $store->prihal = $request->prihal;
            $store->tgl_surat = Carbon::createFromFormat('d-m-Y', $request->tgl_surat)->format('Y-m-d');
            $store->isi_surat = $request->isi_surat;
            $store->klasifikasi_id = $request->klasifikasi_id;
            $store->user_id = Auth::user()->id;

            if ($request->hasFile('lampiran')) {
                if ($request->old_lampiran) {
                    File::delete(public_path('app/outgoing/' . $request->old_lampiran));
                }
                $xfile = $request->file('lampiran');
                $ext = $xfile->getClientOriginalExtension();
                $filename = 'OU_' . time() . '_' . $xfile->getClientOriginalName();
                $filename = str_replace(' ', '_', $filename);
                $xfile->move(public_path('app/outgoing'), $filename);
                $store->lampiran = $filename;
            }
            $store->save();
            return redirect()->route('surat.suratkeluar.index')->with('success', 'Data berhasil di simpan');
        } catch (\Throwable $th) {
            // return back()->with('error', $th->getMessage());
            dd($th->getMessage());
        }
    }

    public function hapus_lampiran(string $id)
    {
        $data = SuratKeluar::where('id', $id)
            ->first();
        try {
            File::delete(public_path('app/outgoing/' . $data->lampiran));
            $data->lampiran = null;
            $data->save();
            return response()->json(['status' => 'success', 'msg' => '']);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $data = SuratKeluar::where('id', $id)
            ->first();

        $status = $data->delete();
        if ($status) {
            File::delete(public_path('app/outgoing/' . $data->lampiran));
            return response()->json(['status' => 'success', 'msg' => '']);
        } else {
            return response()->json(['status' => 'error', 'msg' => '']);
        }
    }

    public function data()
    {
        $datas = SuratKeluar::with('klasifikasi');

        return DataTables::of($datas)
            ->addColumn('tgl_surat', function ($row) {
                return Carbon::parse($row->tgl_surat)->format('d-m-Y');
            })
            ->addColumn('lampiran', function ($row) {
                if ($row->lampiran) {
                    return '
                        <button type="button" class="btn btn-sm btn-info" onclick="lihat(' . "'" . asset('/app/outgoing/' . $row->lampiran) . "'" . ')">Lihat</button>
                    ';
                } else {
                    return '<span class="text-sm">No File</span>';
                }
            })
            ->addColumn('aksi', function ($row) {
                return '
                    <a type="button" class="btn btn-sm btn-success" href="' . route('surat.suratkeluar.edit', $row->id) . '">Edit</a>
                    <a type="button" class="btn btn-sm btn-danger" href="#" onclick="_delete(' . "'" . $row->id . "'" . ')">Hapus</a>
                ';
            })
            ->rawColumns(['lampiran', 'aksi'])
            ->make(true);
    }
}
