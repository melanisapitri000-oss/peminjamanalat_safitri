<div class="row">
<h2>Tambah Barang</h2>
<hr>
<div class="col-lg-4">
<div class="panel panel-primary">
        <div class="panel-heading">Tambah Barang Pinjaman</div>
                <div class="panel-body">              
    <form action="" method="post">
        <div class="form-group">
        <label for="">Kode Barang</label>
        <input type="text" class="form-control" name="kode_barang" placeholder="Masukan Kode Barang">
</div>
<div class="form-group">
        <label for="">Nama Barang</label>
        <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Barang">
</div>
<div class="form-group">
        <label for="">Kondisi</label>
        <select name="kondisi" id="" class="form-control">
 <option value="" name="kondisi" class="form-control">- PILIH -</option>
 <option value="Baik" name="kondisi" class="form-control">Baik</option>
 <option value="Okee" name="kondisi" class="form-control">Okee</option>
        </select>
        <div class="form-group">
        <label for="">Jumlah</label>
        <input type="number" class="form-control" name="jumlah" placeholder="Masukan Jumlah Barang">
</div>
<div class="form-group">
        <label for="">Kategori Barang</label>
        <select name="id_kategori" id="" class="form-control">
        <option value="" class="form-control">- PILIH -</option>
     <?php
    $sql_kategori = "SELECT * FROM kategori";
    $q_kategori=mysqli_query($koneksi, $sql_kategori);
    while ($kategori =mysqli_fetch_array($q_kategori)){
        ?>
        <option value="<?= $kategori ['id_kategori']?>"><?= $kategori ['nama_kategori']?></option>
        
        <?php
    }
     ?>
     </select>
</div>
<div class="form-group">
        <label for="">Nama Ruang</label>
        <select name="id_ruang" id="" class="form-control">
        <option value="" class="form-control">- PILIH -</option>
     <?php
    $sql_ruang = "SELECT * FROM ruang";
    $q_ruang=mysqli_query($koneksi, $sql_ruang);
    while ($ruang =mysqli_fetch_array($q_ruang)){
        ?>
        <option value="<?= $ruang ['id_ruang']?>"><?= $ruang ['nama_ruang']?></option>
        <?php
    }
     ?>
     </select>
</div>
<div class="form-group">
        <label for="">Keterangan</label>
      <textarea name="keterangan" id="" cols="30" rows="10" class="form-control" ></textarea>
</div>
<div class="form-group hidden">
        <label for="">Keterangan</label>
        <input type="hidden" name="id_petugas" value="3">
</div>
<div class="form-group">
        <button class="btn btn-md btn-primary" name="simpan">Simpan</button>
        <a href="?p=list_barang" class="btn btn-md btn-default">Kembali</a>
</div>
                
        </div>

</div>

    </form>

<?php
if (isset($_POST['simpan'])) {
        $kode_barang = $_POST['kode_barang'];
        $nama = $_POST['nama'];
        $kondisi = $_POST['kondisi'];
        $jumlah = $_POST['jumlah'];
        $id_kategori = $_POST['id_kategori'];
        $id_ruang = $_POST['id_ruang'];
        $keterangan = $_POST['keterangan'];
        $id_petugas = $_POST['id_petugas'];

        $sql ="INSERT INTO barang SET
         kode_barang='$kode_barang',
         nama='$nama',
         kondisi='$kondisi',
         jumlah='$jumlah',
         id_kategori='$id_kategori',
         id_ruang='$id_ruang',
         keterangan='$keterangan',
         id_petugas='$id_petugas'";

        $query = mysqli_query($koneksi,$sql);
        if ($query) {
                ?>
                <div class="alert-success">Barang Berhasil Ditambahkan</div>
                <?php
        }else{
                ?>
        <div class="alert-danger">Barang Gagal Ditambahkan</div>
                <?php
        }

}
?>


</div>
</div>