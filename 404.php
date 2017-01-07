<?php
//param==================================================================
//=======================================================================
//404
$redirect = "404_redirect_path";

//301
$rules = array(
"301_check_path_key" =>"301_replace_path_key"
);

//main===================================================================
//=======================================================================
$requestUri = urldecode(substr($_SERVER['REQUEST_URI'], 1));
$originalPath = $_SERVER['REQUEST_URI'];
$match = false;
foreach ($rules as $key => $value) {
    //redirect matched url
    if (preg_match("#" . $key . "#i", $requestUri)) {
        $match = true;
        $newPath = str_replace($key, $value, $originalPath);
        header("Location: " . $newPath, false, 301);
    } 
}

// echo 404 and guide user to correct page
if ($match === false) {
    header("HTTP/1.0 404 Not Found");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <META http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta http-equiv=refresh content="5;url=<?php echo $redirect ?>">
    <title>404 Page Not Found</title>
    <style type="text/css">
        #note_404{margin:50px}#note_404 .mark{display:block;width:200px;height:200px;text-align:center;font-size:80px;background:#26B7D2;color:#fff;padding:20px;box-sizing:border-box;-webkit-border-radius:50%;-khtml-border-radius:50%;-moz-border-radius:50%;-ms-border-radius:50%;-o-border-radius:50%;border-radius:50%;-webkit-box-shadow:1px 1px 1px #1A8EA5;-khtml-box-shadow:1px 1px 1px #1A8EA5;-moz-box-shadow:1px 1px 1px #1A8EA5;-ms-box-shadow:1px 1px 1px #1A8EA5;-o-box-shadow:1px 1px 1px #1A8EA5;box-shadow:1px 1px 1px #1A8EA5;text-shadow:-1px -1px 1px #1A8EA5}#note_404 .mark::before{content:'';display:inline-block;vertical-align:middle;height:100%}#note_404 .mark span{vertical-align:middle}#note_404 .msg{margin:20px;font-size:30px;color:#1A1A1A}
    </style>
</head>
<body>

    <center>
        <div id="note_404">
            <div class="mark"><span>404</span></div>
            <div class="msg">Page Not Found!</div>
        </div>
    </center>

</body>
</html>

<?php
}
?>