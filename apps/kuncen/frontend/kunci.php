 <div class="container-fluid">
    <h1 class="mt-4">KUNCI</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active">Kunci</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Data Kunci
        </div>
        <div class="card-body">
            <button class="btn btn-sm btn-primary" style="margin-bottom:10px;" onclick="tambah_kunci()">Tambah kunci</button>
            <div class="table-responsive" id="data_kunci">
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH kunci-->
<div class="modal fade" id="modal_tambah_kunci" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah kunci</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="form-tambah-kunci">
                <div class="form-group">
                    <label class="small mb-1" for="nam_kunci">Nama kunci</label>
                    <input type="text" name="nama_kunci" class="form-control" id="nama_kunci" placeholder="Nama kunci">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <button class="btn btn-primary" type="button" onclick="simpan_kunci()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<!-- END MODAL TAMBAH kunci -->

<!-- MODAL UBAH kunci-->
<div class="modal fade" id="modal_ubah_kunci" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah kunci</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="form-ubah-kunci">
                <div class="form-group">
                    <label class="small mb-1" for="nam_kunci">Nama kunci</label>
                    <input type="text" name="edit_nama_kunci" class="form-control" id="edit_nama_kunci" placeholder="Nama kunci">
                </div>
            </form>
        </div>
        <div class="modal-footer" id="button_edit_kunci">
        </div>
      </div>
    </div>
  </div>
<!-- END MODAL UBAH kunci -->

<script>
    $(document).ready(function(){
        $('#data_kunci').load('backend/modul_kunci/get_kunci.php');
    })

    function tambah_kunci() {
        $('#modal_tambah_kunci').modal();
    }
    function btn_modal_ubah_kunci(id_kunci) {
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_kunci/by_id_kunci.php',
            type: 'GET',
            dataType: 'json',
            data: {id_kunci: id_kunci},
            success:function(response) {
                if(response.status == 'success') {
                    $('#edit_nama_kunci').val(response.msg);
                    $('#button_edit_kunci').html(`<button class="btn btn-secondary" type="button"data-dismiss="modal">Batal</button><button class="btn btn-primary" type="button" onclick="ubah_kunci(`+id_kunci+`)">Ubah</button>`);
                    $('#modal_ubah_kunci').modal();
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
    function ubah_kunci(id_kunci) {
        var nama_kunci = $('#edit_nama_kunci').val();
        if(nama_kunci == '' || nama_kunci == 0) {
            alert('Nama kunci harus diisi');
            return false;
        }
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_kunci/ubah_kunci.php',
            type: 'POST',
            dataType: 'json',
            data: {id_kunci: id_kunci, nama_kunci: nama_kunci},
            success:function(response) {
                if(response.msg == 'success') {
                    Swal.fire(
                        'Success',
                        'kunci berhasil diubah',
                        'success'
                        ).then(function() {
                            $('#data_kunci').load('backend/modul_kunci/get_kunci.php');
                      });
                } else {
                    Swal.fire(
                        'Error',
                        response.msg,
                        'error'
                        ).then(function() {
                          $('#data_kunci').load('backend/modul_kunci/get_kunci.php');
                    });
                }
            },
            error:function(xhr, stat, err) {
                alert('Oops!' +err);
                return false;
            }
        });
    }
    function simpan_kunci() {
        var nama_kunci = $('#nama_kunci').val();
        if(nama_kunci == '' || nama_kunci == 0) {
            alert('Nama kunci harus diisi');
            return false;
        }
        var data = $("#form-tambah-kunci").serialize();
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_kunci/simpan_kunci.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success:function(response) {
                if(response.msg == 'success') {
                    $('#nama_kunci').val('');
                    Swal.fire(
                        'Success',
                        'kunci berhasil disimpan',
                        'success'
                        ).then(function() {
                            $('#data_kunci').load('backend/modul_kunci/get_kunci.php');
                      });
                } else {
                    Swal.fire(
                        'Error',
                        response.msg,
                        'error'
                        ).then(function() {
                          $('#data_kunci').load('backend/modul_kunci/get_kunci.php');
                    });
                }
            },
            error:function(xhr, stat, err) {
                alert('Oops!' +err);
                return false;
            }
        });
    }
    function hapus_kunci(id_kunci) {
        if(id_kunci == '' || id_kunci == 0) {
            alert('Oops! something wrong.');
            return false;
        }
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "kunci ini akan di hapus !",
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
                    url: 'backend/modul_kunci/hapus_kunci.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id_kunci: id_kunci},
                    success:function(response) {
                        if(response.msg == 'success') {
                            Swal.fire(
                              'Success',
                              'kunci berhasil dihapus',
                              'success'
                              ).then(function() {
                                $('#data_kunci').load('backend/modul_kunci/get_kunci.php');
                              });
                        } else {
                              Swal.fire(
                                'Error',
                                response.msg,
                                'error'
                                ).then(function() {
                                  $('#data_kunci').load('backend/modul_kunci/get_kunci.php');
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
