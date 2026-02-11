<?php
$id_barang = $_GET['id_barang'];
if (empty($id_barang)) {
?>
<script type="text/javascript">
window.location.href = "?p=list_barang";
</script>
<?php
}

// PERBAIKAN: Hapus duplikasi WHERE
$sql = "SELECT * FROM barang 
        LEFT JOIN ruang ON ruang.id_ruang = barang.id_ruang 
        LEFT JOIN kategori ON kategori.id_kategori = barang.id_kategori 
        WHERE id_barang = '$id_barang'";

$query = mysqli_query($koneksi, $sql);
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_array($query);
} else {
    $data = NULL;
}
?>

<div class="row">
    <h2>Edit Barang</h2>
    <hr>
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Edit Barang Peminjaman</div>
            <div class="panel-body">
                <?php
                if (isset($_POST['simpan'])) {
                    $kode_barang = mysqli_real_escape_string($koneksi, $_POST['kode_barang']);
                    $nama        = mysqli_real_escape_string($koneksi, $_POST['nama']);
                    $kondisi     = mysqli_real_escape_string($koneksi, $_POST['kondisi']);
                    $jumlah      = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
                    $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
                    $id_ruang    = mysqli_real_escape_string($koneksi, $_POST['id_ruang']);
                    $keterangan  = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
                   
                    $sql_update = "UPDATE barang SET 
                                   kode_barang='$kode_barang',
                                   nama='$nama',
                                   kondisi='$kondisi',
                                   jumlah='$jumlah',
                                   id_kategori='$id_kategori',
                                   id_ruang='$id_ruang',
                                   keterangan='$keterangan'
                                   WHERE id_barang='$id_barang'";
               
                    $q_update = mysqli_query($koneksi, $sql_update);
                    if ($q_update) {
                ?>
                        <script type="text/javascript">
                        window.location.href = "?p=list_barang";
                        </script>
                <?php
                    } else {
                ?>
                        <div class="alert alert-danger">
                            Barang Gagal Di Update!
                            <br>Error: <?= mysqli_error($koneksi) ?>
                        </div>
                <?php
                    }
                }
                ?>

                <form action="" method="POST">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" class="form-control" name="kode_barang" value="<?= $data['kode_barang'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Kondisi</label>
                        <select name="kondisi" class="form-control" required>
                            <option value="<?= $data['kondisi'] ?>"><?= $data['kondisi'] ?></option>
                            <option value="Baik">Baik</option>
                            <option value="Okee">Okee</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" min="1" value="<?= $data['jumlah'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Kategori Barang</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
                            <?php
                            $sql_kategori = "SELECT * FROM kategori WHERE id_kategori != '{$data['id_kategori']}'";
                            $q_kategori = mysqli_query($koneksi, $sql_kategori);
                            while ($kat = mysqli_fetch_array($q_kategori)) {
                            ?>
                                <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Ruang</label>
                        <select name="id_ruang" class="form-control" required>
                            <option value="<?= $data['id_ruang'] ?>"><?= $data['nama_ruang'] ?></option>
                            <?php
                            $sql_ruang = "SELECT * FROM ruang WHERE id_ruang != '{$data['id_ruang']}'";
                            $q_ruang = mysqli_query($koneksi, $sql_ruang);
                            while ($ruang = mysqli_fetch_array($q_ruang)) {
                            ?>
                                <option value="<?= $ruang['id_ruang'] ?>"><?= $ruang['nama_ruang'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" cols="30" rows="5" class="form-control"><?= $data['keterangan'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-md btn-primary" name="simpan">Simpan</button>
                        <a href="?p=list_barang" class="btn btn-md btn-default">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>