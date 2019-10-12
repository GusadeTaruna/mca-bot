<?php 

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$kata = $json->queryResult->parameters->kata;

	switch ($kata) {
		case 'hi':
			$agent->reply('Hi, how can I help?');
			break;

		case 'bye':
			$speech = "dada";
			break;

		case 'anything':
			$speech = "ngetik apa kamu";
			break;
		
		default:
			$speech = "input tidak terdaftar";
			break;
	}

	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->text = $speech;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>