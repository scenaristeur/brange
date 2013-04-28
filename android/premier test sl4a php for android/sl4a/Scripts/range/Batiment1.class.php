<?php

require_once("Android.php");
$droid = new Android();

class Batiment{
private $_id;
private $_nom="Batiment non identifie";
private $_affectation; //pro ou particulier
private $_typeBatiment;// maisom. atelier. usine
private $_gps;
private $_pieces;
private $_type;
private $_portes;

public function __construct(){
$this->_pieces= new SplObjectStorage();

}
public function creerBatiment(){
$this->_nom="Inconnu";
include('dialogue/Nommer.php');
echo "Nom : ".$this->_nom;
do{
require("dialogue/DetailBatiment.php");
echo "Batiment : ".$this->_type."\n";
if($this->_type!="STOP"){
$this->nouvellePiece($this->_type, $this->_nom);}else{
Range::demarrage();
}

}
while(($this->_type)!="STOP");
$this->listePieces();
}

public function nouvellePiece($type, $nomBatiment){
//echo "nouvelle piece";
$piece=new Piece($type, $nomBatiment);
$this->_pieces->attach($piece);
}

function listePieces(){
echo "Voici les pièces de ".$this->_nom;
var_dump($this->_pieces->count());
$this->_pieces->rewind(); 
while($this->_pieces->valid()) { 
$index = $this->_pieces->key();
 $object = $this->_pieces->current(); //similar to current($s) 
 $data = $this->_pieces->getInfo();
echo "//".$object->affiche();
/*var_dump($object); 
var_dump($data);
*/
$this->_pieces->next(); 
} 
}

public function correspondancePortes(){}


}