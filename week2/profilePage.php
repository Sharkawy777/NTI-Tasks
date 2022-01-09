<?php

//$CookieValue = explode(',', $_COOKIE['student']);
//
////foreach ($CookieValue as $key => $value) {
////    echo '> ' . $key . ' : ' . $value . '<br>';
////}
//
//foreach ($CookieValue as $value) {
//    echo $value . '<br>';
//}

echo "<h1> Blog </h1>";
echo "<a href='profilePage.php'>Create Article</a> || ";
echo "<a href='test.php'>Delete all Article</a><br>";

$file = fopen('text.txt',"r") or die('unable to open file');
while(!feof($file)) {
    $l = fgets($file);
    echo $l."<br>";
}
//echo fread($file,filesize('text.txt'));

fclose($file);