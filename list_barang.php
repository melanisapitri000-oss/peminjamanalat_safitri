<h2>
    <center>Daftar Barang</center>
</h2>
<hr>
<a href="?p=tambah_barang" class="btn btn-md btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
<form class="navbar-form navbar-right" role="search" method="get">
    <div class="form-group">
        <input type="hidden" name="p" value="list_barang">
        <input type="text" class="form-control" placeholder="Cari Barang" name="cari">
    </div>
    <button type="submit" class="btn btn-default">Cari</button>
</form>
<br><br>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Kondisi</th>
            <th>Jumlah</th>
            <th>Ruang</th>
            <th>Tanggal Register</th>
            <th>Keterangan</th>
            <th>Opsi</th>
        </tr>
    </thead>

    <tbody>
        <?php
        @$cari = $_GET['cari'];
        $q_cari = "";
        if(!empty($cari)){
            $q_cari .= "and nama like'%" .$cari. "%'";
            
        }
        $pembagian = 5;
        $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
        $mulai = $page > 1 ? $page * $pembagian - $pembagian : 0;
        
        $sql = "SELECT *, barang.keterangan as ket FROM barang LEFT JOIN ruang ON ruang.id_ruang = barang.id_ruang WHERE 1=1 $q_cari LIMIT $mulai, $pembagian";
        $query = mysqli_query($koneksi, $sql);
        $cek = mysqli_num_rows($query);

        //mencari total halaman
        $sql_total = "SELECT * FROM barang";
        $sq_total = mysqli_query($koneksi, $sql_total);
        $total = mysqli_num_rows($sq_total);

        $jumlahHalaman = ceil($total / $pembagian);


        if($cek > 0){ 
            $no = $mulai + 1;
            while($data = mysqli_fetch_array($query)){
                $tgl = $data['tanggal_register'];
            ?>
        <tr align-center>
            <td width="50"><?= $no++ ?></td>
            <td width="170"><?= $data['kode_barang'] ?></td>
            <td width="150"><?= $data['nama'] ?></td>
            <td width="100"><?= $data['kondisi'] ?></td>
            <td width="100"><?= $data['jumlah'] ?></td>
            <td width="150"><?= $data['nama_ruang'] ?></td>
            <td width="150"><?= date ("d-m-y", strtotime($tgl)) ?></td>
            <td><?= $data['ket'] ?></td>
            <td width="125">
                <a href="?p=edit_barang&id_barang=<?= $data['id_barang'] ?>" class="btn btn-md btn-primary"><span
                        class="glyphicon glyphicon-edit"></span></a>

                        <a href="page/hapus_barang.php?id_barang=<?= $data['id_barang']; ?>"
                            class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapusnya?')">
                   <span class="glyphicon glyphicon-trash"></span>
                </a>

                </a>

            </td>
        </tr>
        <?php
            }  
        }
        ?>
        <!-- <tr>
            <td>1</td>
            <td>L001</td>
            <td>Bola</td>
            <td>Baik</td>
            <td>60</td>
            <td>GOR</td>
            <td>13 Januari 2026</td>
            <td>Barang dapat dari bantuan</td>
            <td>
                <a href="?p=edit_barang" class="btn btn-md btn-primary"><span
                        class="glyphicon glyphicon-edit"></span></a>
                <a href="" class="btn btn-md btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
            </td> -->


        </tr>
    </tbody>
</table>
<div class="float-left">

    Jumlah : <?= $total ?>

</div>
<div class="" style="float: right;">
    <nav>
        <ul class="pagination">
            <li class="page-item">
                <a href="?p=list_barang&halaman=<?= $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($i = 1; $i <=$jumlahHalaman; $i++){
                ?>
            <li class="<?= (isset ($_GET ['halaman']) && $i ==$_GET['halaman']) ? 'active' : '' ?>">
                <a href="?p=list_barang&halaman=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php
            }
            ?>

            <!-- <li class="page-item"><a class="page-link" href="#">1</a></li>
                 <li class="page-item"><a class="page-link" href="#">2</a></li>
                 <li class="page-item"><a class="page-link" href="#">3</a></li>
                 <li class="page-item"><a class="page-link" href="#">4</a></li>
                 <li class="page-item"><a class="page-link" href="#">5</a></li> -->

            <li class="page-item">
                <a href="?p=list_barang&halaman=<?= $page +1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>