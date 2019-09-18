<?php

require 'vendor/autoload.php';
require_once 'Database.php';

try {
  // Arguments
  $inputFileName = $argv[1];
  $cellRange = $argv[2];

  $db = new Database(); // initializing database class
  $db->createTable(); // you can comment this if you've created table

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





