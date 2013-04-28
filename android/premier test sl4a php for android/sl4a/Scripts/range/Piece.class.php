<?php

require_once("Android.php");
$droid = new Android();

class Piece{

public function __construct($nom,$pathParent){
$this->_nom=$nom;
$this->_pathParent=$pathParent;
$this->_pathParentLigne=implode("/",$pathParent);
//echo $this->_pathParentLigne."/".$this->_nom."\n";

//$this->_compteur=0;
}

public function getNom(){
return $this->_nom;}
public function getPathParent(){
return $this->_pathParent;}
public function getPathParentLigne(){
return $this->_pathParentLigne;}

public function getNbPortes(){
$fichier=$this->_pathParentLigne."/".$this->_nom."/portes.txt";
$this->_nbPortes=0;
if (!file_exists($fichier))
 {
//echo "pas de fichier portes.txt pour ".$this->_nom."\n";
$this->_portes=array();

 }
else
 {
$fichierPortes=file($fichier);
$this->_nbPortes=count($fichierPortes);
}
return $this->_nbPortes;
}




public function getPortes(){
$fichier=$this->_pathParentLigne."/".$this->_nom."/portes.txt";
if (!file_exists($fichier))
 {
//echo "pas de fichier portes.txt pour ".$this->_nom."\n";
 $this->_portes=array();
 }
else
 {
$listePortes=file($fichier);
foreach($listePortes as $key=>$porte)
  {
$this->_portes[$key]=trim($porte);
}}
return $this->_portes;
}

public function setParcoursParent($parent){
$this->_parcoursParent=$parent;}
public function getParcoursParent(){
return $this->_parcoursParent;}

}