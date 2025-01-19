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
            <div class="card-header header-elements">
                <h5 class="mb-0 me-2">Kepada : {{ $dis->kepada }}</h5>
                <div class="card-header-elements">
                    <span class="badge bg-danger rounded-pill">{{ $dis->status->sifat }}</span>
                </div>

                <div class="card-header-elements ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary waves-effect waves-light"
                            data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>
                        <button type="button"
                            class="btn btn-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                            data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <div class="dropdown-menu" style="">
                            <a class="dropdown-item waves-effect" href="javascript:void(0)">Edit</a>
                            <a class="dropdown-item waves-effect" href="javascript:void(0)">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <hr>
                <p class="card-text">{{ $dis->isi }}</p>
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