 <div class="container-fluid">
    <h1 class="mt-4">PERMINTAAN KUNCI</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Permintaan Kunci</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Data Permintaan Kunci
        </div>
        <div class="card-body">
            <div class="table-responsive" id="data_permintaan">
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH permintaan-->
<div class="modal fade" id="modal_tambah_permintaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah permintaan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="form-tambah-permintaan">
                <div class="form-group">
                    <label class="small mb-1" for="nam_permintaan">Nama permintaan</label>
                    <input type="text" name="nama_permintaan" class="form-control" id="nama_permintaan" placeholder="Nama permintaan">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <button class="btn btn-primary" type="button" onclick="simpan_permintaan()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<!-- END MODAL TAMBAH permintaan -->

<!-- MODAL UBAH permintaan-->
<div class="modal fade" id="modal_ubah_permintaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah permintaan</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="form-ubah-permintaan">
                <div class="form-group">
                    <label class="small mb-1" for="nam_permintaan">Nama permintaan</label>
                    <input type="text" name="edit_nama_permintaan" class="form-control" id="edit_nama_permintaan" placeholder="Nama permintaan">
                </div>
            </form>
        </div>
        <div class="modal-footer" id="button_edit_permintaan">
        </div>
      </div>
    </div>
  </div>
<!-- END MODAL UBAH permintaan -->

<script>
    $(document).ready(function(){
        $('#data_permintaan').load('backend/modul_permintaan/get_permintaan.php');
    })

    function tambah_permintaan() {
        $('#modal_tambah_permintaan').modal();
    }
    function btn_modal_ubah_permintaan(id_permintaan) {
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_permintaan/by_id_permintaan.php',
            type: 'GET',
            dataType: 'json',
            data: {id_permintaan: id_permintaan},
            success:function(response) {
                if(response.status == 'success') {
                    $('#edit_nama_permintaan').val(response.msg);
                    $('#button_edit_permintaan').html(`<button class="btn btn-secondary" type="button"data-dismiss="modal">Batal</button><button class="btn btn-primary" type="button" onclick="ubah_permintaan(`+id_permintaan+`)">Ubah</button>`);
                    $('#modal_ubah_permintaan').modal();
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
    function ubah_permintaan(id_permintaan) {
        var nama_permintaan = $('#edit_nama_permintaan').val();
        if(nama_permintaan == '' || nama_permintaan == 0) {
            alert('Nama permintaan harus diisi');
            return false;
        }
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_permintaan/ubah_permintaan.php',
            type: 'POST',
            dataType: 'json',
            data: {id_permintaan: id_permintaan, nama_permintaan: nama_permintaan},
            success:function(response) {
                if(response.msg == 'success') {
                    Swal.fire(
                        'Success',
                        'permintaan berhasil diubah',
                        'success'
                        ).then(function() {
                            $('#data_permintaan').load('backend/modul_permintaan/get_permintaan.php');
                      });
                } else {
                    Swal.fire(
                        'Error',
                        response.msg,
                        'error'
                        ).then(function() {
                          $('#data_permintaan').load('backend/modul_permintaan/get_permintaan.php');
                    });
                }
            },
            error:function(xhr, stat, err) {
                alert('Oops!' +err);
                return false;
            }
        });
    }
    function simpan_permintaan() {
        var nama_permintaan = $('#nama_permintaan').val();
        if(nama_permintaan == '' || nama_permintaan == 0) {
            alert('Nama permintaan harus diisi');
            return false;
        }
        var data = $("#form-tambah-permintaan").serialize();
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_permintaan/simpan_permintaan.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success:function(response) {
                if(response.msg == 'success') {
                    $('#nama_permintaan').val('');
                    Swal.fire(
                        'Success',
                        'permintaan berhasil disimpan',
                        'success'
                        ).then(function() {
                            $('#data_permintaan').load('backend/modul_permintaan/get_permintaan.php');
                      });
                } else {
                    Swal.fire(
                        'Error',
                        response.msg,
                        'error'
                        ).then(function() {
                          $('#data_permintaan').load('backend/modul_permintaan/get_permintaan.php');
                    });
                }
            },
            error:function(xhr, stat, err) {
                alert('Oops!' +err);
                return false;
            }
        });
    }
    function hapus_permintaan(id_permintaan) {
        if(id_permintaan == '' || id_permintaan == 0) {
            alert('Oops! something wrong.');
            return false;
        }
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "permintaan ini akan di hapus !",
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
                    url: 'backend/modul_permintaan/hapus_permintaan.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id_permintaan: id_permintaan},
                    success:function(response) {
                        if(response.msg == 'success') {
                            Swal.fire(
                              'Success',
                              'permintaan berhasil dihapus',
                              'success'
                              ).then(function() {
                                $('#data_permintaan').load('backend/modul_permintaan/get_permintaan.php');
                              });
                        } else {
                              Swal.fire(
                                'Error',
                                response.msg,
                                'error'
                                ).then(function() {
                                  $('#data_permintaan').load('backend/modul_permintaan/get_permintaan.php');
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
