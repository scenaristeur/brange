<?php

require_once("Android.php");
$droid = new Android();

class Parcours{

public function __construct(){
$this->_phase="début";
$this->_egalite=FALSE;
$this->_chemin=array();
$this->_connu=array();
$this->_exclus=array();
$this->_limite=0;
$this->_possibles=array();



}
public function determine($debut,$fin)
{

 $this->_limite++;
$this->_debut=$debut;
$this->_fin=$fin;
   if($this->_egalite==TRUE){
 // echo  " termine ".$this->_debut->getNom();
/*   if(($this->_connu[count($this->_connu)-1])<>$this->_fin->getNom()){$this->_connu[]=$this->_fin->getNom();}*/
//ici
//var_dump($this->_chemin);
   return $this->_chemin;
   }else{
  


$this->_pathParent=$this->_debut->getPathParent();
echo $this->_debut->getNom()." ".$this->_debut->getNbPortes()." ".$this->verifie($this->_debut)." ".$this->_fin->getNom()."\n";
$this->calculConnu($this->_debut);
//$this->calculPossible($this->_debut);
 $this->_portes=$this->_debut->getPortes();
 if($this->verifie($this->_debut)<>"=")
 {
 foreach($this->_portes as $porte)
  {

   $this->_piece =new Piece (trim($porte),$this->_pathParent);
 echo $this->_piece->getNom()." ".$this->_piece->getNbPortes();
   if((in_array($this->_piece->getNom(),$this->_connu))&&!(in_array($this->_piece->getNom(),$this->_chemin)))
 {$this->_chemin[]=$this->_piece->getNom();

 }

   
   
   
   if((!in_array($this->_piece->getNom(),$this->_connu))&&($this->verifie($this->_piece)<>"="))
    {
   $this->calculPossible($this->_piece);}
   //  if((in_array($this->_piece->getNom(),$this->_connu))&&($this->verifie($this->_piece)<>"="))
   // { $this->_chemin=$this->_piece->getNom();
    
  //  }
 echo "\n";

   }

  if(count($this->_possibles)>0)
   {
   foreach($this->_possibles as $key=>$possible)
     {$this->_piece=new Piece($possible,$this->_pathParent);

   // var_dump($this->_possibles);
    unset($this->_possibles[$key]);
    $this->_possibles=array_values($this->_possibles);
   // var_dump($this->_possibles);
 
    $this->determine($this->_piece,$this->_fin);
    
     }
     //$this->_possibles[]=array();
     }
      

  
   }
  }
 }

public function calculPossible($piece){
if(
   ($this->verifie($piece)<>"=")
   &&($piece->getNbPortes()>1)
   &&(!in_array($piece->getNom(),$this->_possibles)
   )
  )
 {$this->_possibles[]=$piece->getNom();
 
 }
}

public function calculConnu($piece){

if(!in_array($piece->getNom(),$this->_connu))
 {$this->_connu[]=$piece->getNom();
 }

}


public function determine1($debut,$fin){
//echo $this->_phase."\n";
$this->_debut=$debut;
$this->_fin=$fin;
if(in_array($this->_debut,$this->_connu))
{
//$this->_chemin[]=$this->_debut->getNom;
}
else
{
$this->_connu[]=$this->_debut->getNom();
$this->_DNom=$this->_debut->getNom();
$this->_FNom=$this->_fin->getNom();
$this->_Dnb=$this->_debut->getNbPortes();
$this->_Dportes=$this->_debut->getPortes();
$this->_DpathParent=$this->_debut->getPathParent();
echo $this->_DNom."\t";
echo $this->_Dnb;
echo "\t vers ".$this->_FNom;
echo "\n";
$this->verifie();
$this->_limite++;
if(($this->_limite<20)&&($this->_egalite==FALSE))
 {
foreach ($this->_Dportes as $porte)
  {
  $porte=trim($porte);
  if((in_array($porte,$this->_connu))&&(!(in_array($porte,$this->_chemin))))
   {
   $this->_chemin[]=$porte;
   }
   
   if($porte==$this->_FNom)
   {
    $this->_egalite=TRUE;
   }
    else
   {$piece = new Piece($porte,$this->_DpathParent);
     if($piece->getNbPortes()<2)
     {
     $this->_exclus[]=$piece->getNom();
     //$this->_egalite=TRUE;
     }else
     {
     
    if(!in_array($piece->getNom(),$this->_connu))
      {
    $this->determine($piece,$this->_fin); 
       }
      }
   }
}
/*
  //echo "\t".$piece->getNom()." ".$piece->getNbPortes()."\n";
  if(!in_array($piece->getNom(),$this->_connu)
  &&($piece->getNbPortes()>1))
   {$this->_connu[]=$piece->getNom();
   if ($piece->getNom()==$this->_FNom){
 $this->_egalite=TRUE;}
//var_dump($this->_connu);
//var_dump($this->_chemin);
$parcours= new Parcours();
//$this->determine($piece,$this->_fin);
   }else{
        $this->_chemin[]=$piece->getNom();
       // echo "ajjoutr chemin".$piece->getNom();
        if ($piece->_getNom()==$this->_FNom){
 $this->_egalite=TRUE;}
        }*/
  }
 }
  return $this->_chemin;

}

public function resultat(){
 echo "Connus : ";
 foreach($this->_connu as $vu){
 echo $vu."...";}
 echo "\n";
 echo "Possibles : ";
 foreach($this->_possibles as $possible){
 echo $possible.">>>";}
 echo "\n";
 echo "Chemin : ";
 foreach($this->_chemin as $valide){
 echo $valide.">>>";}
 echo "\n";
}

public function verifie($piece){
if ($piece->getNom()==$this->_fin->getNom()){
 $this->_egalite=TRUE;
 
   if(!in_array(end($this->_connu), $this->_chemin)){$this->_chemin[]=end($this->_connu);}
   if(!in_array($this->_fin->getNom(),$this->_chemin)){$this->_chemin[]=$this->_fin->getNom();
   
   }
 
 
 
 
}
return $this->trouve();
}

public function initialise(){


}


public function trouve(){
if ($this->_egalite==TRUE){
return "=";
var_dump($this->_chemin);
}else{
return "<>";
}
}


}