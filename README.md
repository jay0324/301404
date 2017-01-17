# 301404
This script provide a 404 page with 301 redirect method

you need first setup your server to handle 404 not found redirect from server config or .htaccess, and when page is not found this php script page will check 301 redirect rule and rewrite the original uri and redirect it with 301 header

# How to use
```

//301 redirect rule
$rules = array(
"301_check_path_key" =>"301_replace_path_key"
);
```

#Example
- with a uri 
```
http://host.com/doc.html => http://host.com/newdoc.html
```
set rule like
```
$rules = array(
"doc.html" =>"newdoc.html"
);
```
- with many uri with same rule
```
http://host.com/doc_123.html => http://host.com/newdoc/123.html
http://host.com/doc_234.html => http://host.com/newdoc/234.html
http://host.com/doc_456.html => http://host.com/newdoc/456.html
```
set rule like
```
$rules = array(
"doc_" =>"newdoc/"
);
```

- with many uri with a key word redirect to same page
```
http://host.com/docx_123.html => http://host.com/newdoc.html
http://host.com/docx_234.html => http://host.com/newdoc.html
http://host.com/docx_456.html => http://host.com/newdoc.html
```
set rule like
```
$rules = array(
"docx_" =>"^%newdoc.html"
);
```

- Rule is considered by its order
```
$rules = array(
"doc.html" =>"newdoc.html",
"doc_" =>"newdoc/",
"docx_" =>"^%newdoc.html"
);
```