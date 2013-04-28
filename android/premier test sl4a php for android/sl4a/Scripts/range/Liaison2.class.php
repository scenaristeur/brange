<?php

require_once("Android.php");
$droid = new Android();

class Liaison{

public function __construct($pieceDebut,$pieceFin){
$this->_pieceDebut=$pieceDebut;
$this->_pieceFin=$pieceFin;
$this->trouver($this->_pieceDebut,$this->_pieceFin);
}

public function trouver($debut,$fin){

if($debut->_nom==$fin->_nom){
echo "TROUVE :".$this->_soluce;
}else
{
$this->_Dportes=$debut->portes();
$this->_tabD[$debut->_nom]=$this->_Dportes;
$this->_Fportes=$fin->portes();
$this->_tabF[$fin->_nom]=$this->_Fportes;
}

var_dump($this->_tabD);
var_dump($this->_tabF);

}

}