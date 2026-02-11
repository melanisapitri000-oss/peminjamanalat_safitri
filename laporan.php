<?php
$hari_ini = date('Y-m-d');
?>
<div class="col-lg-12">
    <div class="panel panel-primary">
        <div class="panel-heading">Laporan Peminjaman Barang</div>
        <div class="panel-body">
            <form action="" class="form-inline">
                <input type="hidden" name="p" value="laporan">
                <div class="form-group">
                    <label for="">Tanggal Awal</label><br>
                    <input type="date" id="tgl_awal" name="tglDari" class="form-control"
                        value="<?= !empty($_GET['tglDari']) ? $_GET['tglDari'] : $hari_ini ?>">
                </div>
                <div class="form-group">
                    <label for="">Tanggal Sampai</label><br>
                    <input type="date" id="tgl_sampai" name="tglSampai" class="form-control"
                        value="<?= !empty($_GET['tglSampai']) ? $_GET['tglSampai'] : $hari_ini ?>">
                </div>
                <div class="form-group"><br>
                    <input type="submit" class="btn btn-sm btn-primary" name="cari" value="Filter">
                    <button class="btn btn-sm btn-success" id="cetak">Cetak Laporan</button>
                </div>
            </form>
            <br>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cari = '';
                    @$tglDari = $_GET['tglDari'];
                    @$tglSampai = $_GET['tglSampai'];

                    if(!empty($tglDari)){
                        $cari .="and tanggal_pinjam >='".$tglDari."'";
                    }if(!empty($tglSampai)){
                        $cari .="and tanggal_pinjam <='".$tglSampai."'";
                    }
                    if(empty($tglDari) && ($tglSampai)){
                        $cari .="and tanggal_pinjam >='".$hari_ini."' and tanggal_pinjam <='".$hari_ini."'";
                    }

                    $sql = "SELECT *,detail_pinjam.jumlah as  jumlah FROM detail_pinjam left join peminjaman on peminjaman.id_peminjaman = detail_pinjam.id_peminjaman left join barang on barang.id_barang = detail_pinjam.id_barang 
                         Left Join peminjam on peminjam.id_peminjam = peminjaman.id_peminjam WHERE 1=1 $cari";

                         $query = mysqli_query($koneksi, $sql);
                         $cek = mysqli_num_rows($query);

                         if($cek > 0){
                            $no = 1;
                            while($data = mysqli_fetch_array($query)){
                                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama_peminjam'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['jumlah'] ?></td>
                        <td><?= $data['tanggal_pinjam'] ?></td>
                        <td><?= $data['tanggal_kembali'] ?></td>
                    </tr>
                    <?php
                    
                            }
                         }else{
                            ?>
                    <tr>
                        <td colspan="6">Tidak Ada Data</td>
                    </tr>
                    <?php
                        }
                        ?>
                    <!-- <tr>
                        <td>1</td>
                        <td>Sakilaa</td>
                        <td>Raket</td>
                        <td>12</td>
                        <td>19-01-2026</td>
                        <td>22-01-2026</td>
                        </tr> -->
                </tbody>
            </table>

        </div>

    </div>

</div>