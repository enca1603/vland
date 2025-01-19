@extends('layouts.admin',['title' => 'Surat Keluar'])

@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Surat Keluar</h4>
<div class="card">
    <div class="card-body">
        <form action="{{ route('surat.suratkeluar.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-6">
                <div class="col-md-4">
                    <x-vinput label="No. Agenda" name="no_agenda" value="{{ $data->no_agenda }}"></x-vinput>
                </div>
                <div class="col-md-4">
                    <x-vinput label="No. Surat" name="no_surat" value="{{ $data->no_surat }}"></x-vinput>
                </div>
                <div class="col-md-4">
                    <x-vinput label="Tgl. Surat" name="tgl_surat" value="{{ $data->tgl_surat }}"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Tujuan Surat" name="tujuan" value="{{ $data->tujuan }}"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Prihal Surat" name="prihal" value="{{ $data->prihal }}"></x-vinput>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="isi_surat">Ringkasan Isi Surat</label>
                    <textarea class="form-control @error('isi_surat') is-invalid @enderror" name="isi_surat"
                        id="isi_surat" cols="30" rows="6">{{ $data->isi_surat }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="isi_surat">Klasifikasi</label>
                    <select name="klasifikasi_id" id="klasifikasi_id"
                        class="form-select @error('klasifikasi_id') is-invalid @enderror">
                        <option value="">-- Pilih Klasifikasi --</option>
                        @foreach ($klasifikasi as $klas)
                        <option value="{{ $klas->id }}" {{ $klas->id = $data->klasifikasi_id ? "selected" : "" }}>{{
                            $klas->kode .' | '.$klas->nama }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{ $errors->first('klasifikasi_id') }}</div>
                </div>

                <div class="col-md-6">
                    <label for="lampiran" class="form-label">File Lampiran Surat</label>
                    <input class="form-control mb-3" type="file" id="lampiran" name="lampiran">
                    @if ($data->lampiran)
                    <button type="button" class="btn btn-sm btn-info" onclick="lihat('{{ $data->lampiran }}')">Lihat
                        Lampiran</button>
                    <button type="button" class="btn btn-sm btn-danger"
                        onclick="hapus_lampiran('{{ $data->id }}')">Hapus
                        Lampiran</button>
                    @endif
                </div>
            </div>
            <div class="pt-6">
                <button type="submit" class="btn btn-primary me-4 waves-effect waves-light">Simpan</button>
                <a href="{{ route('surat.suratkeluar.index') }}" class="btn btn-danger d-inline mb-3">Batal</a>

            </div>
        </form>
    </div>
</div>

<!-- / Content -->
@endsection

@push('page-js')
<script>
    $('#tgl_surat').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });

    $('#tgl_terima').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });

    function lihat(file)
    {
        url = "{{ asset('app/outgoing') }}" + "/" + file
        window.open(url,"Buka Lampiran",'height=600,width=800');
        if (window.focus) {window.focus()}
        return false;
    }

    function hapus_lampiran(id)
    {
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
                    url: "{{ url('/surat/suratkeluar/hapus_lampiran') }}" + "/" + id,
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