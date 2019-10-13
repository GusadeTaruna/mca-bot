<?php
    require 'koneksi.php';
    function getWardInfo($param){
        // $wardinfo="";
        // $Query="SELECT * FROM tb_karyawan WHERE kode_karyawan=$param";
        // $Result=pg_query($conn,$Query);
        // if(isset($Result) && !empty($Result) && pg_num_rows($Result) > 0){
        //     $row=pg_fetch_assoc($Result);
        //     $wardinfo= "Halo" . $row["nama_karyawan"];
        //     $arr=array(
        //         "fulfillmentText" => $wardinfo,
        //     );
        // }else{
        //     $arr=array(
        //         "fulfillmentText" => "Gak nemu",
        //     );
        //     sendMessage($arr);
        // }

        $wardinfo="";
        $sql = 'SELECT * FROM tb_karyawan where kode_karyawan = "$kata"';
        $hasil = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
         // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $wardinfo = "Halo" . $row["nama_karyawan"]. " anda mau booking apa ?";
                $arr=array(
                    "fulfillmentText" => $wardinfo,
                );      
            }
        } 
        else {
            $arr=array(
                "fulfillmentText" => "Data tidak ditemukan",
            );   
        }
        $arr = $wardinfo;
        sendMessage($arr);

    }
?>
