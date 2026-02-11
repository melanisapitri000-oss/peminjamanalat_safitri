<?php
    $koneksi = mysqli_connect("localhost", "root", "", "peminjamanalat_mell");

    if(mysqli_connect_errno()){
        echo "koneksi error :" . mysqli_connect_error();
    }
?>