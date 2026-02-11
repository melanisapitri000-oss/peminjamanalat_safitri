<?php
include "../config/koneksi.php";

$id_peminjaman = $_GET['id_peminjaman'];

$sql = "DELETE FROM peminjaman WHERE id_peminjaman='$id_peminjaman'";
$query = mysqli_query($koneksi,$sql);

if($query){
?>
<script>
window.location.href="../index.php?p=peminjaman";
</script>
<?php
}else{
?>
<script>
alert('Terjadi kesalahan');
window.location.href="../index.php?p=peminjaman";
</script>
<?php
}
?>
