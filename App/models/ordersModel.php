<?php
namespace App\Models ;

use App\Core\App;

class ordersModel{

  public function showData(){
    $sql = "SELECT P.name as product_name, U.name as customer_name,  SUM(O.purchase_quantity) as purchase_quantity, P.price as product_price, (P.price *  SUM(O.purchase_quantity)) as total_price FROM users as U JOIN orders AS O ON O.user_phone = U.phone JOIN products AS P ON P.code = O.product_code GROUP BY U.name ORDER BY (P.price * O.purchase_quantity) DESC" ;

    try{
      return App::get('database')->sqlInsert($sql) ;
    }catch(\PDOException $e){

        die($e->getMessage());
        
    }

  }

  public function sumColumn(){
    $sql = "SELECT SUM(O.purchase_quantity) AS sum_quantity, SUM(P.price) AS sum_price, SUM(P.price * O.purchase_quantity) AS sum_total_price FROM users as U JOIN orders AS O ON O.user_phone = U.phone JOIN products AS P ON P.code = O.product_code;" ;

    try{
      return App::get('database')->sqlInsert($sql) ;
    }catch(\PDOException $e){

        die($e->getMessage());
        
    }

  }

}

