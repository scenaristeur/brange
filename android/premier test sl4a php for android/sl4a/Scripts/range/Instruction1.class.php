<?php

require_once("Android.php");
$droid = new Android();

class Instruction {
/*
private $_priorite;
private $_commanditaire;
private $_attributaire; //robot auquel est affecté l'instruction*/
private $_instructionVocale;
private $_instructionTexte; 
/*private $_instructionRobot;*/
private $_verbe;
private $_objet;
private $_origine;
private $_destination;
/*private $_liste;*/
private $_instructions=array();
private $_instruction;




public function __construct($verbe, $objet, $origine, $destination){
$this->setVerbe($verbe);
$this->setObjet($objet);
$this->setOrigine($origine);
$this->setDestination($destination);
$this->interprete();
//$this->affiche();
//$this->enregistre();
//echo "Est-ce un deplacement, un mouvement précis ou une instruction complete?\n";
}


public function del($storage){
$file=Range::_racine."Instructions/instructions.txt";
 $lignes = file($file); 

foreach ($lignes as $num => $data){
if(strpos($data, $this->ligne())===0){
unset ($lignes[$num]);
}
}
$handle=fopen($file, 'w+');
fwrite($handle, implode($lignes));
fclose($handle);
$storage->setInstructionStore();
$storage->configInst();
}

public function ligne(){
$ligne=$this->_verbe."|".$this->_objet."|".$this->_origine."|".$this->_destination;
return $ligne;
}



public function run(){
$this->afficheDetail();
$this->decortique();
//$this->analyse();
//$this->affiche();
$this->interprete();
//$this->evalue();
}

function decortique(){
echo "dekortik";
$_verbe= new Verbe($this->_verbe);
$_objet= new Objet($this->_objet);
$_envOrigine= new Environnement($this->_origine,"","");
$_envDestination=new Environnement($this->_destination,"","");
echo "la ligne : ".$this->ligne();
$_envOrigine->connu();
$_envDestination->connu();
}

public function afficheDetail(){
echo "- ".$this->_verbe." ". $this->_objet."\n";
if(($this->_origine)!=""){echo "\t origine : ".$this->_origine."\n";}
if(($this->_destination)!=""){echo "\t destination : ".$this->_destination."\n";}
}


public function affiche(){
echo "- ".$this->_verbe." ". $this->_objet."\n";
}


public function vocale(){
$droid = new Android();
$text=$droid->recognizeSpeech(null, null, null);
echo $text;
var_dump($text);
  foreach($text as $key=>$value) {
           echo "$key : $value \n";
        }
/*
$message="Bonjour, comment t'appelles-tu?";
$droid->ttsSpeak($message);
$prenom=$droid->recognizeSpeech(null, null, null);
//$prenom=$droid->dialogGetInput('Quel est ton prénom?', 'Ecris ton prénom :', null);
$message='Salut '.$prenom['result'].'. Comment vas-tu?';
echo $message;
$droid->ttsSpeak($message);
*/
}

public function interprete(){
//interprete si verbe = prendre photo objet est photo et verbe est prendre
if(($this->_verbe)=="definir environnement"){
$panorama= new Instruction("creer","panorama","","");
}
}

public function enregistre(){
//echo "instruction enregistree dans la liste après priorisation\n";
}

public function liste(){
$i=1;
//for each $instruction as Instruction...
foreach ($instructions as $_instruction) {
echo $i."- ";
            $_instruction->affiche();
$i++;   }
echo "@@@@@@@@@@@@@@@@@\n";
}

public function analyseInstruction (){
//echo "Est-ce que je connais".$this->getVerbe()."\n";
//echo "Est-ce que je connais".$this->getObjet()."\n";
//echo "Est-ce que je connais".$this->getOrigine()."\n";
//echo "Est-ce que je connais".$this->getDestination()."\n";

}

public function traiteInstruction(){

}

public function termineInstruction(){

}


function setVerbe($verbe){
$this->_verbe=$verbe;
}
function setObjet($objet){
$this->_objet=$objet;
}
function setOrigine($origine){
$this->_origine=$origine;
}
function setDestination($destination){
$this->_destination =$destination;}

function getInstructionTexte(){
$this->_instructionTexte=$this->getVerbe()." ".$this->getObjet();
return $this->_instructionTexte;
}
function getVerbe(){return $this->_verbe;}
function getObjet(){return $this->_objet;}
function getOrigine(){return $this->_origine;}
function getDestination(){return $this->_destination;}


}
//echo "j'exécute les instruction qui sont realisables par ordre de priorite ou de pratique : dois je mettre la boite dans l'etagere avant ou après l'avoir remplie?";
//echo "si aucune instruction, veille ou charge ou apprentissage ou taches en attente\n";

// Hypothèse d'une commande vocale. ex " Robi peux tu ranger la chambre des garçons" ou "debarasse la table s'il te plait"-> depuis une instruction parlée. , extraire les informations importantes .gérer. les exclusions " range la chambre mais laisse les chaussons au pied du lit et lz paquer de mouxhoir sur le chevet"- > enregistrement d.une exception : un paquet de mouchoirs, mais c'est pas pour ça qu'il faut y mettre tous les paquets de mouchoirs . la place principale reste dans l'etagere de la salle de bains.


 // suite des procedures a executer par le robot envoyees a l'analyse pour securite , contraintes . prerequis de transport . d.ouverture boites...
