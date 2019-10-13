<?php
include 'welcome.php';

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	//ambil parameter kata dari dialogflow
	$param = $json->queryResult->parameters->kata;
	$kata = strtolower($param);
	//Respon untuk percakapan awal
	if (in_array($kata, $welcome)) {
    	$balasan = "Selamat datang di Naybot!\nAda yang bisa aku bantu ?\n(Jalankan perintah listperintah untuk melihat perintah yang tersedia)" ;
	}

	//Respon untuk lihat perintah
	if(in_array($kata, $perintah)){
		$responPerintah = "1. booking (Untuk pesan resource)\n2. lihatresource (Untuk melihat ketersediaan resource) ";
	}

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
		$response->fulfillmentText = "Inputanmu tidak dapat dikenali, Silahkan jalankan perintah listperintah untuk melihat perintah yang tersedia";
	}
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>