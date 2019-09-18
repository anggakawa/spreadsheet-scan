<?php

require 'vendor/autoload.php';
require_once 'Database.php';
require_once 'SpreadSheetScan.php';

if (isset($_POST["submit"])) {
  $cellRange = $_REQUEST['cell-range'];
  $inputFileName = $_FILES['file-data']['tmp_name'];
  $SpreadSheetScan = new SpreadSheetScan($inputFileName, $cellRange);
  $SpreadSheetScan -> loadData();
  $SpreadSheetScan -> importData();
} else {
  echo "not imported";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <script>
      window.setTimeout(function() {
          window.location = 'index.html';
        }, 1500);
  </script>
    <p>Spreadsheet Imported :))</p>