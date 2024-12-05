<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" data-toggle="validator">
    <div class="modal-dialog" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama" class="col-md-3 control-label">Nama Pegawai</label>
                        <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama" required autofocus>
                        </div>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jabatan" class="col-md-3 control-label">Jabatan</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-briefcase"></i>
                                    </span>
                                </div>
                                <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Masukkan jabatan" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggalmasuk" class="col-md-3 control-label">Tanggal Masuk</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                <input type="text" name="tanggalmasuk" id="tanggalmasuk" class="form-control datepicker" placeholder="Pilih tanggal" required>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- <!-- Script untuk menginisialisasi Datepicker -->
<script src="{{ asset('/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
// <script src="{{ asset('/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
// 

    $(document).ready(function() {
        $('#tanggal_lahir').datepicker({
            dateFormat: 'yy-mm-dd', // Format tanggal (contoh: 2024-12-05)
            changeMonth: true, // Memungkinkan perubahan bulan
            changeYear: true, // Memungkinkan perubahan tahun
            yearRange: '1900:2024', // Rentang tahun yang diperbolehkan
            maxDate: '0', // Membatasi tanggal hanya sampai hari ini
        });
    });
</script> --}}
{{-- 
<!-- Tambahkan CSS untuk Datepicker -->
<link rel="stylesheet" href="{{ asset('/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

<!-- Tambahkan JS untuk Datepicker -->
<script src="{{ asset('/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#tanggal_lahir').datepicker({
            format: 'yyyy-mm-dd', // Format tanggal
            autoclose: true, // Menutup kalender setelah memilih
            todayHighlight: true, // Menyorot hari ini
            orientation: 'bottom', // Posisi dropdown
            endDate: '0d', // Membatasi tanggal hanya sampai hari ini
        });
    });
</script> --}}
