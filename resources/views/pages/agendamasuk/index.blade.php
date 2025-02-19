@extends('layouts.admin',['title' => 'Agenda Surat Masuk'])

@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Agenda Surat Masuk</h4>
<div class="card">
    <div class="card-header">
        <div class="row">
            <label for="filer" class="col-md-2 col-form-label">Saring Tanggal Surat</label>
            <div class="col-md-4">
                <input class="form-control" type="text" id="filer" name="filter">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" id="_btnFilter">Filter</button>
                <button class="btn btn-primary" id="_btnClear">Clear</button>
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

        $('input[name="filter"]').daterangepicker({
            opens: 'left',
            locale: {
                format: 'DD-MM-YYYY'
            }
        }, function(start, end, label) {
            awal = start.format('DD-MM-YYYY');
            akhir = end.format('DD-MM-YYYY');
        });
    })

    $('#_btnFilter').on('click', function(){
        // console.log(awal + ' s.d. ' + akhir);
        table.draw();
    });

    $('#_btnClear').on('click', function(){
        $('input[name="filter"]').daterangepicker()
        table.ajax.reload();
    });
</script>
@endpush