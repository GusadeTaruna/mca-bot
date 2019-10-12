<?php
include 'welcome.php';

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	//ambil parameter kata dari dialogflow
	$kata = $json->queryResult->parameters->kata;

	//Respon untuk percakapan awal
	if (in_array($kata, $welcome)) {
    	$balasan = "Selamat datang di Naybot!
    				Ada yang bisa aku bantu ?
    				(Jalankan perintah listperintah untuk melihat perintah yang tersedia)" ;
	}elseif(in_array($kata, $perintah)){
		$balasan = "1. booking (Untuk pesan resource) 2. lihatresource (Untuk melihat ketersediaan resource) ";
	}

	//Respon untuk lihat perintah
	

	// switch ($kata) {
	// 	case 'hi':
	// 		$speech = "awaw";
	// 		break;

	// 	case 'bye':
	// 		$speech = "dada";
	// 		break;

	// 	case 'anything':
	// 		$speech = "ngetik apa kamu";
	// 		break;
		
	// 	default:
	// 		$speech = "input tidak terdaftar";
	// 		break;
	// }

	$response = new \stdClass();
	if (in_array($kata, $welcome)){
		$response->fulfillmentText = $balasan;
	}elseif (in_array($kata, $perintah)) {
		$response->fulfillmentText = $responPerintah;
	}else{
		$response->fulfillmentText = "input salah";
	}
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>