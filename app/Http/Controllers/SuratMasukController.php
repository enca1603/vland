<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Klasifikasi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class SuratMasukController extends Controller
{
    public function index()
    {
        return view('pages.suratmasuk.index');
    }

    public function create()
    {
        $klasifikasi = Klasifikasi::all();

        return view('pages.suratmasuk.create', compact('klasifikasi'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'no_agenda' => 'required',
            'no_surat' => 'required',
            'tgl_surat' => 'required',
            'tgl_terima' => 'required',
            'pengirim' => 'required',
            'prihal' => 'required',
            'isi_surat' => 'required',
            'klasifikasi_id' => 'required',
            'lampiran' => 'file|mimes:png,jpg,jpeg,pdf|max:1000'
        ]);

        try {
            $sm = new SuratMasuk();
            $sm->no_agenda = $request->no_agenda;
            $sm->no_surat = $request->no_surat;
            $sm->pengirim = $request->pengirim;
            $sm->tgl_surat = Carbon::createFromFormat('d-m-Y', $request->tgl_surat)->format('Y-m-d');
            $sm->tgl_terima = Carbon::createFromFormat('d-m-Y', $request->tgl_terima)->format('Y-m-d');
            $sm->prihal = $request->prihal;
            $sm->isi_surat = $request->isi_surat;
            $sm->klasifikasi_id = $request->klasifikasi_id;
            $sm->user_id = Auth::user()->id;
            if ($request->file('lampiran')) {
                $xfile = $request->file('lampiran');
                $ext = $xfile->getClientOriginalExtension();
                $filename = 'inc_' . time() . '_' . $xfile->getClientOriginalName();
                $filename = str_replace(' ', '_', $filename);
                $xfile->move(public_path('app/incoming'), $filename);
                $sm->lampiran = $filename;
            }
            $sm->save();
            return redirect()->route('surat.suratmasuk.index')->with('success', 'Berhasil menyimpan data.');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        $masuk = SuratMasuk::with('klasifikasi')
            ->where('id', $id)->first();
        $klasifikasi = Klasifikasi::orderBy('kode', 'Asc')->get();

        return view('pages.suratmasuk.edit', compact('masuk', 'klasifikasi'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'no_agenda' => 'required',
            'no_surat' => 'required',
            'tgl_surat' => 'required',
            'tgl_terima' => 'required',
            'pengirim' => 'required',
            'prihal' => 'required',
            'isi_surat' => 'required',
            'klasifikasi_id' => 'required',
            'lampiran' => 'file|mimes:png,jpg,jpeg,pdf|max:1000'
        ], [
            'required' => 'Harus di isi.'
        ]);

        try {
            $sm = SuratMasuk::where('id', $id)->first();
            $sm->no_agenda = $request->no_agenda;
            $sm->no_surat = $request->no_surat;
            $sm->pengirim = $request->pengirim;
            $sm->tgl_surat = Carbon::createFromFormat('d-m-Y', $request->tgl_surat)->format('Y-m-d');
            $sm->tgl_terima = Carbon::createFromFormat('d-m-Y', $request->tgl_terima)->format('Y-m-d');
            $sm->prihal = $request->prihal;
            $sm->isi_surat = $request->isi_surat;
            $sm->klasifikasi_id = $request->klasifikasi_id;

            if ($request->file('lampiran')) {
                if ($request->old_lampiran) {
                    File::delete(public_path('app/incoming/' . $request->old_lampiran));
                }
                $xfile = $request->file('lampiran');
                $ext = $xfile->getClientOriginalExtension();
                $filename = 'IN_' . time() . '_' . $xfile->getClientOriginalName();
                $filename = str_replace(' ', '_', $filename);
                $xfile->move(public_path('app/incoming'), $filename);
                $sm->lampiran = $filename;
            }
            $sm->save();
            return redirect()->route('surat.suratmasuk.index')->with('success', 'Berhasil menyimpan data.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $data = SuratMasuk::where('id', $id)
            ->first();

        $proses = $data->delete();
        // dd($data);
        if ($proses) {
            File::delete(public_path('app/incoming/' . $data->lampiran));
            return response()->json(['status' => 'success', 'msg' => '']);
        } else {
            return response()->json(['status' => 'error', 'msg' => '']);
        }
    }
    public function hapus_lamp(string $id)
    {
        $data = SuratMasuk::where('id', $id)
            ->first();
        try {
            File::delete(public_path('app/incoming/' . $data->lampiran));
            $data->lampiran = null;
            $data->save();
            return response()->json(['status' => 'success', 'msg' => '']);
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'msg' => $e->getMessage()]);
        }
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
                $disp = Disposisi::where('suratmasuk_id', $row->id)->count();

                return '
                    <a type="button" class="btn btn-sm btn-primary" href="' . route('surat.suratmasuk.disposisi.index', $row->id) . '">Disposisi
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1_5 pt-50">' . $disp . '</span>
                    </a>
                    <button type="button" class="btn btn-label-primary dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                        Aksi
                    </button>

                    <ul class="dropdown-menu" style="">
                        <li><a class="dropdown-item waves-effect" href="' . route('surat.suratmasuk.edit', $row->id) . '">Edit</a></li>
                        <li><a class="dropdown-item waves-effect" href="javascript:void(0);" onclick="_delete(' . "'" . $row->id . "'" . ')">Hapus</a></li>
                    </ul>
                ';

                // return '
                //     <a type="button" class="btn btn-sm btn-primary" href="' . route('surat.suratmasuk.disposisi.index', $row->id) . '">Disposisi
                //         <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1_5 pt-50">'.$disp.'</span>
                //     </a>
                //     <a type="button" class="btn btn-sm btn-success" href="' . route('surat.suratmasuk.edit', $row->id) . '">Edit</a>
                //     <a type="button" class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="_delete(' . "'" . $row->id . "'" . ')">Hapus</a>
                // ';
            })
            ->rawColumns(['lampiran', 'aksi'])
            ->make(true);
    }
}
