 <div class="container-fluid">
                        <h1 class="mt-4">SEKTOR</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sektor</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Data Sektor
                            </div>
                            <div class="card-body">
                                <button class="btn btn-sm btn-primary" style="margin-bottom:10px;" onclick="tambah_sektor()">Tambah Sektor</button>
                                <div class="table-responsive" id="data_sektor">
                                </div>
                            </div>
                        </div>
                    </div>

<!-- MODAL TAMBAH SEKTOR-->
<div class="modal fade" id="modal_tambah_sektor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Sektor</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="form-tambah-sektor">
                <div class="form-group">
                    <label class="small mb-1" for="nam_sektor">Nama Sektor</label>
                    <input type="text" name="nama_sektor" class="form-control" id="nama_sektor" placeholder="Nama Sektor">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <button class="btn btn-primary" type="button" onclick="simpan_sektor()">Simpan</button>
        </div>
      </div>
    </div>
  </div>
<!-- END MODAL TAMBAH SEKTOR -->

<!-- MODAL UBAH SEKTOR-->
<div class="modal fade" id="modal_ubah_sektor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Sektor</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="form-ubah-sektor">
                <div class="form-group">
                    <label class="small mb-1" for="nam_sektor">Nama Sektor</label>
                    <input type="text" name="edit_nama_sektor" class="form-control" id="edit_nama_sektor" placeholder="Nama Sektor">
                </div>
            </form>
        </div>
        <div class="modal-footer" id="button_edit_sektor">
        </div>
      </div>
    </div>
  </div>
<!-- END MODAL UBAH SEKTOR -->

<script>
    $(document).ready(function(){
        $('#data_sektor').load('backend/modul_sektor/get_sektor.php');
    })

    function tambah_sektor() {
        $('#modal_tambah_sektor').modal();
    }
    function btn_modal_ubah_sektor(id_sektor) {
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_sektor/by_id_sektor.php',
            type: 'GET',
            dataType: 'json',
            data: {id_sektor: id_sektor},
            success:function(response) {
                if(response.status == 'success') {
                    $('#edit_nama_sektor').val(response.msg);
                    $('#button_edit_sektor').html(`<button class="btn btn-secondary" type="button"data-dismiss="modal">Batal</button><button class="btn btn-primary" type="button" onclick="ubah_sektor(`+id_sektor+`)">Ubah</button>`);
                    $('#modal_ubah_sektor').modal();
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
    function ubah_sektor(id_sektor) {
        var nama_sektor = $('#edit_nama_sektor').val();
        if(nama_sektor == '' || nama_sektor == 0) {
            alert('Nama sektor harus diisi');
            return false;
        }
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_sektor/ubah_sektor.php',
            type: 'POST',
            dataType: 'json',
            data: {id_sektor: id_sektor, nama_sektor: nama_sektor},
            success:function(response) {
                if(response.msg == 'success') {
                    Swal.fire(
                        'Success',
                        'Sektor berhasil diubah',
                        'success'
                        ).then(function() {
                            $('#data_sektor').load('backend/modul_sektor/get_sektor.php');
                      });
                } else {
                    Swal.fire(
                        'Error',
                        response.msg,
                        'error'
                        ).then(function() {
                          $('#data_sektor').load('backend/modul_sektor/get_sektor.php');
                    });
                }
            },
            error:function(xhr, stat, err) {
                alert('Oops!' +err);
                return false;
            }
        });
    }
    function simpan_sektor() {
        var nama_sektor = $('#nama_sektor').val();
        if(nama_sektor == '' || nama_sektor == 0) {
            alert('Nama sektor harus diisi');
            return false;
        }
        var data = $("#form-tambah-sektor").serialize();
        $.ajax({
            headers : {
              'CsrfToken': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'backend/modul_sektor/simpan_sektor.php',
            type: 'POST',
            dataType: 'json',
            data: data,
            success:function(response) {
                if(response.msg == 'success') {
                    $('#nama_sektor').val('');
                    Swal.fire(
                        'Success',
                        'Sektor berhasil disimpan',
                        'success'
                        ).then(function() {
                            $('#data_sektor').load('backend/modul_sektor/get_sektor.php');
                      });
                } else {
                    Swal.fire(
                        'Error',
                        response.msg,
                        'error'
                        ).then(function() {
                          $('#data_sektor').load('backend/modul_sektor/get_sektor.php');
                    });
                }
            },
            error:function(xhr, stat, err) {
                alert('Oops!' +err);
                return false;
            }
        });
    }
    function hapus_sektor(id_sektor) {
        if(id_sektor == '' || id_sektor == 0) {
            alert('Oops! something wrong.');
            return false;
        }
        Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Sektor ini akan di hapus !",
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
                    url: 'backend/modul_sektor/hapus_sektor.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {id_sektor: id_sektor},
                    success:function(response) {
                        if(response.msg == 'success') {
                            Swal.fire(
                              'Success',
                              'Sektor berhasil dihapus',
                              'success'
                              ).then(function() {
                                $('#data_sektor').load('backend/modul_sektor/get_sektor.php');
                              });
                        } else {
                              Swal.fire(
                                'Error',
                                response.msg,
                                'error'
                                ).then(function() {
                                  $('#data_sektor').load('backend/modul_sektor/get_sektor.php');
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
