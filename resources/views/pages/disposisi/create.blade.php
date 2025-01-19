@extends('layouts.admin',['title' => 'Surat Masuk'])

@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Surat Masuk</h4>
<div class="card">
    <div class="card-body">
        <div class="alert alert-success" role="alert">Disposisi Surat Nomor : <strong> {{ $surat->no_surat }}</strong>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('surat.suratmasuk.disposisi.store', $surat) }}" method="post">
            @csrf
            <div class="row g-6">
                <div class="col-md-6">
                    <x-vinput label="Kepada" name="kepada"></x-vinput>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Tenggat Waktu" name="tanggal"></x-vinput>
                </div>

                <div class="col-md-12">
                    <label class="form-label" for="isi">Isi Disposisi</label>
                    <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="isi" cols="30"
                        rows="3"></textarea>
                </div>
                <div class="col-md-6">
                    <x-vinput label="Catatan" name="catatan"></x-vinput>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="isi_surat">Sifat Surat</label>
                    <select name="sifat_id" id="sifat_id" class="form-select @error('sifat_id') is-invalid @enderror">
                        <option value="">-- Pilih Sifat --</option>
                        @foreach ($sifat as $s)
                        <option value="{{ $s->id }}">{{ $s->sifat }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">{{ $errors->first('sifat_id') }}</div>
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
    $('#tanggal').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
</script>
@endpush