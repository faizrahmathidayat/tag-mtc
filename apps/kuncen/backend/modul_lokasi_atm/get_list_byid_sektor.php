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
$getlist_sektor = "SELECT * FROM tag_sektor ORDER BY nama_sektor ASC";
$resultlist_sektor = mysqli_query($connection,$getlist_sektor)or die(mysqli_error());
?>
<select class="form-control" name="edit_id_sektor" id="edit_id_sektor">
  <?php while($data = mysqli_fetch_array($resultlist_sektor)) { 
    echo '<option value="'.$data['id'].'">'.$data['nama_sektor'].'</option>';
  } ?>
</select>

