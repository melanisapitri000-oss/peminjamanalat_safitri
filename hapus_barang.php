<?php
include"../config/koneksi.php";
$id_barang = $_GET ['id_barang'];
$sql ="DELETE FROM barang WHERE id_barang ='$id_barang'";
$query =mysqli_query($koneksi,$sql);
if($query){
    ?>
<script type="text/javascript">
    window.location.href="../index.php?p=list_barang";
</script>
    <?php
}else{
    ?>
    <script type="text/javascript">
        alert('Terjadi kesalahan');
        window.location.href="../index.php?p=list_barang";
    </script>
    <?php
}
?>