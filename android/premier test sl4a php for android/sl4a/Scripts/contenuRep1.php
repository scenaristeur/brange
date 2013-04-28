<?php

require_once("Android.php");
$droid = new Android();


function ScanDirectory($Directory){
$liste=array();

//echo $Directory."=repertoire";
$MyDirectory = opendir($Directory) or die('Erreur');
 while($Entry = @readdir($MyDirectory)) {
if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
//echo $Entry;
$liste[]=$Entry;

// echo $Directory."/".$Entry."\n";
// echo '<ul>'.$Directory;
// suppression pour un seul niveau
//ScanDirectory($Directory.'/'.$Entry);
// echo '</ul>'; 
//echo "\n";
} else { 
//echo '<li>'.$Entry.'</li>'; 
if( $Entry != '.' && $Entry != '..') {
echo $Entry."\n";}
}
 }
 closedir($MyDirectory); 


return $liste;
}
//$path='/sdcard/sl4a';


