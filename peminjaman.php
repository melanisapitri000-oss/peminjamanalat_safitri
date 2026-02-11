<?php

$sql = "SELECT max(id_peminjaman) as maxKode FROM peminjaman";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
$id_peminjaman = $data['maxKode'];

@$noUrut = (int)  substr($id_peminjaman, 3, 3);
$noUrut ++;

$char ="PMJ";
$KodePeminjaman = $char . sprintf("%03s", $noUrut);

?>
<div class="row">
    <div class="col-lg-12 text-center">
        <h2>Peminjaman Alat Olahraga</h2>
        <hr>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-primary">
            <div class="panel-heading">Peminjaman</div>
            <div class="panel-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Kode Peminjaman</label>
                        <input type="text" class="form-control" name="id_peminjaman" value="<?= $KodePeminjaman ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Peminjam</label>
                        <select name="id_peminjam" id="" class="form-control">
                            <option value="">NAMA PEMINJAM</option>
                            <?php
                                $sql_peminjam = "SELECT * FROM peminjam";
                                $q_peminjam = mysqli_query($koneksi,$sql_peminjam);
                                while($peminjam = mysqli_fetch_array($q_peminjam)){
                                    ?>
                            <option value="<?= $peminjam['id_peminjam'] ?>">
                                <?= $peminjam['nama_peminjam'] ?></option>
                            <?php
                                }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Barang</label>
                        <select name="id_barang" id="" class="form-control">
                            <option value="">NAMA BARANG</option>
                            <?php
                                $sql_barang = "SELECT * FROM barang";
                                $q_barang = mysqli_query($koneksi,$sql_barang);
                                while($barang = mysqli_fetch_array($q_barang)){
                                    ?>
                            <option value="<?= $barang['id_barang'] ?>">
                                <?= $barang['nama'] ?></option>
                            <?php
                                }
                                ?>
                        </select>
                        <div class="form-group">
                            <label for="">Jumlah</label>
                            <input type="number" class="form-control" name="Jumlah">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal_Pinjam</label>
                            <input type="date" class="form-control" name="Tanggal_Pinjam">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-md btn-primary" name="simpan">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <?php
                if (isset($_POST['simpan'])) {
                    $id_peminjaman = $_POST['id_peminjaman'];
                    $id_peminjam = $_POST['id_peminjam'];
                    $id_barang = $_POST['id_barang'];
                    $Jumlah = $_POST['Jumlah'];
                    $tanggal_pinjam = $_POST['tanggal_pinjam'];


                    $sql_peminjaman = "INSERT INTO peminjaman SET 
                    id_peminjaman = '$id_peminjaman',
                    tanggal_pinjam = '$tanggal_pinjam',
                    id_peminjam = '$id_peminjam',
                    status_peminjaman = '0'";

                      
                    $query_input = mysqli_query($koneksi,$sql_peminjaman);
                    if ($query_input) {
                        $detail_pinjam = "INSERT INTO detail_pinjam SET 
                        Jumlah = '$Jumlah', 
                        id_barang = '$id_barang',
                        id_peminjaman = '$id_peminjaman'";

                          $q_detail_pinjam = mysqli_query($koneksi, $detail_pinjam);
                          if ($q_detail_pinjam) {
                            ?>
           echo "<script>
           alert('Data berhasil disimpan');
           window.location='?p=peminjaman';
           </script>";
            <?php
            }else{
             echo "Gagal" ; } 
            }else{
             echo "Gagal Menyimpan" ; } } ?>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="panel panel-primary">
            <div class="panel-heading">Daftar Barang Dipinjam</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Peminjaman</th>
                            <th>Tgl.Pinjam</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Tgl.Kembali</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hari = date('d-m-Y');
                        $d_peminjaman = "SELECT *, detail_pinjam.jumlah as jumlah FROM detail_pinjam left join peminjaman on peminjaman.id_peminjaman = detail_pinjam.id_peminjaman left join barang on barang.id_barang = detail_pinjam.id_barang 
                        Left Join peminjam on peminjam.id_peminjam = peminjaman.id_peminjam";
                        $d_query = mysqli_query($koneksi,$d_peminjaman);
                        $cek = mysqli_num_rows($d_query);
                        
                        if ($cek > 0) {
                            $no= 1;
                          while($data_d = mysqli_fetch_array($d_query)) {
                            ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data_d['id_peminjaman'] ?></td>
                            <td><?= $data_d['tanggal_pinjam'] ?></td>
                            <td><?= $data_d['nama_peminjam'] ?></td>
                            <td><?= $data_d['nama'] ?></td>
                            <td><?= $data_d['jumlah'] ?></td>
                            <td><?= $data_d['tanggal_kembali'] ?></td>
                            <td>
                                <?php
                                if ($data_d['status_peminjaman'] == '0') {
                                    echo "<label class='label label-danger'>Konfirmasi</label>";
                                }else if ($data_d['status_peminjaman'] == '1') {
                                    echo "<label class='label label-warning'>Dipinjam</label>";
                                }else {
                                    echo "<label class='label label-success'>Dikembalikan</label>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                        if ($data_d['status_peminjaman'] == '0') {
                                            ?>
                               <a onclick="return confirm('Apakah Anda Yakin?')"
                               href="page/proses_peminjaman.php?id_peminjaman=<?= isset($data_d['id_peminjaman']) ? $data_d['id_peminjaman'] : '' ?>"
                               class="btn btn-sm btn-primary">Proses</a>
                               
                               <a onclick="return confirm('Apakah anda yakin untuk menghapusnya?')"
                               href="page/hapus_peminjaman.php?id_peminjaman=<?= isset($data_d['id_peminjaman']) ? $data_d['id_peminjaman'] : '' ?>"
                               class="btn btn-danger btn-sm">Hapus</a>
  
                                <?php
                                
                            }
                                ?>
                            </td>
                        </tr>

                        <?php
                        }
                        }

                        ?>
                        
                        <!--<tr>
                            <td>1</td>
                            <td>PJM001</td>
                            <td>02-10-2026</td>
                            <td>AnnA</td>
                            <td>Raket</td>
                            <td>10</td>
                            <td>00-00-0000</td>
                            <td>
                                <label for="" class=" label label-danger">Belum</label>
                            </td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">Setujui</a>
                            </td>-->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>