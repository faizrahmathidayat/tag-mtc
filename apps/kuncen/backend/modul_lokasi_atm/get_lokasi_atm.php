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
$getlokasi_atm = "SELECT a.nama_sektor, b.id, b.kode_lokasi_atm, b.lokasi_atm, b.fascia_atas, b.fascia_bawah, b.tombak, b.kombinasi, b.casing_or_both, (b.fascia_atas + b.fascia_bawah + b.tombak + b.kombinasi + b.casing_or_both) AS total_perbaris FROM tag_sektor a JOIN tag_lokasi_atm b ON a.id = b.id_sektor ORDER BY a.nama_sektor ASC";
$resultlokasi_atm = mysqli_query($connection,$getlokasi_atm)or die(mysqli_error());
?>
<table class="table table-bordered" id="table_lokasi_atm" width="100%" cellspacing="0" style="font-size: 11px;">
  <thead>
    <tr>
      <th>No</th>
      <th>Sektor</th>
      <th>ID</th>
      <th>Lokasi ATM</th>
      <th>Fascia Atas</th>
      <th>Fascia Bawah</th>
      <th>Tombak</th>
      <th>Kombinasi</th>
      <th>Casing / Both</th>
      <th>Total</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $no = 1;
        while($data=mysqli_fetch_array($resultlokasi_atm)){
    ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= $data['nama_sektor']; ?></td>
      <td><?= $data['kode_lokasi_atm']; ?></td>
      <td><?= $data['lokasi_atm']; ?></td>
      <td><?= $data['fascia_atas']; ?></td>
      <td><?= $data['fascia_bawah']; ?></td>
      <td><?= $data['tombak']; ?></td>
      <td><?= $data['kombinasi']; ?></td>
      <td><?= $data['casing_or_both']; ?></td>
      <td style="font-weight: bold;"><?= $data['total_perbaris']; ?></td>
      <td>
        <button class="btn btn-sm btn-danger" onclick="hapus_lokasi_atm(<?= $data['id']; ?>)"><i class="fas fa-trash-alt"></i></button>&nbsp;
        <button class="btn btn-sm btn-success" onclick="btn_modal_ubah_lokasi_atm(<?= $data['id']; ?>)"><i class="fas fa-edit"></i></button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  $(document).ready(function(){
    $("#table_lokasi_atm").dataTable();
  });
</script>
