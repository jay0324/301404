<?php
//param==================================================================
//=======================================================================
$mode_debug = false; //debug mode
$mode_404 = true; //set no match mode (true: 404, false: 301)

//301 if keyword redirect to new path place keyword ^% in front of value
$rules = array(
"301_check_path_key" =>"301_replace_path_key"
);

$redirect_301 = "301.html"; //301 redirect
//main===================================================================
//=======================================================================
$redirect = "404.html"; //404 view
$requestUri = urldecode(substr($_SERVER['REQUEST_URI'], 1));
$originalPath = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$match = false;
foreach ($rules as $key => $value) {
    $newPath = '';

    //redirect matched url
    if (preg_match("#" . $key . "#i", $originalPath)) {
        $match = true;

        //if new path start with ^% redirect to path
        if (substr($value,0,2) == '^%'){
          $newPath = str_replace('^%', '', $value);
        }else{
          $newPath = str_replace($key, $value, $originalPath);
        }

        if (!$mode_debug) header("Location: " . $newPath, false, 301); die;
    } 

    //debug msg
    if ($mode_debug) echo '# find: ['.$key.'] in ['.$originalPath.'] result: ['.preg_match("#" . $key . "#i", $originalPath).'] redirect: ['.$newPath.']<br>';
}

if ($mode_debug) die();

// echo 404 and guide user to correct page
if ($match === false) {
    if ($mode_404){
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