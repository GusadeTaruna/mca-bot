<?php
include 'welcome.php';
include 'koneksi.php';

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	//ambil parameter kata dari dialogflow
	$param = $json->queryResult->parameters->kata;
	$kata = strtolower($param);
	//Respon untuk percakapan awal
	if (in_array($kata, $welcome)) {
    	$balasan = "Selamat datang di Naybot!, Ada yang bisa aku bantu ?\n(Jalankan perintah listperintah untuk melihat perintah yang tersedia)" ;
	}

	//Respon untuk lihat perintah
	if(in_array($kata, $perintah)){
		$responPerintah = "LIST PERINTAH YANG TERSEDIA\n1. booking (Untuk pesan resource)\n2. lihatresource (Untuk melihat ketersediaan resource)\n3. lihatdatapinjam (Untuk melihat data peminjaman resource)";
	}

	//perintah 1
	if(in_array($kata, $perintah1)){
		$responPerintah1 = "Untuk booking resource, anda perlu menginput Kode Karyawan terlebih dahulu";
		$sql = 'SELECT * FROM tb_karyawan where kode_karyawan = "$kata"';
		$hasil = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		    	$responPerintah1 = "Halo" . $row["nama_karyawan"]. " anda mau booking apa ?";
		    }
		} else {
		    $responPerintah1 = "Data Karyawan tidak ditemukan";
		}
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
	// if (!$conn) {
 	//    $response->fulfillmentText = "failed";
	// }
	// $response->fulfillmentText = "sukses";
	if (in_array($kata, $welcome)){
		$response->fulfillmentText = $balasan;
	
	}
	elseif (in_array($kata, $perintah)) {
		$response->fulfillmentText = $responPerintah;
	
	}
	elseif (in_array($kata, $perintah1)) {
		$response->fulfillmentText = $responPerintah1;
	}
	else{
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