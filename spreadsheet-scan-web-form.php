<?php
// header('Content-Type: application/json');

require_once 'SpreadSheetScan.php';

if (isset($_FILES)) {
  $cellRange = $_REQUEST['cell-range'];
  $inputFileName = $_FILES['file-data']['tmp_name'];
  $SpreadSheetScan = new SpreadSheetScan($inputFileName, $cellRange);
  $SpreadSheetScan -> loadData() -> importData();
  
  echo json_encode( [ "success" => true] );
} else {
  // http_response_code(500);
  // header('Content-type: application/json');
  echo json_encode( [ "success" => false] );
  // echo "gagal";
}

