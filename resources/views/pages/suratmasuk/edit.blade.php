@extends('layouts.admin',['title' => 'Surat Masuk'])

@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Surat Masuk</h4>
<div class="card">

    <div class="card-body">
        <form action="{{ route('surat.suratmasuk.update', $masuk->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-6">
                <div class="col-md-6">
                    <x-vinput label="No. Agenda" name="no_agenda" value="{{ $masuk->no_agenda }}"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="No. Surat" name="no_surat" value="{{ $masuk->no_surat }}"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Tgl. Surat" name="tgl_surat"
                        value="{{ \Carbon\Carbon::parse($masuk->tgl_surat)->format('d-m-Y') }}"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Tgl. Terima Surat" name="tgl_terima"
                        value="{{ \Carbon\Carbon::parse($masuk->tgl_terima)->format('d-m-Y') }}"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Pengirim" name="pengirim" value="{{ $masuk->pengirim }}"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Prihal Surat" name="prihal" value="{{ $masuk->prihal }}"></x-vinput>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="isi_surat">Ringkasan Isi Surat</label>
                    <textarea class="form-control @error('isi_surat') is-invalid @enderror" name="isi_surat"
                        id="isi_surat" cols="30" rows="3">{{ $masuk->isi_surat }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="isi_surat">Klasifikasi</label>
                    <select name="klasifikasi_id" id="klasifikasi_id"
                        class="form-select @error('klasifikasi_id') is-invalid @enderror">
                        <option value="">-- Pilih Klasifikasi --</option>
                        @foreach ($klasifikasi as $klas)
                        <option value="{{ $klas->id }}" {{ $masuk->klasifikasi_id = $klas->id ? "selected" : "" }} >
                            {{ $klas->kode .' | '.$klas->nama }}
                        </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{ $errors->first('klasifikasi_id') }}</div>
                </div>
                <div class="col-md-6">
                    <label for="lampiran" class="form-label">File Lampiran Surat</label>
                    <input class="form-control mb-3" type="file" id="lampiran" name="lampiran">
                    @if ($masuk->lampiran)
                    <button type="button" class="btn btn-sm btn-info" onclick="lihat('{{ $masuk->lampiran }}')">Lihat
                        Lampiran</button>
                    <button type="button" class="btn btn-sm btn-danger"
                        onclick="hapus_lampiran('{{ $masuk->id }}')">Hapus
                        Lampiran</button>
                    @endif
                </div>
            </div>
            <div class="pt-6">
                <button type="submit" class="btn btn-primary me-4 waves-effect waves-light">Submit</button>
                <a type="button" href="{{ route('surat.suratmasuk.index') }}"
                    class="btn btn-danger me-4 waves-effect waves-light">Kembali</a>
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
        url = "{{ asset('app/incoming') }}" + "/" + file
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
                title: 'Apakah kamu yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Data',
                cancelButtonText: 'Batal',
                reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ url('/surat/suratmasuk/hapus_lamp') }}" + "/" + id,
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