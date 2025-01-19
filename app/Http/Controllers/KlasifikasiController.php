<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KlasifikasiController extends Controller
{
    public function index()
    {
        return view('pages.klasifikasi');
    }

    public function store(Request $request)
    {
        $vld = Validator::make($request->all(), [
            'kode' => 'required|unique:klasifikasi,kode',
            'nama' => 'required'
        ]);

        if ($vld->fails()) {
            return response()->json(['status' => 'error', 'msg' => $vld->getMessageBag()->toArray()]);
        } else {
            $klasifikasi = new Klasifikasi();
            $klasifikasi->kode = $request->kode;
            $klasifikasi->nama = $request->nama;
            $klasifikasi->keterangan = $request->keterangan;
            $klasifikasi->save();
            return response()->json(['status' => 'success', 'msg' => 'Data sukses di simpan']);
        }
    }

    public function edit(string $id)
    {
        $klasifikasi = Klasifikasi::whereId($id)->first();
        return $klasifikasi;
    }

    public function update(Request $request, string $id)
    {
        $vld = Validator::make($request->all(), [
            'kode' => 'required|unique:klasifikasi,kode,' . $id,
            'nama' => 'required'
        ]);

        if ($vld->fails()) {
            return response()->json(['status' => 'error', 'msg' => $vld->getMessageBag()->toArray()]);
        } else {
            $klasifikasi = Klasifikasi::whereId($id)->first();
            $klasifikasi->kode = $request->kode;
            $klasifikasi->nama = $request->nama;
            $klasifikasi->keterangan = $request->keterangan;
            $klasifikasi->save();
            return response()->json(['status' => 'success', 'msg' => 'Data sukses di simpan']);
        }
    }

    public function data()
    {
        $datas = Klasifikasi::all();

        return DataTables::of($datas)
            ->addColumn('aksi', function ($row) {
                return '
                    <button type="button" id="btnEdit" class="btn btn-success btn-sm me-3" onclick="edit(' . $row->id . ')">Edit</button>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
