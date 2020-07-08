<?php 
require_once('../../../config/config.php');
require_once('../../../auth/function_auth.php');
if(isset($_SESSION['logged_in']))
{
  if (!login_check()) {
    header("Location: logout.php");
  }
}
else
{
  header("Location: ../");
}
$getsektor = "SELECT * FROM tag_sektor ORDER BY nama_sektor ASC";
$resultsektor = mysqli_query($connection,$getsektor)or die(mysqli_error());
?>
<table class="table table-bordered" id="table_sektor" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Sektor</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no = 1;
        while($data=mysqli_fetch_array($resultsektor)){
    ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= $data['nama_sektor']; ?></td>
      <td>
        <button class="btn btn-sm btn-danger" onclick="hapus_sektor(<?= $data['id']; ?>)">Hapus</button>&nbsp;
        <button class="btn btn-sm btn-success" onclick="btn_modal_ubah_sektor(<?= $data['id']; ?>)">Ubah</button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  $(document).ready(function(){
    $("#table_sektor").dataTable();
  });
</script>
