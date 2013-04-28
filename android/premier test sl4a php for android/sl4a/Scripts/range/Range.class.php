<?php

require_once("Android.php");
$droid = new Android();

class Range{
const _version=1;

const _racine="/sdcard/Range";
private $_robot;
private $_robots;
private $_instruction;
private $_instructions;
private $_environnement;
private $_environnements;

public function __construct(){
$this->reglages();
require_once("Android.php");

$this->demarrage();

}
public function getRacine(){
return $this->_racine;}



public function setEnvironnements(){
$this->_environnements=new EnvironnementStore();
$this->_environnements->setEnvironnementStore();}


public function setInstructions(){
$this->_instructions= new InstructionStore();
$this->_instructions->setInstructionStore();}

public function setRobots(){
$this->_robots= new RobotStore();
$this->_robots->setRobotStore();
}

public function setObjets(){
$this->_objets=new ObjetStore;
$this->_objets->setObjetStore();
}
public function setUtilisateurs(){
$this->_utilisateurs=new UtilisateurStore;
$this->_utilisateurs->setUtilisateurStore();
}

public function reglages(){
date_default_timezone_set('Europe/Berlin');
}



public function demarrage(){
// timer demarrage puis autonome
$droid = new Android();
$droid->dialogCreateAlert("Démarrage :");
$demarrage = array("Instruction vocale","Prendre une photo","instructions","environnements","robots","tests","config","selectif","autonome","manuel","STOP");
$droid->dialogSetItems($demarrage);
$droid->dialogShow();
$result = $droid->dialogGetResponse();
$this->_demarrage=$demarrage[$result['result']->item];
echo "\n Démarrage : ".$this->_demarrage."\n";
switch($this->_demarrage){
case "Instruction vocale":
$inst=new Instruction;
$inst->vocale();
break;
case "Prendre une photo":
$photo=new Photo;
$photo->prendre();
case "autonome":
//$this->setRobots();
break;
case "manuel":
$robot=$this->_robots->select();
$robot->affiche();
$robot->manuel();
break;
case "instructions":
Instruction::configInst();
break;
case "environnements":
Environnement::configEnv();
break;
case "robots":
$robotSt=new RobotStore;
$robotSt->configRobots();
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
$this->demarrage();
break;
}

}





}
