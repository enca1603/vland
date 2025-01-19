@extends('layouts.admin',['title' => 'Surat Masuk'])

@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Surat Masuk</h4>
<div class="card">
    <div class="card-body">
        <form action="{{ route('surat.suratkeluar.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row g-6">
                <div class="col-md-4">
                    <x-vinput label="No. Agenda" name="no_agenda"></x-vinput>
                </div>
                <div class="col-md-4">
                    <x-vinput label="No. Surat" name="no_surat"></x-vinput>
                </div>
                <div class="col-md-4">
                    <x-vinput label="Tgl. Surat" name="tgl_surat"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Tujuan Surat" name="tujuan"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Prihal Surat" name="prihal"></x-vinput>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="isi_surat">Ringkasan Isi Surat</label>
                    <textarea class="form-control @error('isi_surat') is-invalid @enderror" name="isi_surat"
                        id="isi_surat" cols="30" rows="3"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="isi_surat">Klasifikasi</label>
                    <select name="klasifikasi_id" id="klasifikasi_id"
                        class="form-select @error('klasifikasi_id') is-invalid @enderror">
                        <option value="">-- Pilih Klasifikasi --</option>
                        @foreach ($klasifikasi as $klas)
                        <option value="{{ $klas->id }}">{{ $klas->kode .' | '.$klas->nama }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{ $errors->first('klasifikasi_id') }}</div>
                </div>
                <div class="col-md-6">
                    <label for="lampiran" class="form-label">File Lampiran Surat</label>
                    <input class="form-control" type="file" id="lampiran" name="lampiran">
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

</script>
@endpush