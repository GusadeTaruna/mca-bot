<?php
	
$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST"){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;

	switch ($text) {
		case 'hi':
			$speech = "Hi, salam kenal!";
			break;
		case 'bye':
			$speech = "Terima kasih !";
			break;
		case 'anything':
			$speech = "coba ketik semua";
			break;
		
		default:
			$speech = "Maaf inputan tidak dikenali";
			break;
	}

	$response = new \stdClass();
	$response->speech= "";
	$response->displayText= "";
	$response->source= "webhook";
	echo json_encode($response);



}
else
{
	echo "Method tidak diijinkan";
}


?>