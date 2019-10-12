<?php
include 'welcome.php';

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$kata = $json->queryResult->parameters->kata;
	$list = $json->queryResult->parameters->list;

	if (in_array($kata, $welcome)) {
    	$balasanKata = "Selamat datang di Naybot!
    				Ada yang bisa aku bantu ?
    				(Jalankan perintah listperintah untuk melihat perintah yang tersedia)" ;
	}else{
		$balasanKata = "input tidak terdaftar";
	}

	if (in_array($list, $perintah)) {
    	$balasanPerintah = "ini list perintah" ;
	}else{
		$balasanPerintah = "input tidak terdaftar";
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
	$response->fulfillmentText = $balasanKata;
	$response->fulfillmentText = $balasanPerintah;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>