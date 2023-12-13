<?php

use Illuminate\Support\Facades\Route;

if (! function_exists("isActive")) {
  function isActive($key,$Activeclassname='active'){
    if (is_array($key)) {
        return in_array(Route::currentRouteName(),$key)?$Activeclassname:"";
     }
return Route::currentRouteName()==$key?$Activeclassname:"";

  }  
}


