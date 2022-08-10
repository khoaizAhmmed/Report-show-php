<?php

namespace App\Controllers;

use App\Core\App;

use App\Models\ordersModel;



class reportController{

  public function getData(){

    $orderTableData = App::get('database')->selectAll('orders') ;
    $userTableData = App::get('database')->selectAll('users') ;
    $productTableData = App::get('database')->selectAll('products') ;
      
    $ch = curl_init();
    $url = App::get('api');
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response =  curl_exec($ch);

    if($e = curl_error($ch)){
      echo $e;
    }else{
      $apiData = json_decode($response,true);
    }

    try{

      // user entry start

      $userApi = array_map(function($e){
        $user['name']=$e['name'];
        $user['phone']=$e['user_phone'];
        return $user ;
      },$apiData);

      $userApi =array_map("unserialize", array_unique(array_map("serialize", $userApi)));

      $newUser = array_filter($userApi, function ($array2Element) use ($userTableData) {
        foreach ($userTableData as $array1Element) {
            if ($array1Element['phone'] == $array2Element['phone']) {
                return false;
            }
        }
        return true;
        });
        // var_dump($newUser);
        if(count($newUser)>0){
          foreach($newUser as $value){
            App::get('database')->insert('users',$value) ;
          }
        }

      // user entry end

      //product entry start

      $productApi = array_map(function($e){
        $product['code']=$e['product_code'];
        $product['name']=$e['product_name'];
        $product['price']=$e['product_price'];
        return $product ;
      },$apiData);

      $productApi =array_map("unserialize", array_unique(array_map("serialize", $productApi)));

      $newProduct = array_filter($productApi, function ($array2Element) use ($productTableData) {
        foreach ($productTableData as $array1Element) {
            if ($array1Element['code'] == $array2Element['code']) {
                return false;
            }
        }
        return true;
        });
        // var_dump($newProduct);
        if(count($newProduct)>0){
          foreach($newProduct as $value){
            App::get('database')->insert('products',$value) ;
          }
        }


      // product entry end

    
      // Order entry start

      $orderApi = array_map(function($e){
        $order['no']=$e['order_no'];
        $order['user_phone'] = $e['user_phone'];
        $order['product_code']=$e['product_code'];
        $order['purchase_quantity']=$e['purchase_quantity'];
        $order['created_at']=$e['created_at'];
        return $order ;
      },$apiData);

      $newOrder = array_filter($orderApi, function ($array2Element) use ($orderTableData) {
        foreach ($orderTableData as $array1Element) {
            if ($array1Element['no'] == $array2Element['no']) {
                return false;
            }
        }
        return true;
        });

      // var_dump($newOrder);

      if(count($newOrder)>0){
        foreach($newOrder as $value){
            App::get('database')->insert('orders',$value) ;
        }
        }

      // Order entry end


      // get Order Table data
      $ordersModel = new ordersModel();
      $data =[];

      $data['info'] = $ordersModel->showData();
      $data['sum'] =  $ordersModel->sumColumn();
      
       view('index',compact('data'));

    }catch(\Exception $e){
      throw new \Error($e->getMessage());
    }

  }
}
