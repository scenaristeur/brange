<?php


class Range{
const _version=0;

const _racine="/sdcard/_ExternalSD/Range/";
private $_robot;
private $_robots;
private $_instruction;
private $_instructions;
private $_environnement;
private $_environnements;
private $_timerDemarre=3000;


public function __construct(){
require_once("Android.php");
$this->reglages();
$this->_environnements=new EnvironnementStore();
$this->_environnements->setEnvironnementStore();
$this->_instructions= new InstructionStore();
$this->_instructions->setInstructionStore();
$this->_robots= new RobotStore();
$this->_robots->setRobotStore();
$this->_objets=new ObjetStore;
$this->_objets->setObjetStore();
$this->_utilisateurs=new UtilisateurStore;
$this->_utilisateurs->setUtilisateurStore();
$this->demarrage();
}


public function demarrage(){

// timer demarrage puis autonome
$droid = new Android();
  $droid->dialogCreateAlert("Démarrage :");
         $demarrage = array("autonome","manuel","instructions","environnements","robots","tests","config","selectif","STOP");
         $droid->dialogSetItems($demarrage);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$this->_demarrage=$demarrage[$result['result']->item];

switch($this->_demarrage){
case "autonome":
//$this->setRobots();
break;
case "manuel":
$robot=$this->_robots->select();
$robot->affiche();
$robot->manuel();
break;
case "instructions":
$this->_instructions->configInst();
break;
case "environnements":
$this->_environnements->configEnv();
break;
case "robots":
$this->_robots->configRobots();
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

}
echo "\n Démarrage :".$this->_demarrage;
}








/************:*********/


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

function listeRobots(){
echo $this->_robots->count()." robots\n";
$this->_robots->rewind(); 
while($this->_robots->valid()) { 
$index = $this->_robots->key();
 $object = $this->_robots->current(); //similar to current($s) 
 $data = $this->_robots->getInfo();
$object->affiche();
/*var_dump($object); 
var_dump($data);*/
$this->_robots->next(); 
} 
}

function listeEnvironnements(){
echo $this->_environnements->count()." environnements\n";
$this->_environnements->rewind(); 
while($this->_environnements->valid()) { 
$index = $this->_environnements->key();
 $object = $this->_environnements->current(); //similar to current($s) 
 $data = $this->_environnements->getInfo();
$object->affiche();
/*var_dump($object); 
var_dump($data);*/
$this->_environnements->next(); 
} 
}

function setEnvironnements(){
$liste=Environnement::liste();
$this->listeEnvironnements();
}
function setInstructions(){
//listeInstructions=Instruction::liste();
//$this->listeInstructions();
$file=$this->_racine."Instructions/instructions.txt";
if (file_exists($file)) { 
$tab=file($file);
for($i=0;$i<(sizeof($tab));$i++){
list($verbe,$objet,$origine,$destination)=explode("|",$tab[$i]);
$instruction= new Instruction($verbe, $objet,$origine,$destination);
$this->_instructions->attach($instruction); 
}
}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier instructions.txt créé vide";
}
$this->listeInstructions();

}



public function selectConfig(){
$droid = new Android();
$config="";
 $droid->dialogCreateAlert("Que voulez vous configurer ?");
         $config = array("Environnement", "Robots","Autres phone & ordis","Maintenance Appli, verif version fichiers, structures , check doublons");
         $droid->dialogSetItems($config);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$config=$config[$result['result']->item];
switch($config){
case "Environnement":
echo "config env";
$this->configEnv();
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
$robot=$this->selectRobot();
echo $robot;
$this->modifRobot;
break;
case "Supprimer un robot":
$robot=$this->selectRobot();
$this->delRobot($robot);
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




public function selectInstx(){
$file=$this->_racine."Instructions/instructions.txt";
$tab=file($file);
$droid = new Android();
 $droid->dialogCreateAlert("Choisissez une instruction:");
         $droid->dialogSetItems($tab);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$inst=$tab[$result['result']->item];
//echo "config de ".$inst;
return $inst;
}

public function reglages(){
date_default_timezone_set('Europe/Berlin');
}

public function setRacine(){
$this->_racine="/sdcard/_ExternalSD/Range/";
//try serveur distant, serveur local, externsd., internesd
}



public function addRobot(){
$nom="";
$type="";
$droid = new Android();

$file=Range::_racine."Robots/robots.txt";
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
$etat=0;
$ligne=$nom."|".$type."|".$etat."\n";
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
 $lignes = file($file); 
foreach ($lignes as $num => $data){
if(strpos($data, $robot)===0){
unset ($lignes[$num]);
}
}
$handle=fopen($file, 'w+');
fwrite($handle, implode($lignes));
fclose($handle);
$this->configRobots();
}








}