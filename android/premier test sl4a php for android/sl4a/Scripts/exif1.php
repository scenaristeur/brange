<?php

require_once("Android.php");
$droid = new Android();

 echo "test1.jpg:<br />\n";
 $exif = exif_read_data('$this->_path', 'IFD0');
 echo $exif===false ? "No header data fou >\n" : "Image contains headers<br />\n";

$exif = exif_read_data('$this->_path', 0,true);
 echo "test2.jpg:<br />\n"; 
foreach ($exif as $key => $section) { foreach ($section as $name => $val) {
 echo "$key.$name: $val<br />\n"; } } ?>