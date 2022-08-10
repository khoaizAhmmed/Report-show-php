<?php

namespace App\Utilities;

class helper{

  public function activeNav($page){
    $active = trim($_SERVER['REQUEST_URI'],'/') == $page ;
    if($active){
      return 'text-blue-600 font-bold' ;
    }
      return 'text-gray-400 hover:text-gray-500' ;
    
  }
  
  public static function unique_key($array,$keyname){
    $new_array = array();
    foreach($array as $key=>$value){
   
      if(!isset($new_array[$value[$keyname]])){
        $new_array[$value[$keyname]] = $value;
      }
   
    }
    $new_array = array_values($new_array);
    return $new_array;
   }
}