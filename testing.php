<?php
    require 'koneksi.php';
    function getWardInfo($param){
        $wardinfo="";
        $Query="SELECT * FROM tb_karyawan WHERE kode_karyawan=$param";
        $Result=pg_query($conn,$Query);
        if(isset($Result) && !empty($Result) && pg_num_rows($Result) > 0){
            $row=pg_fetch_assoc($Result);
            $wardinfo= "Halo" . $row["nama_karyawan"];
            $arr=array(
                "fulfillmentText" => $wardinfo,
            );
        }else{
            $arr=array(
                "fulfillmentText" => "Gak nemu",
            );
            sendMessage($arr);
        }
    }
?>
