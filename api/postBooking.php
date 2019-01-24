<?php

require '../vendor/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;
include "../controller/connection.php";

$data = json_decode(file_get_contents('php://input'), true);

$userID = $data['user'];

$totalInv = $data['totalInvoice'];
$invoice = "INSERT INTO m_invoice (user_id) VALUES('".$userID."') ";
$saveInvoice = $conn->query($invoice);
$last_id = $conn->insert_id;

foreach($data['detail'] as $d){
	$tourpackID = $d['tourpack'];
	$jumlahOrang = $d['jumlahOrang'];
	$total = $d['total'];

	if($total != 0){
		$invoiceDtl = "INSERT INTO m_invoice_detail (invoice_id, tourpack_id, jumlah_orang, total) VALUES ('".$last_id."', '".$tourpackID."', '".$jumlahOrang."', '".$total."') ";
		$saveInvoiceDtl = $conn->query($invoiceDtl);
	}
	
}

// $invoiceDtl = "INSERT INTO m_invoice_detail (invoice_id, tourpack_id, jumlah_orang, total) VALUES ('".$last_id."', '".$tourpackID."', '".$jumlahOrang."', '".$total."') ";
// $saveInvoiceDtl = $conn->query($invoiceDtl);

echo json_encode(array("status" => 'berhasil'));
// echo json_encode(array('data'=>count($data['detail'])));

?>