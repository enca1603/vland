@extends('layouts.admin',['title' => 'Agenda Surat Masuk'])

@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Surat Masuk</h4>
<div class="card">
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

    $(function(){
        table = $('#datatable').DataTable({
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{ route('agenda.agendamasuk.data') }}"
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
    })

    function detail(id)
    {
        console.log(id);
        
    }
</script>
@endpush