<?php

require 'vendor/autoload.php';
require_once 'Database.php';

class SpreadSheetScan {
  private $inputFileName;
  private $cellRange;
  private $spreadsheet;
  private $db;

  public function __construct($inputFileName, $cellRange) {
    $this -> inputFileName = $inputFileName;
    $this -> cellRange = $cellRange;
    
    $this -> db = new Database(); // initializing database class
    $this -> db -> createTable(); // you can comment this if you've created a table

  }

  public function loadData() {
    try {
       /**  Identify the type of $inputFileName  **/
      $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($this -> inputFileName);
      /**  Create a new Reader of the type that has been identified  **/
      $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
      /**  Advise the Reader that we only want to load cell data  **/
      $reader->setReadDataOnly(true);
      /**  Load $inputFileName to a Spreadsheet Object  **/
      $this -> spreadsheet = $reader->load($this -> inputFileName);
      return $this;
    } catch (\Throwable $th) {
      die('Error loading file: '.$th->getMessage());
    }
  }

  public function importData() {
    $rows = $this -> spreadsheet -> getActiveSheet() -> rangeToArray(
      $this -> cellRange, NULL, TRUE, TRUE, TRUE
    );

    foreach ($rows as $row) {
      $this -> db ->insertToTable($row);
    }

    echo "success";
  }

}