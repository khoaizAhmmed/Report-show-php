<?php

return [
  "database"=>[
    'name'=>'task_1',
    'username'=>'root',
    'password'=>'',
    'connection'=>'mysql:host=127.0.0.1',
    'options'=>[
      // Error Show For debug 
      PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
    ]
    ],

  "api"=>'https://raw.githubusercontent.com/Bit-Code-Technologies/mockapi/main/purchase.json',
  ];