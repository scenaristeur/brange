<?php

require_once("Android.php");
$droid = new Android();

class Environnement{
private $_id;
private $_interieur=1;//int ou ext
private $_gps;
private $_batiment;
private $_piece;
private $_position;
private $_panorama;
private $_item;//position dans la piece
private $_nom;
private $_longitude;
private $_latitude;
private $_config; // tableau , voir a passer en ensemble d.objets?
private $_ssid;
private $_trouve;

public function __construct($nom,$config,$pathParent){
$this->_nom=$nom;
$this->_config=$config;
$this->_pathParent=$pathParent;
switch ($this->_config){
case "origine":

break;
case "destination":

break;
default:
/*
for($i=0;$i<sizeof($config);$i++)
{
list($param,$valeur)=explode(" : ",$config[$i]);
//echo $param." ".$valeur;
switch($param){
case "longitude":
$this->_longitude=$valeur;
break;
case "latitude":
$this->_latitude=$valeur;
break;
}}
*/

}

}
public function modif(){


$droid = new Android();

   $droid->dialogCreateAlert("Modification de ".$this->_nom." :");
         $modif= array("Modifier le nom", "Déplacer", "Localiser","Panorama","Fusionner","Gérer les accès");
         $droid->dialogSetItems($modif);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();

$this->_modif=$modif[$result['result']->item];
switch ($this->_modif){
case "Modifier le nom":
$droid->dialogGetInput("Changement de nom de l'environnement", $this->_nom, $this->_nom);
 $result = $droid->dialogGetResponse();
 //var_dump($result);
$nouveauNom= $result['result']->value;
$ancien=$this->_pathParent.$this->_nom;
$nouveau=$this->_pathParent.$nouveauNom;
// echo $ancien;
 //var_dump($ancien);
// echo $nouveau;
 sleep(1);
rename($ancien,$nouveau);

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

break;
case "Fusionner":
break;

case "Gérer les accès":

break;
default:
//EnvironnementStore::configEnv();
break;
}
}


function locate(){
echo"LOCALISATION ";
// create application instance
$app = new Application(array('scriptName' => 'OuSuisJe'));
// run application
$app->run();
//$this->_gps=$app->_gps;
//echo $this->_gps;
var_dump($this->_data[0]);
var_dump($this->_data[1]);

}

function connu1(){
$gpe= new EnvironnementStore();
$liste=$gpe->ScanDirectory(Range::_racine."Environnements",0);
foreach($liste as $entree){
echo $entree."\n";
}


}


function connu(){
var_dump($this->_nom);
// recherche si un env est connu
$gpe= new EnvironnementStore();
$liste=$gpe->ScanDirectory(Range::_racine."Environnements",0);
//var_dump($liste);
//var_dump($this->_nom);
$nomCherche=explode(" ",$this->_nom);
//$liste=$this->apure($liste);
//$nomCherche=$this->apure($nomCherche);
//var_dump($nomCherche);
//echo "chercher dans les alias \n";



for($i=0;$i<sizeof($nomCherche);$i++)
{echo "recherche de ".$nomCherche[$i]."\n";
for($j=0;$j<sizeof($liste);$j++)
{

//if (
if($pos=(strpos($liste[$j],$nomCherche[$i]))){
echo "\t".$liste[$j]." : ";
echo $pos."\n";}
//==0)
/*{
echo "TROUVE : ";
$this->_trouve++;
echo $this->_nom." ".$this->_trouve."\n";
}
else{
echo "pas trouve dans ";}
*/
//}
//var_dump($nomConnu);
}
}

//$comp=strcmp($this->_nom,$envir->_nom);
//echo $this->_nom." *** ".$envir." : ".$comp."\n";
}


function apure($tab){
for($i=0;$i<sizeof($tab);$i++){
echo "test supp";
if (strpos("dans le des les la de un une ",$tab[$i] ))
{
echo "supp ".$tab[$i]."\n";
unset ($tab[$i]);
}else {echo "pas supp \n";}
}
return ($tab);
}


public function affiche(){
echo "- ".$this->_nom."\n";
//echo $this->_longitude." ".$this->_latitude;


}

public function choisir(){
echo "@@@ environnement choisi:";
require("dialogue/SelectionEnvironnement.php");
echo $this->_environnement."\n";
switch ($this->_environnement)
{case "interieur":
$batiment= new Batiment;
$batiment->creerBatiment();
break;
case "exterieur":
echo "extérieur";
break;
case "mixte":
echo "mixte";
break;
case "reconnaissance":
echo "reconnaissance";
$panorama=new Panorama("Environnement","","");
break;
default:
$this->choisir();
}}

public function setPanorama(){



}
public function reconnaissance(){
$recEnv= new Vision;
$recEnv->envReco();
echo "\n";
}

public function liste(){
$rep="/sdcard/_ExternalSD/Range/Environnements";
include('Scripts/contenuRep.php');
for($i=0;$i<sizeof($liste);$i++){
$nom=$liste[$i];
$config=file($rep."/".$liste[$i]."/config.txt");
//echo $config[0]."/n".$config[1];
Range::nouveauEnvironnement($nom,$config);}
}

function checkReseau(){
$droid = new Android();
$result=$droid->wifiGetConnectionInfo();
$this->_ssid=$result['result']->ssid;
echo "Ssid ".$this->_ssid."\n";
//var_dump($result);
}
function checkCoordonnees(){}
function checkAdresse(){}
function checkConnu(){}

function configTxt($path){
include('dialogue/SelectionLocate.php');
}

}
