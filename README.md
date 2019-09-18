# Spreadsheet Scan

*Still in Development*

> I'm using [Phpoffice/PhpSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) library, check it out !!!

A tool to exporting excel data to mysql database. Based on PHP 7.

## How to Use
First, change the Database.php based on what you need.

Command line version : 
```sh
$ composer install
$ php spreadsheet-scan.php "excelfile.xls | spreadsheet.csv" "rangeofcell"
```
example: 
```sh
$ php spreadsheet-scan.php "test.xlsx" "a2:b6"
```

Web Version:
```
1. Go to your local server.
2. Upload and specify the cell range.
3. Enjoy
```