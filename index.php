<?php

 require 'vendor/autoload.php';
 require 'core/bootstrap.php';

use App\Core\{Router,Request};

Router::load('routers.php')

->direct(Request::uri(), Request::method());
