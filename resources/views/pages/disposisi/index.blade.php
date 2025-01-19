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
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h5 class="card-title mb-2">Kepada : <span class="text-bold">{{ $dis->kepada }}</span>
                        <span class="badge bg-danger rounded-pill">{{ $dis->status->sifat }}</span>
                    </h5>
                    <span class="text-muted">Tenggat Waktu</span>
                    <span class="text-muted">{{ $dis->tanggal }}</span>
                </div>


                <div class="btn-group">
                    <button type="button"
                        class="btn btn-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                        data-bs-toggle="dropdown"></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item waves-effect" href="javascript:void(0)">Action</a>
                        <a class="dropdown-item waves-effect" href="javascript:void(0)">Another action</a>
                        <a class="dropdown-item waves-effect" href="javascript:void(0)">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item waves-effect" href="javascript:void(0)">Separated link</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

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