<?php

require_once("Android.php");
$droid = new Android();

class Parcours1{
private $_debut;
private $_fin;
private $_result;
private $_possible;
private $_ascanner;
private $_connu;
private $_pasPossible;
private $_pathParent;
private $_portes;
private $_compteur;
private $_trouve=False;

function __construct(Piece $deb,Piece $fin){
$this->_debut=$deb;
$this->_fin=$fin;
$this->_pathParent=$deb->getPathParent();
if ($deb->getNom()==$fin->getNom())
    {echo "termine \n";
    $this->_result[]=$deb->getNom();
    }
else{
     $this->_ascanner=new PieceStore;
     $this->_connu=new PieceStore;
     $this->_possible=new PieceStore;
     $this->_pasPossible=new PieceStore;
     $this->_ascanner->attach($deb);
     $this->scanner($this->_ascanner);
    }
}

function scanner($ascanner){
$this->_compteur++;
$this->_ascanner=$ascanner;
$this->_ascanner->rewind();
//while($this->_ascanner->valid()){
 // var_dump($ascanner);
 $current=$this->_ascanner->current();
 $portes=$current->getPortes();
 $nbPortes=$current->getNbPortes();
// $nomSynthese[]=$nbPortes;
 $this->_synthese[$current->getNom()]=$nbPortes;
 
 $parent=array();
 echo $current->getNom()." ".$current->getNbPortes()."\n";
 $parent[]=$current;
 $parent[]=$current->getNbPortes();
 //var_dump($portes);
 foreach($portes as $porte){
 if (($porte)<>($this->_fin->getNom())){
  $piece=new Piece($porte,$this->_pathParent);
  
   if(!($this->_connu->contains($piece))){
    $piece->setParcoursParent($parent);
    $this->_possible->attach($piece);
   // $this->_possible[$piece]->setInfo($parent);
    }
  }else{
  echo "trouve";
  $this->_trouve=True;
  // vider ascanner
 // $this->_ascanner->removeAll($this->_ascanner);
  }
  

  
  
 }
echo "\n";
  foreach($this->_possible as $room){
  $room->getPortes();
  echo $room->getNom()." ".$room->getNbPortes()." portes\n";
  if ((($room->getNbPortes())>1)){
  echo "la";
  if (!array_key_exists($room->getNom(),$this->_synthese)){
  
     //echo $this->_connu->contains($room);
     $this->_ascanner->attach($room);
     }
    }
    else{
    echo "nbPortes=<1 \n";
   
    list($parentNom,$nbPortes)=$room->getParcoursParent();
    // enlever une porte a parent
    $this->_synthese[$parentNom->getNom()]--;
    
   // $nbPortes--;
    //echo "Parent -1 : ".$parentNom->getNom()." ".$nbPortes."\n";
   // $parent=array();
    //$parent[]=$parentNom;
   // $parent[]=$nbPortes;
    $piece->setParcoursParent($parent);
    $this->_possible->detach($room);
    $this->_pasPossible->attach($room);
    }

  }
 



 $this->_ascanner->rewind();
 $this->_connu->attach($this->_ascanner->current());
 $this->_ascanner->detach($this->_ascanner->current());
// $this->scanner($this->_ascanner);
 //}
 //var_dump($this->_possible);
// var_dump($this->_ascanner);
//var_dump($this->_connu);
  $this->afficheAScanner();
  $this->affichePossible();
  $this->afficheConnu();
  $this->affichePasPossible();
  var_dump($this->_synthese);
while(($this->_compteur<32)&&($this->_trouve<>True)){
$this->_possible->removeAll($this->_possible);
$this->scanner($this->_ascanner);

}
}

public function getResult(){
return $this->_result;}

public function affichePossible(){
echo "Possibles :";
foreach($this->_possible as $possible){
echo $possible->getNom()."--->";
}
echo "\n";
}
public function afficheConnu(){
echo "Connu :";
foreach($this->_connu as $connu){
echo $connu->getNom()."(".$this->_synthese[$connu->getNom()].")--->";
}
echo "\n";
}
public function afficheAScanner(){
echo "A Scanner :";
foreach($this->_ascanner as $ascanner){
echo $ascanner->getNom()."--->";
}
echo "\n";
}
public function affichePasPossible(){
echo "Pas Possibles :";
foreach($this->_pasPossible as $paspossible){
echo $paspossible->getNom()."--->";
}
echo "\n";
}

}