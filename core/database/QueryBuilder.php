<?php

class QueryBuilder{
  protected $pdo;

  public function __construct($pdo){
    $this->pdo = $pdo;
  }

  public function selectAll($table){
    $statement = $this->pdo->prepare("select * from `{$table}`");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function insert($table,$parameters)
  
  {
    $sql = sprintf(
      'insert into %s (%s) value (%s)',
       $table,
       implode(', ',array_keys($parameters)),
        ':'. implode(', :',array_keys($parameters)),
      );
    try{
      $statement = $this->pdo->prepare($sql);
      // var_dump($statement);
      $statement->execute($parameters);

    }catch(PDOException $e){

        die($e->getMessage());
        
    }
  }
  public function sqlInsert($sql)
  
  {
    try{
      // die(var_dump($sql)) ;
      $statement = $this->pdo->query($sql);
     return $statement->fetchAll();


    }catch(PDOException $e){

        die($e->getMessage());
        
    }
  }
}