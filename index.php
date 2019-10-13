<?php
include 'welcome.php';
require 'koneksi.php';

$method = $_SERVER['REQUEST_METHOD'];
// $state = 0;
// public function cekKaryawan($kata){
// 	$sql = 'SELECT * FROM tb_karyawan where kode_karyawan = "$kata"';
// 	$hasil = mysqli_query($conn, $sql);
// 	if (mysqli_num_rows($result) > 0) {
// 	    // output data of each row
// 	    while($row = mysqli_fetch_assoc($result)) {
// 	    	$responPerintah1 = "Halo" . $row["nama_karyawan"]. " anda mau booking apa ?";
// 	    }
// 	} else {
// 	    $responPerintah1 = "Data Karyawan tidak ditemukan";
// 	}
// }

// function processMessage($input) {
//     $action = $input["queryResult"]["action"];
//     switch($action){
//         case 'wardinfo':
//             $param = $input["queryResult"]["queryText"]["kata"];
//             $wardinfo="";
//             if (!$conn) {
//             	sendMessage(array(
// 	                "fulfillmentText" => "Connection failed",
// 	            ));     
// 			}
// 			sendMessage(array(
// 	                "fulfillmentText" => "Konek",
// 	        ));
// 	        // $sql = 'SELECT nama_karyawan FROM tb_karyawan where kode_karyawan = "$param"';
// 	        // $hasil = mysqli_query($conn, $sql);
// 	        // if (mysqli_num_rows($result) > 0) {
// 	        //  // output data of each row
// 	        //     while($row = mysqli_fetch_assoc($result)) {
// 	        //         $wardinfo = "Halo" . $row["nama_karyawan"]. " anda mau booking apa ?";
// 	        //         sendMessage(array(
// 		       //          "fulfillmentText" => $wardinfo,
// 		       //      ));      
// 	        //     }
// 	        // } 
// 	        // else {
// 	        //     sendMessage(array(
// 	        //         "fulfillmentText" => "Data Tidak Ditemukan",
// 	        //     ));   
// 	        // }
//         default :
//             sendMessage(array(
//                 "fulfillmentText" => "Error bang",
//                 "contextOut" => array()
//             ));
//     }
// }

// function sendMessage($parameters) {
//     header('Content-Type: application/json');
//     $data = str_replace('\/','/',json_encode($parameters));
//     echo $data;
// }

// $input = json_decode(file_get_contents('php://input'), true);
// if (isset($input["queryResult"]["action"])) {
//     processMessage($input);
// }



if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	//ambil parameter kata dari dialogflow
	$param = $json->queryResult->parameters->kata;
	$intent = $json->intent->displayName;
	$kata = strtolower($param);

	$response = new \stdClass();

	// Respon untuk percakapan awal
	if (in_array($kata, $welcome)) {
    	$response->fulfillmentText = "Selamat datang di Naybot!, Ada yang bisa aku bantu ?\n(Jalankan perintah listperintah untuk melihat perintah yang tersedia)" ;
    }
    else if(in_array($kata, $perintah)){
		$response->fulfillmentText ="LIST PERINTAH YANG TERSEDIA\n1. booking (Untuk pesan resource)\n2. lihatresource (Untuk melihat ketersediaan resource)\n3. lihatdatapinjam (Untuk melihat data peminjaman resource)";
	}
	else if(in_array($kata, $perintah1)){
		$response->fulfillmentText = "Untuk booking resource, anda perlu menginput Kode Karyawan terlebih dahulu";
		$action = $json->queryResult->action;
		switch ($action) {
			case 'wardinfo':
				if (!$conn) {
					$response->fulfillmentText ="koneksi fail";   
				}
					$response->fulfillmentText ="berhasil";   
				break;
			
			default:
				$response->fulfillmentText ="error";  
				break;
		}
	}
	else{
		$response->fulfillmentText = "Saya tidak mengerti dengan maksudmu\ncoba jalankan perintah listperintah untuk melihat perintah yang tersedia";
	}

	

	$response->source = "webhook";
	echo json_encode($response);
	




// 	// switch ($kata) {
// 	// 	case 'hi':
// 	// 		$speech = "awaw";
// 	// 		break;

// 	// 	case 'bye':
// 	// 		$speech = "dada";
// 	// 		break;

// 	// 	case 'anything':
// 	// 		$speech = "ngetik apa kamu";
// 	// 		break;
		
// 	// 	default:
// 	// 		$speech = "input tidak terdaftar";
// 	// 		break;
// 	// }

	// $response = new \stdClass();
// 	// // if (!$conn) {
//  // 	//    $response->fulfillmentText = "failed";
// 	// // }
// 	// // $response->fulfillmentText = "sukses";
// 	// if (in_array($kata, $welcome)){
// 	// 	$response->fulfillmentText = $balasan;
	
// 	// }
// 	// elseif (in_array($kata, $perintah)) {
// 	// 	$response->fulfillmentText = $responPerintah;
	
// 	// }
// 	// elseif (in_array($kata, $perintah1)) {
// 	// 	$response->fulfillmentText = $responPerintah1;
// 	// }
// 	// else{
// 	// 	$response->fulfillmentText = "Inputanmu tidak dapat dikenali, Silahkan jalankan perintah listperintah untuk melihat perintah yang tersedia";
// 	// }
// 	// $response->source = "webhook";
// 	// echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>