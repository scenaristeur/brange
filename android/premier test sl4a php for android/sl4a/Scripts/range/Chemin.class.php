d<?php

require_once("Android.php");
$droid = new Android();

//$chem=new Chemin("cuisine";"entrée");

class Chemin{
const _version=1;


public function __construct($envO,$envD){
$this->_depart=$envO->_probable;
$this->_arrivee=$envD->_probable;
$this->_departPath=$envO->getPath();
$this->_arriveePath=$envD->getPath();
//$this->_pieces= new PieceStore;
}

public function determine(){
echo  "Calcul du chemin entre '".$this->_depart."' et '".$this->_arrivee."'\n";
echo $this->_departPath." ".$this->_arriveePath;
$tabDepart=explode("/",$this->_departPath);
$tabArrivee=explode("/",$this->_arriveePath);
//$tabDepart[]=$tabDep[0];
//$tabArrivee[]=$tabArr[0];
//var_dump($tabDepart);
//var_dump($tabArrivee);
$this->_commun=array_intersect($tabDepart,$tabArrivee);
$debut=array_values(array_diff($tabDepart,$tabArrivee));
///$result = array_diff($tabDepart, $tabArrivee);
$debut=array_reverse($debut);
//var_dump($debut);
//if(!$diff){echo "vide";}
//print_r($result);
//if(!$diff[0]){
$fin=array_values(array_diff($tabArrivee,$tabDepart));
//}
//var_dump($fin);
//echo 
$nbDebut=count($debut);
//echo 
$nbFin=count($fin);
if($nbDebut==0){
$liaisonD=$tabDepart;
echo "c'est la bonne pièce de départ\n";}
else{
$liaisonD=$debut[$nbDebut-1];}
if($nbFin==0){
$liaisonF=$arriveePath;
echo "c'est la bonne pièce de d'arrivée\n";}
else{$liaisonF=$fin[0];}
//var_dump($liaisonD);
//var_dump($liaisonF);
//var_dump($commun);
if ((count($debut)>0)&&(count($fin)>0))
{
//$this->suivrePortes($debut,$fin,$commun);
$pieceDebut= new Piece($debut[count($debut)-1],$this->_commun);
//$pieceDebut->_position="debut";
$pieceFin = new Piece($fin[0], $this->_commun);
//$pieceFin->_position="fin";
$parcours= new Parcours();
//$parcours->initialise();
$parcours->determine($pieceDebut,$pieceFin);
//$parcours->resultat();
$this->_liaison=$parcours->_chemin;
//echo "supprimer les pièces ne faisant pas partie du parcours";
//var_dump($debut);
//var_dump($this->_liaison);
//var_dump($fin);
if (end($debut)==$this->_liaison[0]){
unset($this->_liaison[0]);
$this->_fusion=array_merge($debut,$this->_liaison);}else{echo "Problème de fusion";}
if (end($this->_fusion)==$fin[0]){
unset($fin[0]);
$this->_fusion=array_merge($this->_fusion,$fin);}else{echo "Problème de fusion";}

//var_dump($this->_fusion);
//var_dump($this->_PIECES);
}
}
public function getCheminCalcul(){
return $this->_fusion;}
public function getCommun(){
return $this->_commun;}

public function suivrePortes($debut,$fin,$commun){
//echo "Liaison portes de : ".$debut[count($debut)-1]." \n vers ".$fin[0]."\n";
//$debut[count($debut)-1],$fin[count($fin)-1]);
//var_dump($debut);
//var_dump($fin);
$communPath=trim(implode("/",$commun));
//echo $communPath;

$debutPath=$communPath."/".$debut[count($debut)-1];
//echo $debutPath."\n";
$this->scanPortes($debut[count($debut)-1],$fin[0],$communPath);
$this->bloc=0;
}

public function scanPortes($debut,$fin,$communPath){
/* je suis dans une piece debut
je liste les portes que la piece possede
je regarde derriere chaque porte
pour chaque porte
si la porte mene vers fin alors je la traverse et je suis arrive.
si la porte mene vers une piece deja vueel je supprime la porte de la liste

sinon je passe la porte et je regarde s'il y a des portes. si oui je les ajoute a la liste
je recommence a regarder derriere chaque porte
*/



}

public function scanPortes1($debut,$fin,$communPath){
$fichier=$communPath."/".$debut."/portes.txt";
$this->parcouru[]=trim($debut);
var_dump($this->parcouru);
if (!file_exists($fichier))
 {
echo "pas de fichier portes.txt pour ".$debut."\n";
 }
else
 {
$debutPortes=file($fichier);
foreach($debutPortes as $key=>$porte)
  {
//   echo $passe=in_array(trim($porte),$this->parcouru);
  /* if($passe)
    {
   //  echo $porte." déjà vu";
    }
   else
    {*/
  //   echo $debut."->".$porte."\n";
     while ((trim($porte)<>trim($fin))&&($this->bloc<100))
     {if (!$passe){
      $this->bloc++;
      $this->scanPortes(trim($porte),$fin,$communPath);
     }else{echo "vu";
     $key++;
     $this->scanPortes(trim($debutPortes[$key]),$fin,$communPath);
     }
     }
    //}
   }
  }
 }


}








