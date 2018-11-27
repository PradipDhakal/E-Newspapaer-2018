<?php

if (!function_exists(   'To')){

    function To($path=''){
          if (empty($path)) return false;

          $path=explode('/',$path);

          $redirectPath=BASE_URL.$path[0].'/'.$path[1];
          echo $redirectPath;
          header('location:'.$redirectPath);
         exit();
    }


}