<?php

require 'vendor/autoload.php';
require_once 'Database.php';

if (isset($_POST["submit"])) {
  $cellRange = $_REQUEST['cell-range'];
  try {
    // Arguments
    $inputFileName = $_FILES['file-data']['tmp_name'];

    $db = new Database(); // initializing database class
    $db->createTable(); // you can comment this if you've created a table

    /**  Identify the type of $inputFileName  **/
    $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
    /**  Advise the Reader that we only want to load cell data  **/
    $reader->setReadDataOnly(true);
    /**  Load $inputFileName to a Spreadsheet Object  **/
    $spreadsheet = $reader->load($inputFileName);

    $rows = $spreadsheet -> getActiveSheet() -> rangeToArray(
      $cellRange, NULL, TRUE, TRUE, TRUE
    );

    foreach ($rows as $row) {
      // set the argument based on cellRange you've specified
      // $db->insertToTable($row["A"], $row["B"]);
      $db->insertToTable($row);
    }

  } catch (\Throwable $th) {
    die('Error loading file: '.$th->getMessage());
  }
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