<?php
$id_peminjaman = $_GET['id_peminjaman'];

if (empty($id_peminjaman)) {
    echo "<script>window.location.href='?p=pengembalian';</script>";
    exit;
}
$hari = date('d-m-Y');
$d_peminjaman = "SELECT *,detail_pinjam.jumlah as  jumlah FROM detail_pinjam left join peminjaman on peminjaman.id_peminjaman = detail_pinjam.id_peminjaman left join barang on barang.id_barang = detail_pinjam.id_barang 
                         Left Join peminjam on peminjam.id_peminjam = peminjaman.id_peminjam WHERE peminjaman.id_peminjaman = '$id_peminjaman'";
                        $d_query = mysqli_query($koneksi,$d_peminjaman);
                        $data = mysqli_fetch_array($d_query);
?>
<div class="col-lg-12">
    <div class="panel panel-primary">
        <div class="panel-heading">Konfirmasi Pengembalian Barang</div>
        <div class="panel-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Kode Peminjaman</label>
                    <input type="text" name="id_peminjaman" class="form-control" value="<?= $data['id_peminjaman']  ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="">Tanggal Peminjaman</label>
                    <input type="text" name="tgl_pinjam" class="form-control" value="<?= $hari  ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Nama Peminjaman</label>
                    <input type="text" name="nama_peminjam" class="form-control" value="<?= $data['nama_peminjam']  ?>"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" name="nama" class="form-control" value="<?= $data['nama']  ?>" readonly>
                    <div class="form-group">
                        <label for="">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah']  ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Pengembalian</label>
                        <input type="date" name="tgl_kembali" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-md" type="submit" name="simpan">Simpan</button>
                        <a href="?p=pengembalian" class="btn btn-md btn-default">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
        <?php
if(isset($_POST['simpan'])){
    $tgl_kembali = $_POST['tgl_kembali'];

    if(empty($tgl_kembali)){
        echo "<div class='alert alert-danger'>Tanggal kembali wajib diisi!</div>";
    } else {

        $sql_pengembalian = "UPDATE peminjaman 
                             SET tanggal_kembali ='$tgl_kembali',
                                 status_peminjaman='2' 
                             WHERE id_peminjaman='$id_peminjaman'";

        $q_pengembalian = mysqli_query($koneksi, $sql_pengembalian);

        if($q_pengembalian){
            echo "<script>
                    alert('Pengembalian berhasil disimpan');
                    window.location.href='?p=pengembalian';
                  </script>";
        }else{
            echo "<div class='alert alert-danger'>Barang gagal diupdate!</div>";
        }
    }
}
?>

    </div>

</div>