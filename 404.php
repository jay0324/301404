<?php
//param==================================================================
//=======================================================================
$404_mode = true; //set no match mode (true: 404, false: 301)

//301 if keyword redirect to new path place keyword ^% in front of value
$rules = array(
"301_check_path_key" =>"301_replace_path_key"
);

$redirect_301 = "301.html"; //301 redirect
//main===================================================================
//=======================================================================
$redirect = "404.html"; //404 view
$requestUri = urldecode(substr($_SERVER['REQUEST_URI'], 1));
$originalPath = $_SERVER['REQUEST_URI'];
$match = false;
foreach ($rules as $key => $value) {
    //redirect matched url
    if (preg_match("#" . $key . "#i", $requestUri)) {
        $match = true;

        //if new path start with ^% redirect to path
        if (substr($value,0,2) == '^%'){
          $newPath = str_replace('^%', '', $value);
        }else{
          $newPath = str_replace($key, $value, $originalPath);
        }

        header("Location: " . $newPath, false, 301);
    } 
}

// echo 404 and guide user to correct page
if ($match === false) {
    if ($404_mode){
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found"); 
        header("status: 404 not found");
        include($redirect);
        exit();
    }else{
        header($_SERVER["SERVER_PROTOCOL"]." 301 Moved Permanently");
        header("Location: ".$redirect_301);
        exit();
    }
}
?>