@extends('layouts.admin',['title' => 'Disposisi'])

@section('content')
<!-- Content -->

{{-- <h4 class="py-4 mb-6">Disposisi</h4> --}}
<div>
    <div class="d-flex justify-content-between flex-column flex-sm-row">
        <h4 class="fw-bold py-3 mb-2">
            Surat Disposisi
        </h4>
        <div class="py-3">
            <a type="button" href="{{ route('surat.suratmasuk.disposisi.create', $suratMasuk->id) }}"
                class="btn btn-primary">Tambah Baru</a>
            <a type="button" href="{{ route('surat.suratmasuk.index') }}" class="btn btn-danger">Kembali</a>
        </div>
    </div>
    <div class="alert alert-primary" role="alert">Disposi Surat Nomor : <strong>{{ $suratMasuk->no_surat }}</strong>
    </div>
</div>

@foreach ($disposisi as $dis)
<div class="row mb-2">
    <div class="col-md">
        <div class="card mb-6">
            <div class="card-header header-elements">
                <h5 class="mb-0 me-2">Card Header</h5>
                <div class="card-header-elements">
                    <span class="badge bg-danger rounded-pill">Hello!</span>
                </div>
                <div class="card-header-elements ms-auto">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-danger waves-effect waves-light"><i
                                class="fa fa-trash"></i></button>
                        <button type="button" class="btn btn-success waves-effect waves-light"><i
                                class="fa fa-pencil"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kepada :</th>
                            <th>Tenggat Waktu :</th>
                            <th>Sifat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $dis->kepada }}</td>
                            <td>{{ $dis->tanggal }}</td>
                            <td>{{ $dis->status->sifat }}</td>
                        </tr>
                        <tr>
                            <th>Isi Disposisi</th>
                            <td colspan="2">{{ $dis->isi }}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td colspan="2">{{ $dis->catatan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- / Content -->

@endsection

@push('page-js')
<script>

</script>
@endpush