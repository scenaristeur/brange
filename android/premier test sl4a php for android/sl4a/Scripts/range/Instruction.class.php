<?php

require_once("Android.php");
$droid = new Android();

/* pour tester cette classe */
Instruction::configInst();
/* fin commande test */

class Instruction{
const version=1;
private $_texte;
private $_etat;
private $_racine;
public function setRacine(){

}

public function configInst(){
//$result="";
$droid = new Android();
$inst=new Instruction;
$droid->dialogCreateAlert("Configuration des instructions :");
$confInst = array("Instruction vocale","Exécuter une instruction","Ajouter une instruction", "Modifier une instruction","Supprimer une instruction","Retour");
         $droid->dialogSetItems($confInst);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
if($confInst[$result['result']->item]){$confInst=$confInst[$result['result']->item];}
//for($i=0;$i<sizeof($result);$i++){
//print $i." ".$confInst[$result['$i']];
switch($confInst){
case "Instruction vocale":
$inst->vocale();
break;
case "Exécuter une instruction":
$inst->run();
break;
case "Ajouter une instruction":
$inst->add();
break;
case "Modifier une instruction":
//$inst=$this->select();
//$inst->run($inst);
$inst->modif();
break;
case "Supprimer une instruction":
//$inst=$this->select();
$inst->del();
//$this->unset($inst);
break;
case "Retour":
Range::demarrage();
default:
Range::demarrage();
}
}


public function add(){
$this->_verbe="";
$this->_objet="";
$this->_origine="";
$this->_destination="";
$this->_etat="brut";
$droid = new Android();

$file=Range::_racine."/Instructions/instructions.txt";
echo $file;
if (file_exists($file)) { 
 $fp = fopen($file, "a");
$result=$droid->dialogGetInput('Que voulez vous faire', 'Entrez un verbe :', null);
$this->_verbe=$result['result'];
if($this->_verbe!=""){
$result=$droid->dialogGetInput("Sur quoi voulez-vous agir :","Objet :", null);
$this->_objet=$result['result'];
$result=$droid->dialogGetInput("Lieu de départ :", "Origine",null);
$this->_origine=$result['result'];
$result=$droid->dialogGetInput("Lieu de destination :", "Destination",null);
$this->_destination=$result['result'];
$this->_ligne=$this->_verbe."|".$this->_objet."|".$this->_origine."|".$this->_destination."\n";
echo $this->_ligne;
$result=fputs($fp, $this->_ligne);
}
 fclose ($fp);
// $this->setInstructionStore();
$this->configInst();
}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier instructions.txt créé vide\n";
}
}

public function run(){
$this->select();
$this->decortique();
//var_dump($this->_chemin);

}

public function decortique(){
echo "\t".$this->_etat;
if(($this->_origine)&&($this->_destination)){
$envO=new Environnement;
$envO->trouve($this->_origine);
$envD=new Environnement;
$envD->trouve($this->_destination);
$chemin =new Chemin($envO,$envD);
$chemin->determine();
$this->_chemin=$chemin->getCheminCalcul();
$this->_commun=$chemin->getCommun();
$this->findRobot();
// si robot dispo et tout ok
$this->_robot->changeEtat(3);
echo $this->_robot->afficheEtat();
$cheminDepart=new Chemin($this->_robot->getEnvBase(),$envO);
$cheminDepart->determine();
$this->_cheminDepart=$cheminDepart->getCheminCalcul();
$cheminRetour=new Chemin($envD,$this->_robot->getEnvBase());
$cheminRetour->determine();
$this->_cheminRetour=$cheminRetour->getCheminCalcul();
$this->_robot->deplace($this->_cheminDepart);
$this->_robot->attrappe($this->_objet);
$this->_robot->deplace($this->_chemin);
$this->_robot->depose($this->_objet);
$this->_robot->deplace($this->_cheminRetour);
$this->_robot->changeEtat(1);
//$this->assureRealisationExecution();
}
}




public function findRobot(){
echo"\n";
print("Nouveau RobotStore avec les robots qui peuvent ".$this->_verbe." ".$this->_objet."... dans l'environnement contenant ".end($this->_commun)." en suivant : \n");
var_dump($this->_chemin);
$liste= new RobotStore;
$liste->setRobotStore();
$this->_robot=$liste->select();

//echo "trouver un robot et le passer en etat action";
//echo "proposer un robot dispo ou effectuer selection manuelle du robot";

//echo "trouver un robot compétent disponible ou à louer ou qui pourrait interrompre une tache pour effectuer celle-ci. Sinon mettre la tache en attente et prevenir les robots qu'une tache les attend";
//echo "si non disponible Propose location et livraison";
/*
list($nom,$type,$base,$etat)=explode("|",$this->selectRobot());
//var_dump($robot_nom[0],$robot_nom[1],$robot_nom[2]);
//echo $robot;
echo $nom;
$robot= new Robot($nom,$type,$base,$etat);
//$robot->modif($robot_nom);*/
$this->_robot->setDemarrage();
//$this->_robot->changeEtat(4);
//echo "3 chemins : \n\t";
//echo $this->_robot->_base." --> puis this chemin puis retour base\n";

}

public function select(){
$file=Range::_racine."/Instructions/instructions.txt";
if (file_exists($file)) { 
$tab=file($file);
for($i=0;$i<(sizeof($tab));$i++){
list($this->_verbe,$this->_objet,$this->_origine,$this->_destination)=explode("|",$tab[$i]);
$this->_ligne=$this->_verbe." ".$this->_objet." ".$this->_origine." ".$this->_destination;
$this->_instructions[]=trim($this->_ligne);
}
$droid = new Android();
 $droid->dialogCreateAlert("Choisissez une instruction:");
         $droid->dialogSetItems($this->_instructions);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$inst->_texte=$tab[$result['result']->item];
list($this->_verbe,$this->_objet,$this->_origine,$this->_destination)=explode("|",$inst->_texte);
$this->_etat="brut";
echo $this->_verbe."\n".$this->_objet."\n".$this->_origine."\n".$this->_destination."\n";


}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier instruction.txt créé vide";
}
}





public function vocale(){
$droid = new Android();
//$inst = new Instruction;
$text=$droid->recognizeSpeech(null, null, null);

//echo $text;
//var_dump($text);
/*foreach($text as $key=>$value) {
           echo "$key : $value \n";
        }*/
$this->_texte=$text['result'];
$droid->dialogCreateAlert('Voulez-vous dire ?', $this->_texte);
$droid->dialogSetPositiveButtonText('Valider');
$droid->dialogSetNegativeButtonText('Recommencer');
$droid->dialogSetNeutralButtonText('Annuler');
$droid->dialogShow();
$result=$droid->dialogGetResponse();
switch ($result['result']->which){
case "positive":
$this->_etat="vocale";
$this->vocale2brut();
$this->decortique();
break;
case "negative":
//$this->vocale();
break;
case "neutral";
//$this->_configEnv();
break;

}
}

public function vocale2brut(){
$this->_tabPrecision=explode(" ",$this->_texte);
//$params[]=array("verbe","objet","origine","destination");
//var_dump($params);
//foreach($params as $param){
//echo $param;

$this->precision("verbe");
$this->precision("objet");
$this->precision("origine");
$this->precision("destination");
//}

}

public function precision($param){
$droid = new Android();

//var_dump($this->_tabPrecision);
// liste deroulante + aucuN+precisser+ parcourir+completer
$droid->dialogCreateAlert("Précisez", $param);
$droid->dialogSetMultiChoiceItems($this->_tabPrecision, null);
$droid->dialogSetPositiveButtonText($param);
$droid->dialogSetNeutralButtonText('Ressaisir');
$droid->dialogSetNegativeButtonText('Annuler');
$droid->dialogShow() ;
$result=$droid->dialogGetResponse();

if($result['result']->item='positive'){
//$droid->dialogDismiss();
$this->_precision=$droid->dialogGetSelectedItems();
//var_dump($this->_precision);

foreach($this->_precision['result'] as $mot){
//echo $mot;
$tabPrecision[]=$this->_tabPrecision[$mot];
//unset($this->_tabPrecision[$mot]);
//var_dump($mot);
}
var_dump($tabPrecision);
switch($param)
{
case "verbe":
$this->_verbe=implode(" ",$tabPrecision);
break;
case "objet":
$this->_objet=implode(" ",$tabPrecision);
break;
case "origine":
$this->_origine=implode(" ",$tabPrecision);
break;
case "destination":
$this->_destination=implode(" ",$tabPrecision);
break;
}

//foreach($this->_precision['result'] as $mot){
//unset($this->_tabPrecision[$mot]);

//}


}
}


}


// Decortique :si acheter , creer liste de course avec possibilite d'etablir commande sur internet , jiste a verifier et valider. ou groyper par magasin. leclerc. leroy ou par rayon. alim. fruits...
// chercher dest et orig dans environnements . si pas connus demander alias ou creation.
// trouver objet par origine
// regarder si objet connu . si oui liste des endroits ou on le trouve habituellement. determiner chemin pour atteindre destination grace aux portes environnement ( remonter juusqua envionnement commun pour une même profondeur de scandirectory