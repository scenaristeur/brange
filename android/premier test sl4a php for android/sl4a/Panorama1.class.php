<?php

require_once("Android.php");
$droid = new Android();

class Panorama{

//matrice d'images
private $_images;
private $_image;
private $_nom;


public function __construct($_nomBatiment, $_nomPiece, $_typePiece){
$racine="/sdcard/_ExternalSD/Range/Environnements";

$nomBatiment=$_nomBatiment;
$nomPiece=$_nomPiece;
$typePiece=$_typePiece;
$chemin=$racine."/".$nomBatiment."/";
$this->creerFicConf($chemin);
//echo "prise de photo ".$this->_numero."\n";
$today = date("Y-m-d-H-i-s");
$this->_path=$racine;
if ($nomBatiment){$this->_path.="/".$nomBatiment;}
if ($typePiece){$this->_path.="/".$typePiece;}
if ($nomPiece){$this->_path.="/".$nomPiece;}
$this->_path.="/".$today."/";

$path=$this->_path;

// Un ensemble d'objets
 $this->_imagesPano = new SplObjectStorage();
for($i=1;$i<=3;$i++){
$photo= new Photo;
$photo->takePhoto($i, $path);
$this->_imagesPano->attach($photo);
}

/*var_dump($s->contains($o1));
 var_dump($s->contains($o2));
 var_dump($s->contains($o3));

$s->detach($o2);

var_dump($s->contains($o1));
 var_dump($s->contains($o2)); 
var_dump($s->contains($o3));
echo $s->getInfo($o3);*/
echo $this->_imagesPano->count();
echo "creation d'un panorama\n";
}

public function creerFicConf($chemin){
mkdir($chemin);
$file=$chemin."config.txt";
if (file_exists($file)) { 
echo "fichier conf deja cree";
}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier config.txt créé vide";
}
}


}