@extends('layouts.app')

@section('title', 'Data Pegawai')

@section('content')
    {{-- <h1>Data pegawai!</h1> --}}

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> Data Pegawai </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Data Pegawai</li>
              </ol>
            </div>
          </div>
        </div>
      </div>


    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="box-header with-border">
                    <button onclick="addForm('{{route('pegawai.store')}}')" class="btn btn-success xs btn-flat"><i class="fa fa-plus-circle"></i>Tambah</button>
                </div>


                 <div class="card-body">
                    <div class="box-body table-responsive">
                        {{-- <table class="table table-stiped table-bordered"> --}}
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th width="10%">No</th>
                                <th>Nama Pegawai</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Tanggal Masuk</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
@includeIf('pegawai.form')
@endsection

@push('scripts')

<link rel="stylesheet" href="{{ asset('/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<script src="{{ asset('/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>


<script>


let table;

// Mengatur fungsi DataTables menampilkan dan mengelola data
$(function () {
    table = $('.table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        autoWidth: false,
        
        // fungsi diatur untuk ditangani tambah, edit, hapus dengan AJAX
        ajax: {
            url: '{{ route('pegawai.data') }}',
            type: 'GET'
            // dataSrc: 'data' 
        },

        columns: [
            {data: 'DT_RowIndex', searchable: false, sortable: false},
            {data: 'nama'},
            {data: 'email'},
            {data: 'jabatan'},
            {data: 'tanggalmasuk'},
            {data: 'aksi', searchable: false, sortable: false},
        ]
});

//  // Atur pengiriman form dengan validasi
// Memakai sweetAlert
$('#modal-form').validator().on('submit', function (e) {
    if (!e.preventDefault()) {
        $.ajax({
            url: $('#modal-form form').attr('action'),
            type: $('#modal-form form').attr('method'),
            data: $('#modal-form form').serialize(),
            success: function (response) {
                // Menampilkan pesan sukses dengan SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message || 'Data berhasil disimpan!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();  // Reload tabel DataTables
                    }
                });
            },
            error: function (xhr) {
                // Menangani error validasi dan menampilkan pesan kesalahan
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    // Menampilkan pesan error untuk email duplikat
                    if (xhr.responseJSON.errors.email) {
                        Swal.fire({
                          icon: 'error',
                          title: 'Gagal!',
                          text: 'Email ini sudah terdaftar.',
                    });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan, tidak dapat menyimpan data.',
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan, tidak dapat menyimpan data.',
                    });
                }
            }
        });
    }
});


});


function addForm(url) {
$('#modal-form').modal('show');
$('#modal-form .modal-title').text('Tambah Pegawai');

$('#modal-form form')[0].reset();
$('#modal-form form').attr('action', url);
$('#modal-form [name=_method]').val('post');
$('#modal-form [name=nama]').focus();
}

function editForm(url) {
$('#modal-form').modal('show');
$('#modal-form .modal-title').text('Edit Pegawai');

$('#modal-form form')[0].reset();
$('#modal-form form').attr('action', url);
$('#modal-form [name=_method]').val('put');
$('#modal-form [name=nama]').focus();


$.get(url)
.done((response) => {
    $('#modal-form [name=nama]').val(response.nama);
    $('#modal-form [name=email]').val(response.email);
    $('#modal-form [name=jabatan]').val(response.jabatan);
    $('#modal-form [name=tanggalmasuk]').val(response.tanggalmasuk);
})
.fail((errors) => {
    alert('Tidak dapat menampilkan data');
    return;
});
}

function deleteData(url) {
    Swal.fire({
        title: 'Yakin ingin menghapus data terpilih?',
        text: "Data yang dihapus tidak dapat dikembalikan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil dihapus!',
                });
                table.ajax.reload();
            })
            .fail((errors) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Tidak dapat menghapus data.',
                });
            });
        }
    });
}


$(function () {
        // Inisialisasi Datepicker
        $('#tanggalmasuk').datepicker({
            format: 'yyyy-mm-dd',       // Format tanggal
            autoclose: true,            // Menutup otomatis setelah memilih
            todayHighlight: true,       // Menyorot hari ini
            orientation: 'bottom',      // Posisi dropdown
            endDate: '0d',              // Maksimal tanggal adalah hari ini
        });
    });


</script>

@endpush