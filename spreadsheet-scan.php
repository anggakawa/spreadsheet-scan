<?php

require_once ('SpreadSheetScan.php');

$inputFileName = $argv[1];
$cellRange = $argv[2];

$SpreadSheetScan = new SpreadSheetScan($inputFileName, $cellRange);
$SpreadSheetScan -> loadData();
$SpreadSheetScan -> importData();