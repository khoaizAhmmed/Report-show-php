<?php

use App\Core\App;

App::bind('config',require 'config.php');
App::bind('database',new QueryBuilder(Connection::make(App::get('config')['database'])));
App::bind('api',App::get('config')['api']);



function view($name,$data = [])
{
  extract($data);
  return require "App/views/{$name}.view.php";
}


function redirect($path)
{
  header("Location: /{$path}");
}