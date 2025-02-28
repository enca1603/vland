@extends('layouts.admin',['title' => 'Agenda Surat Masuk'])



@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Agenda Surat Masuk</h4>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Filter</h5>
        <form action="{{ route('agenda.agendamasuk.pdf') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-3 col-12 mb-2">
                    <label for="dt_awal" class="form-label">Tgl. Awal</label>
                    <input type="text" id="dt_awal" name="dt_awal" placeholder="dd-mm-yyyy" autocomplete="off"
                        class="form-control input_filter_tgl">
                </div>
                <div class="col-md-3 col-12 mb-2">
                    <label for="dt_akhir" class="form-label">Tgl. Akhir</label>
                    <input type="text" id="dt_akhir" name="dt_akhir" placeholder="dd-mm-yyyy" autocomplete="off"
                        class="form-control input_filter_tgl">
                </div>
                <div class="col-md-6 col-12 pt-6 mb-0">
                    <button id="btnFilter" class="btn btn-primary" onclick="event.preventDefault()">Filter</button>
                    <button id="btnReset" class="btn btn-danger" onclick="event.preventDefault()">Reset</button>
                    <a href="#" target="_blank">
                        <button id="btnPdf" class="btn btn-info"><i class="fa fa-file-pdf me-2"></i>PDF</button>
                    </a>
                </div>
            </div>
        </form>
    </div>

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
        $('.input_filter_tgl').datepicker({
            todayBtn: 'linked',
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        load_data();
    });

    function load_data(star_date = '', end_date = '')
    {
        table = $('#datatable').DataTable({
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{ route('agenda.agendamasuk.data') }}",
                data: function(d){
                    d.awal = star_date;
                    d.akhir = end_date;
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
    }

    $('#btnFilter').on('click', function(){
        awal = $('#dt_awal').val();
        akhir = $('#dt_akhir').val();

        if(awal != '' && akhir != '')
        {
            table.destroy();
            load_data(awal, akhir);
        } else {
            alert('Warning : Tanggal filter kosong')
        }
    });

    $('#btnReset').on('click', function(){
        $('#dt_awal').val('');
        $('#dt_akhir').val('');
        table.destroy();
        load_data();
    });

    $('#btnPdfX').on('click', function(){
        awal = $('#dt_awal').val();
        akhir = $('#dt_akhir').val();

        $.ajax({
            url: "{{ route('agenda.agendamasuk.pdf') }}",
            type:"GET",
            dataType: "JSON",
            data:{
                _method: "GET",
                awal: awal,
                akhir: akhir
            },
            success: function(respon){
                console.log(respon);
            }
        })
    })
</script>
@endpush