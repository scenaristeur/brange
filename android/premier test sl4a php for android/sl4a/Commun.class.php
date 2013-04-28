<?php

require_once("Android.php");
$droid = new Android();
class Commun{

private $_fichiers;
private $_repertoires;
private $_entrees;

function ScanDirectory($Directory){
//echo $Directory."=repertoire";
$MyDirectory = opendir($Directory) or die('Erreur');
 while($Entry = @readdir($MyDirectory)) {
if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
echo $Directory."/".$Entry."\n";
// echo '<ul>'.$Directory;
$this->_repertoires[]=$Directory;
$this->_entrees[]=$Entry;
$this->ScanDirectory($Directory.'/'.$Entry);
// echo '</ul>'; 
echo "\n";
} else { 
//echo '<li>'.$Entry.'</li>'; 
if( $Entry != '.' && $Entry != '..') {
$this->_fichiers[]=$Entry;
echo $Entry."\n";}
}
 }
 closedir($MyDirectory); 
//var_dump($this->_entrees);
//var_dump($this->_repertoires);
//var_dump($this->_fichiers);
}

public function getEntrees(){
return $this->_entrees;}
public function getRepertoires(){
return $this->_repertoires;}

}
//$path='/sdcard/sl4a';
//$list= new Commun;
//$list->ScanDirectory("/sdcard/_ExternalSD/Range/Robots/Type");