<?php

require_once("Android.php");
$droid = new Android();

class Liaison{
private $_scannes=array();
private $_trouve=FALSE;
//private $_result=array(0,0);


public function __construct($pieceDebut,$pieceFin)
{
$this->fureter($pieceDebut,$pieceFin);
$this->_pieceDebut=$pieceDebut;
$this->_pieceFin=$pieceFin;
$this->_pieces=new PieceStore;
 }
 
 
 
 public function fureter($pieceDebut,$pieceFin){
if(!($this->_trouve)){
$pieceDebut->portes();
foreach($pieceDebut->_portes as $porteD)
 {
 //$piece=new Piece($porteD,$pieceDebut->_pathParent);
// $this->_pieces->attach($piece);
// var_dump($this->_piece);
 $porteD=trim($porteD);
// $this->_scannes[]=$porteD;
echo $this->_trouve."\t".$porteD/*." --- ".$pieceFin->_nom*/."\n";
 if ($porteD==$pieceFin->_nom)
  {
  echo "Trouvé";
  $this->_trouve=TRUE;
  break;
  }
  elseif
  (
   (
   !in_array(
   $porteD,$this->_scannes
             )
   )
   
  )
   {if(!$this->_trouve){
   $this->_scannes[]=$porteD;
   $porteDep = new Piece($porteD,$pieceDebut->_pathParent);
   ;
   $this->fureter($porteDep,$pieceFin);
   }}else{//$this->_result[$porteD]=$this->_result[$porteD]-1;
   }
  }
  }
  else{
 
  return $this->_scannes;
  }

}

 
 
 
 ///////////////////////////////
 
 
 
 public function etablir(){
 
 $this->_pieces->attach($this->_pieceDebut);
//$this->_portes $this->cherchePortes($pieceDebut);
// $this->creerPieces();
 //si piece=pieceFin->trouve affiche result
 //sinon 
 
 
 
 
 
 
 
 
 
 var_dump($this->_pieces);
 }
 
public function fureter1($pieceDebut,$pieceFin){
if($this->_trouve==FALSE){

//var_dump($this->_result);
//echo $this->_trouve;
//echo $pieceDebut->_nom."\n";
//echo $pieceFin->_nom."\n";
$pieceDebut->portes();
foreach($pieceDebut->_portes as $porteD)
 {
 //if($this->_result[$porteD]){
//$this->_result[$porteD]=$this->_result[$porteD]+1;
//}
//else{$this->_result[$porteD]=0;
//}
 
 
// var_dump($pieceDebut->_portes);
 $porteD=trim($porteD);
 echo "\t".$porteD." --- ".$pieceFin->_nom."\n";
 if ($porteD==$pieceFin->_nom)
  {
  echo "Trouvé";
  $this->_trouve=TRUE;
  break;
  }
  elseif
  (
   (
   !in_array(
   $porteD,$this->_scannes
             )
   )
   &&($this->_trouve==FALSE)
  )
   {
   $this->_scannes[]=$porteD;
 //  $this->_result[$porteD]=($this->_result[$porteD])+1;
   //echo "$".$porteD."-liaison";
   $porteDep = new Piece($porteD,$pieceDebut->_pathParent);
   ;
   $this->fureter($porteDep,$pieceFin);
   }else{//$this->_result[$porteD]=$this->_result[$porteD]-1;
   }
  }
  }
  else{
 
  return $this->_scannes;
  }
// echo"**&&&&&*&*&";
 // var_dump($this->_result);

}
 
 
}

/*
echo $pieceFin->_nom."\n";
$pieceFin->portes();
foreach($pieceFin->_portes as $porteF)
{
 echo "\t $porteF \n";
}
 $this->_aScanner;
 $this->_scannes;


}*/
