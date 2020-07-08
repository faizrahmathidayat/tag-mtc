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
$getpermintaan = "SELECT a.id AS id_permintaan, a.nama_koordinator, a.nama_pengawal, b.id AS id_sektor, b.nama_sektor, c.nama FROM tag_permintaan_sektor  a JOIN tag_sektor b ON a.id_sektor = b.id JOIN tag_pengguna c ON a.id_pengguna = c.id ORDER BY b.nama_sektor ASC";
$resultpermintaan = mysqli_query($connection,$getpermintaan)or die(mysqli_error());
?>
<table class="table table-bordered" id="table_permintaan" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Sektor</th>
      <th>Koordinator</th>
      <th>MTC</th>
      <th>Satwal</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no = 1;
        while($data=mysqli_fetch_array($resultpermintaan)){
    ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= $data['nama_sektor']; ?></td>
      <td><?= $data['nama_koordinator']; ?></td>
      <td><?= $data['nama']; ?></td>
      <td><?= $data['nama_pengawal']; ?></td>
      <!-- <td>
        <button class="btn btn-sm btn-danger" onclick="hapus_permintaan(<?= $data['id']; ?>)">Hapus</button>&nbsp;
        <button class="btn btn-sm btn-success" onclick="btn_modal_ubah_permintaan(<?= $data['id']; ?>)">Ubah</button>
      </td> -->
    </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  $(document).ready(function(){
    $("#table_permintaan").dataTable();
  });
</script>
