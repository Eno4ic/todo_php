<?php

$page_name = 'main';
$uri_array = explode('/',$_SERVER['REQUEST_URI']);

if($uri_array[1])
    $page_name = $uri_array[1];
if(file_exists("views/". $page_name .".php"))
    include_once "views/". $page_name .".php";
else
    http_response_code(404);