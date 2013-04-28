<?php


class Range{

private $_racine;
private $_robot;
private $_robots;
private $_instruction;
private $_instructions;
private $_environnement;
private $_environnements;
private $_timerDemarre=3000;


public function __construct(){
require_once("Android.php");
$this->setRacine();
$this->reglages();

// Un ensemble d'objets
$this->_robots = new SplObjectStorage();
$this->_instructions = new SplObjectStorage();
$this->_environnements = new SplObjectStorage();
$this->setRobots();
$this->instructionsTest();
//$this->listeRobots();
$this->listeInstructions();
//$this->listeEnvironnements();


$this->demarrage();

echo "Démarrage :".$this->_demarrage;
}

function nouvelleInstruction($verbe, $objet, $origine, $destination){
$instruction= new Instruction($verbe, $objet, $origine, $destination);
$this->_instructions->attach($instruction); 


}

function listeInstructions(){
echo $this->_instructions->count()." instructions\n";
$this->_instructions->rewind(); 
while($this->_instructions->valid()) { 
$index = $this->_instructions->key();
 $object = $this->_instructions->current(); //similar to current($s) 
 $data = $this->_instructions->getInfo();
$object->affiche();
/*var_dump($object); 
var_dump($data);*/
$this->_instructions->next(); 
} 
}



function instructionsTest(){
$this->nouvelleInstruction("ranger", "les legos" , "dans la chambre des garçons", "dans la boîte de legos");
$this->nouvelleInstruction("debarrasser", "la table","","");
$this->nouvelleInstruction("faire","une lessive","","");
$this->nouvelleInstruction("etudier","la photo transmise","Android ou autre", "Deduire les taches a accomplir");
}


public function demarrage(){

// timer demarrage puis autonome
$droid = new Android();
  $droid->dialogCreateAlert("Démarrage :");
         $demarrage = array("autonome","manuel","instructions","tests","config","selectif","STOP");
         $droid->dialogSetItems($demarrage);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$this->_demarrage=$demarrage[$result['result']->item];

switch($this->_demarrage){
case "autonome":
$this->setRobots();
break;
case "manuel":
$this->selectRobot();

break;
case "instructions":

break;
case "tests":

break;
case "config":
$this->selectConfig();

break;
case "selectif":

break;
case "STOP":
break;
default:
break;

}}

public function selectConfig(){
$droid = new Android();
$config="";
 $droid->dialogCreateAlert("Que voulez vous configurer ?");
         $config = array("Environnement", "Robots");
         $droid->dialogSetItems($config);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$config=$config[$result['result']->item];

switch($config){
case "Environnement":
echo "config env";
break;
case "Robots":
$this->configRobots();
break;
default:
$this->demarrage();
}}

public function configRobots(){
$droid = new Android();

  $droid->dialogCreateAlert("Configuration des robots :");
         $confRob = array("Ajouter un robot", "Modifier un robot","Supprimer un robot");
         $droid->dialogSetItems($confRob);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$confRob=$confRob[$result['result']->item];
//for($i=0;$i<sizeof($result);$i++){
//print $i." ".$confRob[$result['$i']];
switch($confRob){
case "Ajouter un robot":
$this->addRobot();
break;
case "Modifier un robot":
$this->selectRobot();
break;
case "Supprimer un robot":
$robot=$this->selectRobot();
/*$file=$this->_racine."Robots/robots.txt";
$f=fopen($file,"r");
while($ligne=fscanf($f,"%s\t%s\n"))
{list($nom, $type)=$ligne;
echo $nom."\n";}*/
$ligne=explode("\t",$robot);
echo $ligne[0];
//$this->delRobot($robot);
break;
default:
$this->selectConfig();
}
}
public function selectRobot(){
// Quel robot

$file=$this->_racine."Robots/robots.txt";
$tab=file($file);

$droid = new Android();
 $droid->dialogCreateAlert("Choisissez un robot:");
         $droid->dialogSetItems($tab);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$robot=$tab[$result['result']->item];
echo "config de ".$robot;
return $robot;
}

public function reglages(){
date_default_timezone_set('Europe/Berlin');
}

public function setRacine(){
$this->_racine="/sdcard/_ExternalSD/Range/";
//try serveur distant, serveur local, externsd., internesd
}

public function setRobots(){
$file=$this->_racine."Robots/robots.txt";
//echo $file;
if (file_exists($file)) { 
echo "recup list robots\n";
// $f=fopen($file,"r");

$tab=file($file);
for(
$i=0;
$i<(sizeof($tab));
$i++
){
print $tab[$i];
//$robot= new Robot($nom, $type);
//$this->_robots->attach($robot); 
}
}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier robots.txt créé vide";
}
}

public function addRobot(){
$nom="";
$type="";
$droid = new Android();

$file=$this->_racine."Robots/robots.txt";
//echo $file;
if (file_exists($file)) { 
 $fp = fopen($file, "a");
//while($nom!="s"){
$result=$droid->dialogGetInput('Nouveau Robot', 'Entrez son nom :', null);
$nom=$result['result'];
if($nom!=""){
$droid->dialogCreateAlert("Type du robot :");
         $type = array("phone", "range","peintre","drone transport","autre");
         $droid->dialogSetItems($type);
         $droid->dialogShow();
         $result = $droid->dialogGetResponse();
$type=$type[$result['result']->item]; 
$ligne=$nom."\t".$type."\n";
$result=fputs($fp, $ligne);
}
//}
 fclose ($fp);
$this->selectConfig();
}

else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
/*fputs ($fh, 1); 
fclose ($fh); 
$count = file($file);
 echo $count[0]; */
echo "fichier robots.txt créé vide";
}
// fin add robots
}

public function delRobot($robot){
$file=$this->_racine."Robots/robots.txt";
 $data = file($file); 
echo $robot;
$searchId = $robot;
 for($i = 0, $c = count($data);$i < $c; $i++) { 
if($strpos($searchId, $data[$i]) == 0) { unset($data[$i]); break; } } file_put_contents($file, $data);
$this->configRobots();
}


}