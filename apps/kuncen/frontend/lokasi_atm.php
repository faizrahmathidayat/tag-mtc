 <div class="container-fluid">
    <h1 class="mt-4">LOKASI ATM</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Lokasi ATM</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Data Lokasi ATM
        </div>
        <div class="card-body">
            <button class="btn btn-sm btn-primary" style="margin-bottom:10px;" onclick="tambah_lokasi_atm()">Tambah Lokasi ATM</button>
            <div class="table-responsive" id="data_lokasi_atm">
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH lokasi_atm-->
<div class="modal fade" id="modal_tambah_lokasi_atm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi ATM</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="form-tambah-lokasi_atm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="small mb-1" for="nam_lokasi_atm">Sektor</label>
                        <div id="list_sektor"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="small mb-1" for="nam_lokasi_atm">ID</label>
                        <input type="text" name="kode_lokasi_atm" class="form-control" id="kode_lokasi_atm" placeholder="ID">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="small mb-1" for="nam_lokasi_atm">Lokasi ATM</label>
                        <input type="text" name="nama_lokasi_atm" class="form-control" id="nama_lokasi_atm" placeholder="Lokasi ATM">
                    </div>
                </div>
            <hr>
            <div class="alert alert-info" role="alert">
              Masukan Jumlah Kunci
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Fascia Atas</label>
                    <input type="text" name="kunci_fascia_atas" class="form-control" id="kunci_fascia_atas" placeholder="Fascia Atas">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Fascia Bawah</label>
                    <input type="text" name="kunci_fascia_bawah" class="form-control" id="kunci_fascia_bawah" placeholder="Fascia Bawah">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Tombak</label>
                    <input type="text" name="kunci_tombak" class="form-control" id="kunci_tombak" placeholder="Tombak">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Kombinasi</label>
                    <input type="text" name="kunci_kombinasi" class="form-control" id="kunci_kombinasi" placeholder="Kombinasi">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Casing/Both</label>
                    <input type="text" name="kunci_casing_both" class="form-control" id="kunci_casing_both" placeholder="Casing or Both">
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <button class="btn btn-primary" type="button" onclick="simpan_lokasi_atm()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<!-- END MODAL TAMBAH lokasi_atm -->

<!-- MODAL UBAH lokasi_atm-->
<div class="modal fade" id="modal_ubah_lokasi_atm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Lokasi ATM</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="form-ubah-lokasi_atm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="small mb-1" for="nam_lokasi_atm">Sektor</label>
                        <div id="edit_list_sektor"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="small mb-1" for="nam_lokasi_atm">ID</label>
                        <input type="text" name="edit_kode_lokasi_atm" class="form-control" id="edit_kode_lokasi_atm" placeholder="ID">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="small mb-1" for="nam_lokasi_atm">Lokasi ATM</label>
                        <input type="text" name="edit_nama_lokasi_atm" class="form-control" id="edit_nama_lokasi_atm" placeholder="Lokasi ATM">
                    </div>
                </div>
            <hr>
            <div class="alert alert-info" role="alert">
              Masukan Jumlah Kunci
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Fascia Atas</label>
                    <input type="text" name="edit_kunci_fascia_atas" class="form-control" id="edit_kunci_fascia_atas" placeholder="Fascia Atas">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Fascia Bawah</label>
                    <input type="text" name="edit_kunci_fascia_bawah" class="form-control" id="edit_kunci_fascia_bawah" placeholder="Fascia Bawah">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Tombak</label>
                    <input type="text" name="edit_kunci_tombak" class="form-control" id="edit_kunci_tombak" placeholder="Tombak">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Kombinasi</label>
                    <input type="text" name="edit_kunci_kombinasi" class="form-control" id="edit_kunci_kombinasi" placeholder="Kombinasi">
                </div>
                <div class="form-group col-md-6">
                    <label class="small mb-1" for="nam_lokasi_atm">Casing/Both</label>
                    <input type="text" name="edit_kunci_casing_both" class="form-control" id="edit_kunci_casing_both" placeholder="Casing or Both">
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer" id="button_edit_lokasi_atm">
        </div>
      </div>
    </div>
  </div>
<!-- END MODAL UBAH lokasi_atm -->

<script>
    $(document).ready(function(){
        $('#list_sektor').load('backend/modul_lokasi_atm/get_list_sektor.php');
        $('#data_lokasi_atm').load('backend/modul_lokasi_atm/get_lokasi_atm.php');
        $('#edit_list_sektor').load('backend/modul_lokasi_atm/get_list_byid_sektor.php');
    })

    function tambah_lokasi_atm() {
        $('#modal_tambah_lokasi_atm').modal();
    }
    function btn_modal_ubah_lokasi_atm(id_lokasi_atm) {
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_lokasi_atm/by_id_lokasi_atm.php',
            type: 'GET',
            dataType: 'json',
            data: {id_lokasi_atm: id_lokasi_atm},
            success:function(response) {
                if(response.status == 'success') {
                    $("#edit_id_sektor").val(response.msg[0].id_sektor);
                    $('#edit_nama_lokasi_atm').val(response.msg[0].lokasi_atm);
                    $('#edit_kode_lokasi_atm').val(response.msg[0].kode_lokasi_atm);
                    $('#edit_kunci_fascia_atas').val(response.msg[0].fascia_atas);
                    $('#edit_kunci_fascia_bawah').val(response.msg[0].fascia_bawah);
                    $('#edit_kunci_tombak').val(response.msg[0].tombak);
                    $('#edit_kunci_kombinasi').val(response.msg[0].kombinasi);
                    $('#edit_kunci_casing_both').val(response.msg[0].casing_or_both);
                    $('#button_edit_lokasi_atm').html(`<button class="btn btn-secondary" type="button"data-dismiss="modal">Batal</button><button class="btn btn-primary" type="button" onclick="ubah_lokasi_atm(`+id_lokasi_atm+`)">Ubah</button>`);
                    $('#modal_ubah_lokasi_atm').modal();
                } else {
                    alert(response.msg);
                    return false;
                }
            },
            error:function(xhr, stat, err) {
                alert('Oops!' +err);
                return false;
            }    
        });
    }
    function ubah_lokasi_atm(id_lokasi_atm) {
        var nama_lokasi_atm = $('#edit_nama_lokasi_atm').val();
        var kode_lokasi_atm = $('#edit_kode_lokasi_atm').val();
        var kunci_fascia_atas = $('#edit_kunci_fascia_atas').val();
        var kunci_fascia_bawah = $('#edit_kunci_fascia_bawah').val();
        var kunci_tombak = $('#edit_kunci_tombak').val();
        var kunci_kombinasi = $('#edit_kunci_kombinasi').val();
        var kunci_casing_both = $('#edit_kunci_casing_both').val();
        var id_sektor = $('#edit_id_sektor').val();
        var payload_ubah_lokasi_atm = {
            id_lokasi_atm: id_lokasi_atm,
            id_sektor: id_sektor,
            nama_lokasi_atm: nama_lokasi_atm,
            kode_lokasi_atm: kode_lokasi_atm,
            kunci_fascia_atas: kunci_fascia_atas,
            kunci_fascia_bawah: kunci_fascia_bawah,
            kunci_tombak: kunci_tombak,
            kunci_kombinasi: kunci_kombinasi,
            kunci_casing_both: kunci_casing_both,
        }
        if(nama_lokasi_atm == '' || nama_lokasi_atm == 0) {
            alert('Nama lokasi_atm harus diisi');
            return false;
        }
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_lokasi_atm/ubah_lokasi_atm.php',
            type: 'POST',
            dataType: 'json',
            data: payload_ubah_lokasi_atm,
            success:function(response) {
                if(response.msg == 'success') {
                    Swal.fire(
                        'Success',
                        'Lokasi ATM berhasil diubah',
                        'success'
                        ).then(function() {
                            $('#form-ubah-lokasi_atm')[0].reset(); 
                            $('#modal_ubah_lokasi_atm').modal('hide');
                            $('#data_lokasi_atm').load('backend/modul_lokasi_atm/get_lokasi_atm.php');
                      });
                } else {
                    console.log(response.msg);
                    Swal.fire(
                        'Error',
                        response.msg,
                        'error'
                        ).then(function() {
                          $('#data_lokasi_atm').load('backend/modul_lokasi_atm/get_lokasi_atm.php');
                    });
                }
            },
            error:function(xhr, stat, err) {
                alert('Oops!' +err);
                return false;
            }
        });
    }
    function simpan_lokasi_atm() {
        var nama_lokasi_atm = $('#nama_lokasi_atm').val();
        if(nama_lokasi_atm == '' || nama_lokasi_atm == 0) {
            alert('Nama lokasi_atm harus diisi');
            return false;
        }
        var data = $("#form-tambah-lokasi_atm").serialize();
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_lokasi_atm/simpan_lokasi_atm.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success:function(response) {
                if(response.msg == 'success') {
                    $('#nama_lokasi_atm').val('');
                    Swal.fire(
                        'Success',
                        'lokasi_atm berhasil disimpan',
                        'success'
                        ).then(function() {
                            $('#data_lokasi_atm').load('backend/modul_lokasi_atm/get_lokasi_atm.php');
                      });
                } else {
                    Swal.fire(
                        'Error',
                        response.msg,
                        'error'
                        ).then(function() {
                          $('#data_lokasi_atm').load('backend/modul_lokasi_atm/get_lokasi_atm.php');
                    });
                }
            },
            error:function(xhr, stat, err) {
                alert('Oops!' +err);
                return false;
            }
        });
    }
    function hapus_lokasi_atm(id_lokasi_atm) {
        if(id_lokasi_atm == '' || id_lokasi_atm == 0) {
            alert('Oops! something wrong.');
            return false;
        }
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "lokasi_atm ini akan di hapus !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                    headers : {
                      'CsrfToken': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'backend/modul_lokasi_atm/hapus_lokasi_atm.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id_lokasi_atm: id_lokasi_atm},
                    success:function(response) {
                        if(response.msg == 'success') {
                            Swal.fire(
                              'Success',
                              'lokasi_atm berhasil dihapus',
                              'success'
                              ).then(function() {
                                $('#data_lokasi_atm').load('backend/modul_lokasi_atm/get_lokasi_atm.php');
                              });
                        } else {
                              Swal.fire(
                                'Error',
                                response.msg,
                                'error'
                                ).then(function() {
                                  $('#data_lokasi_atm').load('backend/modul_lokasi_atm/get_lokasi_atm.php');
                                });
                        }
                    },
                    error:function(xhr, stat, err) {
                        alert('Oops!' +err);
                        return false;
                    }
                });
            }
          });
    }
</script>
