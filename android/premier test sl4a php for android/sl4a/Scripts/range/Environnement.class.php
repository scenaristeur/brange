<?php

require_once("Android.php");
$droid = new Android();

class Environnement{
private $_version=1;

private $_path;

public function __construct(){
$this->_path=Range::_racine."/Environnements";

}

public function configEnv(){
$result="";
$env=new Environnement;
$droid = new Android();
$droid->dialogCreateAlert("Configuration des environnements :");
$confEnv = array("Ajouter un environnement", "Modifier un environnement");
$droid->dialogSetItems($confEnv);
$droid->dialogShow();
$result = $droid->dialogGetResponse();
$confEnv=$confEnv[$result['result']->item];
switch($confEnv){
case "Ajouter un environnement":
$env->add();
$env->configEnv();
break;
case "Modifier un environnement":
$env->modif();
$env->configEnv();
break;
default:
break;
}
}

public function add(){
$path=$this->_path;
$droid = new Android();
$droid->dialogCreateAlert("Création d'un nouvel environnement","L'environnement que vous souhaitez créer dépend-il d'un environnement connu ?");
$droid->dialogSetPositiveButtonText('Oui');
$droid->dialogSetNegativeButtonText('Non');
$droid->dialogShow();
$result=$droid->dialogGetResponse();
$connu=$result['result']->which;
switch ($connu){
case "positive":
$path=$this->calculPath($path);
$this->repertoireDefaut(); 
break;
case "negative";
$this->repertoireDefaut();
break;
default:
$this->configEnv();
break;
}
//si existe changer de nom ou fusionner
}

public function modif(){

$this->select();
$this->_nom=$this->_select;
$droid = new Android();
   $droid->dialogCreateAlert("Modification de ".$this->_nom." :");
         $modif= array("Modifier le nom", "Déplacer", "Localiser","Panorama","Fusionner","Gérer les accès","Supprimer");
         $droid->dialogSetItems($modif);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();

$this->_modif=$modif[$result['result']->item];
switch ($this->_modif){
case "Modifier le nom":
$this->modifNom();
 break;
 case "Déplacer":
 
  break;
case "Localiser":
if($droid->wifiStartScan()){
$this->checkReseau();}
$this->locate();
echo $this->_nom." localisé";

break;
case "Panorama":
$this->voirPanorama();
break;
case "Fusionner":
break;

case "Gérer les accès":

break;
case "Supprimer":
$this->del();
break;
default:
//EnvironnementStore::configEnv();
break;
}

}

public function del(){

$droid = new Android();
$droid->dialogCreateAlert("Voulez-vous vraiment supprimer ".$this->_select."?");
$droid->dialogSetPositiveButtonText('Supprimer');
$droid->dialogSetNegativeButtonText('Annuler');

$droid->dialogShow();
$result=$droid->dialogGetResponse();


//foreach ($result['result'] as $attribut => $valeur) { 
//echo '<strong>', $attribut, '</strong> => ', $valeur;
//if ($attribut=="which"){
switch($result['result']->which) {
 case 'positive':
$ancien=$this->_parent."/".$this->_nom;
$poubelle=Range::_racine."/~Trash/".$this->_nom."-".time();
 sleep(1);
rename($ancien,$poubelle);
break;
}}

public function reconnaissance(){
$recEnv= new Vision;
$recEnv->envReco();
echo "\n";
}

public function voirPanorama(){
$droid = new Android();
echo $this->_path;
$MyDirectory = opendir($this->_path) or die('Erreur');
 while($Entry = @readdir($MyDirectory)) {
if(strstr($Entry,"panorama-".$this->_nom)){
var_dump($Entry);
//echo "panorama-".$this->_nom;
//$pic=$droid->pick($Entry);
echo $this->_path."/".$Entry;

$pic=$droid->view($this->_path."/".$Entry);
var_dump($pic);

}
}




}
// Outils

public function trouve($aTrouver){
$this->_path=Range::_racine."/Environnements";
$this->ScanDirectory($this->_path,0,FALSE);
//$aTrouver=$this->apure($aTrouver);
//echo $aTrouver;
$aChercher=str_word_count($aTrouver,1,"çî");
$aChercher=$this->apureTab($aChercher);
$i=0;
$j=0;
foreach($aChercher as $morceau){
foreach($this->_listeRep as $candidat){
//foreach($morceau as $mot){
//var_dump($morceau);
//echo $candidat."\t".$mot."\n";
if((strstr($candidat,$morceau)&&($morceau<>"la"))){
//$ok[]=($candidat,$morceau);
//echo $ok;
//$this->_trouve[$i][0]=$morceau;
//$this->_trouve[$i][$j]=$candidat;
$this->_trouveDans[]=$candidat;
//$this->_route[]=$this->_listeChemins[$j];
//var_dump($this->_listeChemins);
//echo $this->_listeChemins[$j];
//}
}
$j++;}
$i++;}

//var_dump($aChercher);
//var_dump($this->_trouveDans);
$this->_trouve=array_count_values($this->_trouveDans);
arsort($this->_trouve);
//var_dump($this->_trouve);
//$this->_probable[][]=array();
$i=0;
foreach($this->_trouve as  $endroit=>$score){
//echo $endroit."\t".$score."\n";
$endroits[$i]=array($endroit,$score);
$i++;
}
//var_dump($endroits[0][0]);
echo "Probable ou chercher : ".$endroits[0][0]."\n";
$this->_probable=$endroits[0][0];
//echo $this->_listeChemins[$this->_probable]."\n";
$this->_path=$this->_listeChemins[$this->_probable];
}

public function apure($texte){
$aSupprimer=array("dans","la","le","les","de","des");
foreach($aSupprimer as $supprime){
echo $aSupprimer." ".$texte;
$texte=str_replace($supprime,"",$texte);
//var_dump($texte);
}
return $texte;
}

public function apureTab($tab){
$aSupprimer=array("dans","la","le","les","de","des");
foreach($tab as $key=>$mot){
foreach($aSupprimer as $present){
if($mot==$present){
unset($tab[$key]);}}
//echo $aSupprimer." ".$texte;
//$texte=str_replace($supprime,"",$texte);
//var_dump($texte);

}
$tab=array_values($tab);
//var_dump($tab);
return $tab;
}

public function select(){
$this->calculPath($this->_path);
echo "modif de ".$this->_select;

}

public function calculPath($path){
//affiche les env dans le path
//require('Scripts/scan.php');
$scan=array();
$scan=$this->ScanDirectory($path,1,TRUE);
//var_dump($scan);
$tab=$this->_listeRep;
$droid = new Android();
$droid->dialogCreateAlert("Sélectionnez un environnement", $path);
$droid->dialogSetItems($tab);
$droid->dialogSetPositiveButtonText('Choisir');
$droid->dialogSetNegativeButtonText('Annuler');
$droid->dialogShow();
$result=$droid->dialogGetResponse();

foreach ($result['result'] as $attribut => $valeur) { 
//echo '<strong>', $attribut, '</strong> => ', $valeur;
if ($attribut=="which"){
switch($result['result']->which) {
 case 'positive':
 $this->_path=$path;
 return $this->_path;
 break;
 case 'negative':
 break;
 }}else{
$reponse=$tab[$result['result']->item];
$this->_listeRep=array();
$this->_select=$reponse;

$this->calculPath($path."/".$reponse);
}
}}


function ScanDirectory($Directory,$profondeur,$fichiers){
//si profondeur =0 pas de limite
$profondeur--;
// fichiers affiche les fichiers bool
//echo $Directory."=repertoire";
$MyDirectory = opendir($Directory) or die('Erreur');
 while($Entry = @readdir($MyDirectory)) {
if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
$this->_rep=$Entry;
$this->_parent=$Directory;
$chemin=$Directory."/".$Entry;
$this->_listeRep[]=$this->_rep;
$this->_listeChemins[$this->_rep]=$chemin;
//affiche repertoires
//echo $rep."\n";
// echo '<ul>'.$Directory;
if($profondeur<>0){
$this->ScanDirectory($Directory.'/'.$Entry,$profondeur,$fichiers);}
// echo '</ul>'; 
//echo "\n";
} else { 
//echo '<li>'.$Entry.'</li>'; 
if( $Entry != '.' && $Entry != '..') {
//affiche fichiers
//echo $Entry."\n";
$this->_listeFichiers[]=$Entry;
}
}
 }
 closedir($MyDirectory); 
 if($this->_listeRep){
 $retour[0]=$this->_listeRep;}
 if($this->_listeFichiers){
 $retour[1]=$this->_listeFichiers;}
 if($this->_listeChemins){
 $retour[2]=$this->_listeChemins;}
 return $retour;
}

public function repertoireDefaut(){
$droid = new Android();
$name = $droid->dialogGetInput('Donnez-lui un nom : ');
$this->_nom= $name['result'];
$path=$this->_path."/".$this->_nom;
//$path=$path."/".$this->_nom;
if (mkdir($path)){
$fconf=fopen ($path."/config.txt","w");
$ligne="vide \n";
fputs($fconf,$ligne);
}else{echo "creation du repertoire impossible";};

}

public function modifNom(){
$droid = new Android();
$droid->dialogGetInput("Changement de nom de l'environnement", $this->_nom, $this->_nom);
 $result = $droid->dialogGetResponse();
$nouveauNom= $result['result']->value;
$ancien=$this->_parent."/".$this->_nom;
$nouveau=$this->_parent."/".$nouveauNom;
 sleep(1);
rename($ancien,$nouveau);


}
// getters &setters

public function getPath(){
return $this->_path;}

}




