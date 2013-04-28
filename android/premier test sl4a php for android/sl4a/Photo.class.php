<?php

require_once("Android.php");
$droid = new Android();

class Photo{
const version=1;

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

public function prendre(){
$droid = new Android();
$path=Range::_racine."/tmp/1.jpg";
echo $path;
$image=$droid->cameraCapturePicture($path);
var_dump($image);
//sleep(3);
$tab=array("Objet","Environnement","Instruction","Utilisateur");
$droid->dialogCreateAlert("Cette photo représente: ", null);
$droid->dialogSetItems($tab);
$droid->dialogShow();
$this->_type=$droid->dialogGetSelectedItems();
var_dump($this->_type);
// traitement de la photo selon son type

}

}
