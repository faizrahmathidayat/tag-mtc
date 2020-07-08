<?php 
require_once('../../../../config/config.php');
require_once('../../../../auth/function_auth.php');
if(isset($_SESSION['logged_in']) && isset($_SESSION['role']))
{
    if($_SESSION['role'] != 'kuncen') {
        header("Location: logout.php");
    }
    if (!login_check()) {
        header("Location: logout.php");
    }
}
else
{
    header("Location: ../../");
}
$getkunci = "SELECT * FROM tag_kunci ORDER BY nama_kunci ASC";
$resultkunci = mysqli_query($connection,$getkunci)or die(mysqli_error());
?>
<table class="table table-bordered" id="table_kunci" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Kunci</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no = 1;
        while($data=mysqli_fetch_array($resultkunci)){
    ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= $data['nama_kunci']; ?></td>
      <td>
        <button class="btn btn-sm btn-danger" onclick="hapus_kunci(<?= $data['id']; ?>)">Hapus</button>&nbsp;
        <button class="btn btn-sm btn-success" onclick="btn_modal_ubah_kunci(<?= $data['id']; ?>)">Ubah</button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  $(document).ready(function(){
    $("#table_kunci").dataTable();
  });
</script>
