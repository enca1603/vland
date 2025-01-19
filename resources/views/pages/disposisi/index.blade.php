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
<div class="row">
    <div class="col-md">
        <div class="card mb-2">
            <div class="card-header d-flex justify-content-between pb-0">
                <div class="card-title">
                    <h5 class="mb-1">{{ $dis->status->sifat }}</h5>
                    <p class="card-subtitle mb-1">Kepada : {{ $dis->kepada }}</p>
                    <p class="card-subtitle">Tenggat Waktu : {{ $dis->tanggal }}</p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button"
                        id="MonthlyCampaign" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti ti-dots-vertical ti-md text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign">
                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Download</a>
                        <a class="dropdown-item" href="javascript:void(0);">View All</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <hr>
                <p>{{ $dis->isi }}</p>
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