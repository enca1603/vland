@extends('layouts.admin', ['title' => 'Detail Surat Masuk'])
@section('content')
<table class="table table-bordered">
    <tbody>
        <tr>
            <td colspan="4" class="text-center fw-bold">LEMBAR DISPOSISI</td>
        </tr>
        <tr>
            <td>Dari</td>
            <td> {{ $data->surat_masuk->pengirim }}</td>
            <td>Tgl Diterima:</td>
            <td> {{ $data->surat_masuk->tgl_terima }}</td>
        </tr>
        <tr>
            <td>No. Surat</td>
            <td> {{ $data->surat_masuk->no_surat }}</td>
            <td>No. Agenda:</td>
            <td> {{ $data->surat_masuk->no_agenda }}</td>
        </tr>
        <tr>
            <td>Tgl.Surat</td>
            <td> {{ $data->surat_masuk->tgl_surat }}</td>
            <td>Sifat</td>
            <td> {{ $data->status->sifat }}</td>
        </tr>
        <tr>
            <td>Prihal</td>
            <td colspan="3">{{ $data->surat_masuk->prihal }}</td>
        </tr>
        <tr>
            <td>Diteruskan Kepada</td>
            <td colspan="3"> {{ $data->kepada }}</td>
        </tr>
        <tr>
            <th>isi Disposisi</th>
            <td colspan="3">{{ $data->isi }}</td>
        </tr>
        <tr>
            <td>Catatan</td>
            <td colspan="3">{{ $data->catatan }}</td>
        </tr>
    </tbody>
</table>
@endsection