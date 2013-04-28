<?php

require_once("Android.php");
$droid = new Android();

class InstructionStore extends SplObjectStorage {
private $_racine;

public function attach(Instruction $instruction) { parent::attach($instruction); 
}

public function configInst(){
$result="";
$droid = new Android();

  $droid->dialogCreateAlert("Configuration des instructions :");
         $confInst = array("Instruction vocale","Exécuter une instruction","Ajouter une instruction", "Modifier une instruction","Supprimer une instruction");
         $droid->dialogSetItems($confInst);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$confInst=$confInst[$result['result']->item];
//for($i=0;$i<sizeof($result);$i++){
//print $i." ".$confInst[$result['$i']];
switch($confInst){
case "Instruction vocale":
Instruction::vocale();
break;
case "Exécuter une instruction":
$inst=$this->select();
$inst->run();
break;
case "Ajouter une instruction":
$this->addInst();
break;
case "Modifier une instruction":
$inst=$this->select();
$inst->run($inst);
$inst->modif();
break;
case "Supprimer une instruction":
$inst=$this->select();
$inst->del($this);
//$this->unset($inst);
break;
case "Retour":
Range::demarrage();
default:
Range::demarrage();
}
}




public function detach(Instruction $instruction) { 
parent::detach($instruction); }

public function liste() {
echo "\n".count($this)." instructions \n";
foreach($this as $instruction) { 
echo $instruction->affiche(); } }
 
 
public function addInst(){
$verbe="";
$objet="";
$origine="";
$destination="";
$droid = new Android();

$file=Range::_racine."Instructions/Instructions.txt";
echo $file;
if (file_exists($file)) { 
 $fp = fopen($file, "a");
$result=$droid->dialogGetInput('Que voulez vous faire', 'Entrez un verbe :', null);
$verbe=$result['result'];
if($verbe!=""){
$result=$droid->dialogGetInput("Sur quoi voulez-vous agir :","Objet :", null);
$objet=$result['result'];

$result=$droid->dialogGetInput("Lieu de départ :", "Origine",null);
$origine=$result['result'];

$result=$droid->dialogGetInput("Lieu de destination :", "Destination",null);
$destination=$result['result'];

$ligne=$verbe."|".$objet."|".$origine."|".$destination."\n";
echo $ligne;
$result=fputs($fp, $ligne);
}
 fclose ($fp);
 $this->setInstructionStore();
$this->configInst();
}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier instructions.txt créé vide\n";
}
}

public function setInstructionStore(){
$this->removeAll($this);
$file=Range::_racine."Instructions/instructions.txt";
if (file_exists($file)) { 
$tab=file($file);
for($i=0;$i<(sizeof($tab));$i++){
list($verbe,$objet,$origine,$destination)=explode("|",$tab[$i]);
$instruction= new Instruction($verbe, $objet,$origine,$destination);
$this->attach($instruction);
}
}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier instruction.txt créé vide";
}
$this->liste();
}

public function select(){
foreach($this as $instruction){
$ligne=$instruction->getVerbe()." ".$instruction->getObjet()." ".$instruction->getOrigine()." ".$instruction->getDestination();
$tab[]=$ligne;
}

$droid = new Android();
 $droid->dialogCreateAlert("Choisissez une instruction:");
         $droid->dialogSetItems($tab);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$inst=$tab[$result['result']->item];
$trouve=$this->trouve($inst);
return $trouve;
}


public function trouve($inst){
foreach($this as $instruction){
$ligne=$instruction->getVerbe()." ".$instruction->getObjet()." ".$instruction->getOrigine()." ".$instruction->getDestination();
if ((strcmp($inst, $ligne))==0){
$trouve[]=$instruction;
if ((count($trouve))==1){
return $instruction;
}else{
echo "Erreur, pas trouvé";
}}
}
}

}