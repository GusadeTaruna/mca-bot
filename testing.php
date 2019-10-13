<?php
    require 'koneksi.php';
    function getWardInfo($param){
        $wardinfo="";
        $sql = 'SELECT * FROM tb_karyawan where kode_karyawan = "$kata"';
        $hasil = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
         // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                 $wardinfo = "Halo" . $row["nama_karyawan"]. " anda mau booking apa ?";
            }
        } else {
                $wardinfo = "Data Karyawan tidak ditemukan";
        }
        $arr = $wardinfo;
        sendMessage($arr);
    }
?>
