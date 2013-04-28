<?php

require_once("Android.php");


class Photo{

private $_numero;
private $_path;
private $_type; // solo, panorama ou objet 3d
private $_typeParent;

function takePhoto($numero, $path){
$droid = new Android();
mkdir($path);
Environnement::configTxt($path);
$this->_numero=$numero;
echo "prise de photo ".$this->_numero."\n";
$today = date("Y-m-d-H-i-s");
$this->_path=$path.($this->_numero).".jpg";

//$_image=$droid->cameraCapturePicture($this->_path, true);
echo "clicclac";

//echo $this->_path."\n";
//echo "ici EXIF\n";
//include('Scripts/exif.php');

}
}





