@extends('layouts.admin', ['title' => 'Detail Surat Masuk'])
@section('content')
<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center fw-bold">DETAIL SURAT MASUK</td>
                        </tr>
                        <tr>
                            <td>Dari</td>
                            <td> {{ $data->pengirim }}</td>
                            <td>Tgl Diterima:</td>
                            <td> {{ $data->tgl_terima }}</td>
                        </tr>
                        <tr>
                            <td>No. Surat</td>
                            <td> {{ $data->no_surat }}</td>
                            <td>No. Agenda:</td>
                            <td> {{ $data->no_agenda }}</td>
                        </tr>
                        <tr>
                            <td>Tgl.Surat</td>
                            <td> {{ $data->tgl_surat }}</td>
                            <td>Prihal</td>
                            <td colspan="3">{{ $data->prihal }}</td>
                        </tr>

                        <tr>
                            <td>Isi Surat</td>
                            <td colspan="3"> {{ $data->isi_surat }}</td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td colspan="3">{{ $data->lampiran }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md">
                        <div class="">
                            <a type="button" class="btn btn-primary"
                                href="{{ route('surat.suratmasuk.index') }}">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection