<?php
require_once("Android.php");
$droid = new Android();

class Robot{

private $_id;
private $_nom;
private $_type;
private $_environnement ; // classe Environnement 
private $_position;
private $_etat; 
private $_etatTexte;
private $_charge;
private $_gps;
private $_demarrageRapide;
private $_mode; // autonome ou instructions
private $_instruction;
private $_instructions;



public function __construct($nom,$type,$base,$etat){
$this->_nom=$nom;
$this->_type=$type;
$this->_base=$base;
$this->_etat=$etat;
// Un ensemble d'objets
 $this->_instructions = new SplObjectStorage();

$chargealeatoire=rand(0,100);
$this->setCharge($chargealeatoire);
//$this->setDemarrage();
//$this->changeEtat(0);
//$this->getEtat();
$this->changeEtat($this->_etat);
}

public function getNom(){
return $this->_nom;}

function changeEtat($etat){
//echo "\n".$this->_etat=$etat;

switch ($etat)
{case 0:
$this->initialisation();
break;
case 1:
$this->veille();
break;
case 2:
$this->charge();
break;
case 3:
$this->observation();
break;
case 4:
$this->reperage();
break;
case 5:
$this->recuperationDonnees();
break;
case 6:
$this->analyse();
break;
case 7:
$this->reflexion();
break;
case 8:
$this->apprentissage ();
break;
case 9:
$this->rangement();
break;
}
}
public function affiche(){
echo "- ".$this->_nom."\t de type ".$this->_type. "\n\t base: ".$this->_base."\n\t etat : ".$this->_etat;
//$this->afficheEtat();
}

function afficheEtat(){
echo " - ".$this->_nom."--->".$this->_etatTexte."\n";
}

public function initialise(){
$this->changeEtat($this->_etat);
}


function initialisation(){

$this->_etatTexte="Initialisation";
$this->afficheEtat();
$this->initialiseCallback();
$this->verificationGenerale();
//$this->locate();
//$this->mode();
//$this->changeEtat(1);
}

function veille(){
$this->_etatTexte="Veille";
$this->afficheEtat();
// si instructions je vois si je peux les executer sinon veille avec callback instructions $this->listeInstructions();
echo "Tâches planifiées ?\n";// ne se met pas en veille si taches planifiees ou instruction sauf si besoin recharge
echo "Attente d'instruction\n";
echo "Opportunité de recharger batteries ?\n";
echo "phase d'apprentissage en arriere plan\n";
//$this->changeEtat(3);
}


function charge(){
$this->_etatTexte="Charge";
$this->afficheEtat();
while($this->_charge<90){
$this->_charge=$this->_charge+1;
//echo $this->_charge."% ";
}
echo "Charge OK";
echo "\n";
}

function observation(){
$this->_etatTexte="Observation";
$this->afficheEtat();
$env= new Environnement ();
//$env->choisir();
if ($this->_demarrageRapide=="non"){

$env->reconnaissance();
}else{echo "pas de recherche de l'environnement\n";
}
$this->changeEtat(4);
}

function reperage(){
$this->_etatTexte="Repérage";
$this->afficheEtat();
if ($this->_demarrageRapide=="non"){
$this->locate();}
else{echo "pas de localisation \n";}
echo "Cet endroit est-il repertorié dans la base?\n";
echo " Sinon un endroit similaire en fonction des objets reconnus(cuisine = cuisine)";
echo "où suis-je situé ?\n_près. d'une porte? /n_d'une fenetre? \n_d'une lumière ?\n  Suis-je proche d'un meuble ou d'un objet connu?\n Où est mon chargeur?";
echo "determiner les coordonnees de la piece par rapport a l.origine du batiment ,
en abscisse ordonnee , en m et cos par rapport a l''origine, en portes (3eme porte á gauche)";
$this->changeEtat(5);
}

function recuperationDonnees(){
$this->_etatTexte="Récupération de données ";
$this->afficheEtat();
$this->verification("serveur");
echo "connexion base\n";
echo "identification de la piece\n";

$racine="/sdcard/_ExternalSD/Range";
//include('Scripts/listeRep.php');
echo "verification des regles eventuelles applicables à la pièce ou aux objets repérés\n";
echo "comparaison du panorama de référence de la pièce en fonction des règles et action-> ranger ou actualiser un nouveau panorama";
echo "identification des changements par rapport au dernier passage\n";
echo "demande eventuelle de confirmation des changements\n";
echo "mise a jour eventuelle des infos du serveur relatives a la pièce et au positionnement des objets\n";
$this->changeEtat(6);
}

function analyse(){
$this->_etatTexte="Analyse de la pièce et des objets a ranger, des modifications par rapport a l'environnement connu";
$this->afficheEtat();
$this->changeEtat(7);
}

function reflexion(){
$this->_etatTexte="Réflexion sur la méthode de rangement, la prehension, les objets inconnus trier les objets connus";
$this->afficheEtat();
$this->changeEtat(8);
}

function apprentissage (){
$this->_etatTexte="Questionnement et Apprentissage";
$this->afficheEtat();
$this->changeEtat(9);
}

function rangement(){
$this->_etatTexte="Rangement";
$this->afficheEtat();
$this->verification("humain");
echo "je range en fonction des emplacements enregistrés dans la base\n";
//$this->changeEta
}

public function deplace($chemin){
echo "Déplacement de ".$this->_nom.":\n";
foreach($chemin as $piece){
echo "\t".$piece."\n";
}
echo "\n";
}

public function attrappe($objet){
echo "___".$this->_nom." attrappe ".$objet."\n";
}
public function depose($objet){
echo "___".$this->_nom." dépose ".$objet."\n";
}

function locate(){
echo"LOCALISATION ";
// create application instance
$app = new Application(array('scriptName' => 'OuSuisJe'));
// run application
$app->run();
//$this->_gps=$app->_gps;
//echo $this->_gps;
}

function mode(){
require("dialogue/SelectionMode.php");
echo "@@@ ";
echo $this->_mode."\n";
$this->instructionsTest();
switch ($this->_mode)
{case "autonome":
echo 
"je repère l'environnement\n";
$this->listeTachesPlanifiees();
$this->listeInstructions();
echo "je récupère les taches et instructions en attente \n";
echo "une fois les taches analysées , interprétées  decortiquees, j'evalue leur faisabilité (cpnnaissance objet, origine, destination)\n";

echo "Si aucune instruction, je parcours l'environnement á la recherche d'objets qui ne se trouverait pas à leur place\n";
echo "j'exucute en respectant sécurité , toujpurs à l'ecoute de nouvelles instructipns prioritaires et en surveillant la charge\n";

echo "je range en fonction des emplacements enregistrés dans la base\n";
break;
case "instructions":
$this->listeInstructions();
break;
case "manuel";
echo "je me laisse guider et j'apprend, tout en proposant mon assistance pour lrs manœuvres que je maitrise\n";
do{
require("dialogue/ModeManuel.php");
echo "@@@ ".$this->_instruction."\n";
$this->nouvelleInstruction($this->_instruction,"","","");
$this->listeInstructions();
}
while(($this->_instruction)!="STOP");
break;
default:
$this->mode();
}
}

function verificationGenerale(){
$this->verification("charge");
$this->verification("deplacement");
$this->verification("vision");
$this->verification("pince");
$this->verification("bac");
$this->verification("serveur");
$this->verification("humain");

}

function verification($verifie){
switch ($verifie){
case "deplacement":
echo "verification des deplacements\n";
break;
case "vision":
echo "verification des organes de vision\n";
break;
case "pince":
echo "verification des pinces pour attrapper\n";
break;
case "bac":
echo "verification d'occupation du bac de transport\n";
break;
case"serveur":
if($this->_demarrageRapide!="non"){
echo "PAS DE TEST SERVEUR\n";}
else{
echo "verification de la connexion au serveur\n";
$serveur= new Serveur;
$serveur->testConnexionInternet();
}
break;
case "humain":
echo "Demarrage des fonctions de sécurité . y'a t-il un humain(capteur infrarouge, mouvements)\n";
break;
case "charge":
echo "vérification de la charge\n";
$this->charge();
break;
}
}

function setCharge($charge){
$this->_charge=$charge;
}

function setDemarrage(){
require_once("dialogue/ModeDemarrage.php");
}

function nouvelleInstruction($verbe, $objet, $origine, $destination){
$instruction= new Instruction($verbe, $objet, $origine, $destination);
$this->_instructions->attach($instruction); 


}

function listeInstructions(){
var_dump($this->_instructions->count());
$this->_instructions->rewind(); 
while($this->_instructions->valid()) { 
$index = $this->_instructions->key();
 $object = $this->_instructions->current(); //similar to current($s) 
 $data = $this->_instructions->getInfo();
echo "//".$object->affiche();
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

function listeTachesPlanifiees(){
echo "Liste des tâches planifiées \n";}


function initialiseCallback(){
$this->callbackCharge();
$this->callbackSecurite();
$this->callbackMode();
$this->callbackInstruction();
}


function callbackCharge(){
echo "initialisation callbackCharge\n";
}
function callbackSecurite(){}
function callbackMode(){}
function callbackInstruction(){}

function getEnvBase(){
$this->_EnvBaseTxt=end(explode("/",$this->_base));
$envBase=new Environnement;
$envBase->trouve($this->_EnvBaseTxt);
return $envBase;

}

}
