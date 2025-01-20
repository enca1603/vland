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
<div class="card mb-4">
    <div class="card-header pb-0">
        <div class="d-flex justify-content-between flex-column flex-sm-row">
            <div class="card-title">
                <h5 class="text-nowrap mb-0 fw-bold">{{ $dis->kepada }}</h5>
                <small class="text-black">Sifat Surat : {{ $dis->status->sifat }}</small>
            </div>
            <div class="card-title d-flex flex-row">
                <div class="d-inline-block mx-2 text-end text-black">
                    <small class="d-block text-secondary">Tenggat Waktu</small>
                    {{ $dis->getFormatTanggal() }}
                </div>
                <div class="dropdown d-inline-block">
                    <button
                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light"
                        type="button" id="earningReportsId" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ti ti-dots-vertical ti-md text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                        <a class="dropdown-item" href="javascript:void(0);">Print</a>
                        <a class="dropdown-item"
                            href="{{ route('surat.suratmasuk.disposisi.edit', $dis->id) }}">Edit</a>
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="_delete('{{ $dis->id }}')">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <hr>
        <p>{{ $dis->isi }}</p>
        <small class="text-secondary">Catatan: {{ $dis->catatan }}</small>

    </div>
</div>
@endforeach

{!! $disposisi->links() !!}
<!-- / Content -->

@endsection

@push('page-js')
<script>
    function _delete(id){
        const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
        });

        swalWithBootstrapButtons.fire({
                text: 'Apakah kamu yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Data',
                cancelButtonText: 'Batal',
                reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ url('/surat/suratmasuk/disposisi/destroy') }}" + "/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data:{
                        _token: "{{ csrf_token() }}",
                        _method: "POST",
                    },
                    success: function(respon){
                        if(respon.status == 'error'){
                            swalWithBootstrapButtons.fire(
                                'Data kamu tetap aman !',
                                '',
                                'error'
                            )
                        } else if (respon.status == 'success'){
                            swalWithBootstrapButtons.fire(
                                'Berhasil menghapus data',
                                '',
                                'success'
                            ).then(function(){
                                window.location.reload();
                            });
                        }
                    }
                }) 
            }
        })
    }
</script>
@endpush