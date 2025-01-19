@extends('layouts.admin',['title' => 'Klasifikasi'])

@section('content')
<!-- Content -->

<h4 class="py-4 mb-6">Klasifikasi</h4>
<div class="card">
  <div class="card-header">
    <button id="btnNew" class="btn btn-primary d-inline">Add New</button>
    <button id="btnReload" class="btn btn-info d-inline">Reload</button>
  </div>
  <div class="card-body table-responsive">
    <table id="datatable" class="table">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama Klasifikasi</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

<!-- / Content -->

{{-- Modal --}}
<div class="modal fade" id="addNewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Data Klasifikasi</h4>
        </div>
        <div class="row g-6">
          <input type="hidden" id="id" name="id">
          <div class="col-12">
            <label class="form-label w-100" for="kode">Kode Klasifikasi</label>
            <div class="input-group input-group-merge">
              <input id="kode" name="kode" class="form-control kode_invalid" type="text" />
            </div>
          </div>

          <div class="col-12">
            <label class="form-label w-100" for="nama">Nama</label>
            <div class="input-group input-group-merge">
              <input id="nama" name="nama" class="form-control kode_invalid" type="text" />
            </div>
          </div>
          <div class="col-12">
            <label class="form-label w-100" for="keterangan">Keterangan</label>
            <div class="input-group input-group-merge">
              <input id="keterangan" name="keterangan" class="form-control" type="text" />
            </div>
          </div>

          <div class="col-12 text-center">
            <button type="button" id="btnSimpan" class="btn btn-primary me-3">Simpan</button>
            <button type="button" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
{{-- End Modal --}}
@endsection

@push('page-js')
<script>
  var table;
  var modal = $('#addNewModal');
  var mode;

  $(function(){
      table = $('#datatable').DataTable({
        serverSide: true,
        ajax: {
          url: "{{ route('klasifikasi.data') }}"
        },
        columns: [
          {data:'kode'},
          {data:'nama'},
          {data:'keterangan'},
          {data:'aksi', orderable: false, searchable: false},
        ],
        language: {
            sLengthMenu: 'Tampil _MENU_',
            search: '',
            searchPlaceholder: 'Cari Klasifikasi',
            paginate: {
                next: '<i class="ti ti-chevron-right ti-sm"></i>',
                previous: '<i class="ti ti-chevron-left ti-sm"></i>'
            },
        },
        buttons:[
            {
                
            },
        ],
      });
  });

  function edit(id){
    $.ajax({
        url: "{{ url('/klasifikasi/edit') }}" + "/" + id,
        type: 'GET',
        dataType: 'JSON',
        success:function(respon){
            clearErrorMsg();
            moda='edit';
            $('#id').val(respon.id);
            $('#kode').val(respon.kode);
            $('#nama').val(respon.nama);
            $('#keterangan').val(respon.keterangan);
            modal.modal('show');
        }
      })
  }

  $('#btnNew').on('click', function(){
    mode = "create";
    modal.modal('show');
  });

  $('#btnReload').on('click', function(){
    // window.location.reload()
    // $("#categoryTable").load(window.location + " #categoryTable");
    $("#datatable").load(location.href+" #datatable>*","");
  });

  $('#btnSimpan').on('click', function(){
    let uri, method;
    let id = $('#id').val();

    if(mode=="create"){
      uri = "{{ route('klasifikasi.store') }}";
      method = "POST";
    } else {
      uri = "{{ url('/klasifikasi/update') }}" + "/" + id;
      method = "PUT";
    }

    $.ajax({
      url:uri,
      type: "POST",
      dataType: "JSON",
      data:{
        _token: "{{ csrf_token() }}",
        _method: method,
        id: id,
        kode: $('#kode').val(),
        nama: $('#nama').val(),
        keterangan: $('#keterangan').val(),
      },
      success: function(respon){
        console.log(respon);
        if(respon.status == 'error'){
          clearErrorMsg();
          getErrorMsg();

          Toast.fire({
            icon: 'error',
            text: 'Terjadi kesalahan..'
          });
        }

        if(respon.status == 'success'){
          Toast.fire({
            icon: 'success',
            text: respon.msg
          }).then(function(){
            table.ajax.reload();
            clearErrorMsg();
            modal.modal('hide');
          });
        }
      }
    });

  });
</script>
@endpush