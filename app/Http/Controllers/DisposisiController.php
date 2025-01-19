<?php

namespace App\Http\Controllers;

use App\Models\Sifat;
use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\returnSelf;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SuratMasuk $suratMasuk)
    {
        
        $disposisi = Disposisi::with('status')
        ->where('suratmasuk_id', $suratMasuk->id)
        ->get();
        
        // foreach ($disposisi as $dis){
        //     return $dis->status->sifat;
        // }

        return view('pages.disposisi.index', compact('suratMasuk','disposisi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SuratMasuk $suratMasuk)
    {
        // dd($id);
        $sifat = Sifat::all();
        $surat = $suratMasuk;

        return view('pages.disposisi.create', compact('sifat','surat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SuratMasuk $suratMasuk)
    {
        $request->validate([
            'kepada' => 'required',
            'tanggal' => 'required',
            'isi' => 'required',
            'sifat_id' => 'required'
        ]);

        try {
            $disp = new Disposisi();
            $disp->kepada = $request->kepada;
            $disp->tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');
            $disp->isi = $request->isi;
            $disp->catatan = $request->catatan;
            $disp->suratmasuk_id = $suratMasuk->id;
            $disp->sifat_id = $request->sifat_id;
            $disp->save();
            return redirect()->route('surat.suratmasuk.disposisi.index', $suratMasuk->id)->with('success', 'Data berhasil di simpan');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
