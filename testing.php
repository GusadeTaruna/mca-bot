<?php
    require 'koneksi.php';
    function getWardInfo($param){
        $wardinfo="";
        $Query="SELECT * FROM tb_karyawan WHERE kode_karyawan=$param";
        $Result=mysqli_query($conn,$Query);
        if(isset($Result) && !empty($Result) && mysqli_num_rows($Result) > 0){
            $row=mysqli_fetch_assoc($Result);
            $wardinfo= "Halo" . $row["nama_karyawan"];
            $arr=array(
                "fulfillmentText" => $wardinfo,
            );
            sendMessage($arr);
        }else{
            $arr=array(
                "fulfillmentText" => "Gak nemu",
            );
            sendMessage($arr);
        }
    }
?>
