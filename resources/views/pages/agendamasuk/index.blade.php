@extends('layouts.admin',['title' => 'Agenda Surat Masuk'])



@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Agenda Surat Masuk</h4>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Filter</h5>
        <div class="row">
            <div class="col-md-4 col-12">
                <label for="dt_awal" class="form-label">Tgl. Awal</label>
                <input type="text" id="dt_awal" name="dt_awal" placeholder="MM/DD/YYYY" class="form-control">
            </div>
            <div class="col-md-4 col-12">
                <label for="dt_akhir" class="form-label">Tgl. Akhir</label>
                <input type="text" id="dt_akhir" name="dt_akhir" placeholder="MM/DD/YYYY" class="form-control">
            </div>
            <div class="col-md-4 col-12 pt-6">
                <button id="btnFilter" class="btn btn-primary">Filter</button>
                <button id="btnReset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </div>
    <hr>
    <div class="card-datatable table-responsive">
        <table id="datatable" class="table">
            <thead>
                <tr>
                    <th>No. Agenda</th>
                    <th>Tgl. Surat</th>
                    <th>No. Surat</th>
                    <th>Asal Surat</th>
                    <th>Lampiran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- / Content -->
@endsection

@push('page-js')
<script>
    var table;
    var awal, akhir;
    $(function(){
        table = $('#datatable').DataTable({
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{ route('agenda.agendamasuk.data') }}",
                data: function(d){
                    d.awal = awal;
                    d.akhir = akhir;
                }
            },
            columns:[
                {data: "no_agenda"},
                {data: "tgl_surat"},
                {data: "no_surat"},
                {data: "pengirim"},
                {data: 'lampiran'},
                {data: "aksi", name:"aksi", orderable: false, searchable: false},
            ],
            autoWidth: false,
        });

        $('#dt_awal, #dt_akhir').datepicker();
    })

    $('#dt_awal, #dt_akhir').on('change', function(){
        awal = $('#dt_awal').val();
        akhir = $('#dt_akhir').val();
    })

    $('#btnfilter').on('click', function(){
        table.draw();
    });

</script>
@endpush