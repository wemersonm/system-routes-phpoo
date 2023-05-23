<?php

use app\support\Csrf;

function getCsrf(){
   return Csrf::getToken();
}