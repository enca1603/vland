@extends('layouts.admin',['title' => 'Surat Masuk'])

@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Surat Masuk</h4>
<div class="card">
    <div class="card-header">
        <a href="{{ route('surat.suratkeluar.create') }}" class="btn btn-primary d-inline my-3">Data Baru</a>
    </div>
    <div class="card-datatable table-responsive">
        <table id="datatable" class="table">
            <thead>
                <tr>
                    <th>No. Agenda</th>
                    <th>Tgl. Surat</th>
                    <th>No. Surat</th>
                    <th>Tujuan</th>
                    <th>Prihal</th>
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
            autoWidth: false,
            serverSide: true,
            processing: true,
            ajax:{
                url: "{{ route('surat.suratkeluar.data') }}"
            },
            columns:[
                {data: "no_agenda"},
                {data: "tgl_surat"},
                {data: "no_surat"},
                {data: "tujuan"},
                {data: "prihal"},
                {data: "aksi", name:"aksi", orderable: false, searchable: false},
            ],
        });
    })

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
                    url: "{{ url('/surat/suratkeluar/destroy') }}" + "/" + id,
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
                                table.ajax.reload(null, false);
                            });
                        }
                    }
                }) 
            }
        })
    }
</script>
@endpush