<?php

class Database{
    // db settings
    private $host   = 'localhost';
    private $user   = 'root';
    private $dbname = 'excel-db';
    private $pass   = '';

    private $dbh;
    private $error;

    public function __construct() {
        $dsn = 'mysql: host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT            => true,
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND    => 'SET NAMES UTF8'
        );
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options); 
        }
        catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
            exit;
        }       
    }
    
    public function createTable() {
      // create a table based on what you need
      $query = "CREATE TABLE IF NOT EXISTS hasil (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR(60) NOT NULL
        )";
      $this->dbh->exec($query);
      // echo "Table created successfully" . PHP_EOL;
    }

    // change the argument based on what you need
    public function insertToTable($rows) {
      // check the $rows structure
      // var_dump($rows);

      $value_1 = $rows["A"];
      $value_2 = $rows["B"];

      // also, dont forget to change the query :)
      $stmt = $this->dbh->prepare("INSERT INTO hasil (id, name) VALUES (:value_1, :value_2)");
      $stmt->bindParam(':value_1', $value_1);
      $stmt->bindParam(':value_2', $value_2);
      $stmt->execute();

    }

}
