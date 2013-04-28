<?php
class Piece{


private $_id;
private $_nom;// pour fonction nommer
private $_batiment;
//private $_nomPiece="non defini";
private $_type;

private $_nombrePortes; // pour determiner les accès 
/*
private $_forme; // piece rectangle par defaut
private $_longueur;
private $_largeur;o
private $_hauteur;
private $_couleurSol;
private $_couleurMurs;*/
private $_panorama;
private $_nomBatiment;

public function __construct($type, $nomBatiment){
$this->_nomBatiment=$nomBatiment;
$droid = new Android();
$this->_type=$type;
include('dialogue/Nommer.php');
$this->_nomPiece=$this->_nom;
include('dialogue/NombrePortes.php');
$this->_panorama=new Panorama($this->_nomBatiment, $this->_nomPiece, $this->_type);
}

public function affiche(){
echo "Une pièce de type ".$this->_type." avec ".$this->_nombrePortes." porte(s)\n";
}
}