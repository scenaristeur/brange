<?php

require_once("Android.php");
$droid = new Android();


function instructionsTest(){
$this->nouvelleInstruction("ranger", "les legos" , "dans la chambre des garçons", "dans la boîte de legos");
$this->nouvelleInstruction("debarrasser", "la table","","");
$this->nouvelleInstruction("faire","une lessive","","");
$this->nouvelleInstruction("etudier","la photo transmise","Android ou autre", "Deduire les taches a accomplir");
}
public function addInst(){
$verbe="";
$objet="";
$origine="";
$destination="";
$droid = new Android();

$file=$this->_racine."Instructions/Instructions.txt";
echo $file;
if (file_exists($file)) { 
 $fp = fopen($file, "a");
//while($nom!="s"){
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
//}
 fclose ($fp);
$this->configInst();
}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier instructions.txt créé vide\n";
}
}

/*
public function setRobots(){
$file=$this->_racine."Robots/robots.txt";
if (file_exists($file)) { 
$tab=file($file);
for($i=0;$i<(sizeof($tab));$i++){
list($nom,$type,$etat)=explode("|",$tab[$i]);
$robot= new Robot($nom, $type,$etat);
$rob= new Robot($nom, $type,$etat);
$this->_robots->attach($robot); 
$this->_robstore=new RobotStore();
$this->_robstore->attach($rob);
echo "nombre ";
$this->_robstore->getNombre();
echo "ok";
}
}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier robots.txt créé vide";
}
$this->listeRobots();
$this->_robstore->liste();
}
*/


/*
function nouvelleInstruction($verbe, $objet, $origine, $destination){
$instruction= new Instruction($verbe, $objet, $origine, $destination);
$this->_instructions->attach($instruction); 
}*/

function getRacine(){
return Range::_racine;}

function runInst($inst){
// recuperer l'objet dans spl
}
