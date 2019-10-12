<?php
include 'welcome.php';

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$kata = $json->queryResult->parameters->kata;
	$list = $json->queryResult->parameters->list;

	if (in_array($kata, $welcome)) {
    	$balasan = "Selamat datang di Naybot!
    				Ada yang bisa aku bantu ?
    				(Jalankan perintah listperintah untuk melihat perintah yang tersedia)" ;
    	if (in_array($list, $perintah)) {
    		$balasan = "ini list perintah" ;
		}else{
			$balasan = "input tidak terdaftar";
		}


	}else{
		$balasan = "input tidak terdaftar";
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
	$response->fulfillmentText = $balasan;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>