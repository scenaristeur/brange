<?php
require_once("Android.php");
$droid = new Android();

class Robot{

private $_id;
private $_nom;
private $_type;
private $_environnement ; // classe Environnement 
private $_position;
private $_etat=0; 
private $_etatTexte;
private $_charge=0;
private $_gps;
private $_chercheCoordonnees=0;
private $_mode; // autonome ou instructions

function changeEtat($etat){
echo "\n".$this->_etat=$etat;
//$this->afficheEtat();

switch ($this->_etat)
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
default:
$this->_etat=0;

}
}
function afficheEtat(){
echo " - ".$this->_etatTexte."\n";
}

function initialisation(){
$this->_etatTexte="Initialisation";
$this->afficheEtat();

echo "Demarrage des fonctions de sécurité . y'a t-il un humain(capteur infrarouge, mouvements)\n";

echo "verification des deplacements\n";
echo "verification des organes de vision\n";
echo "verification des pinces pour attrapper\n";
echo "verification d'occupation du bac de transport\n";
echo "verification de la connexion au serveur\n";
if ($this->_chercheCoordonnees==1){
$this->locate();}
else{echo "Localisation passée ";}
}

function veille(){
$this->_etatTexte="Veille";
$this->afficheEtat();
echo"Instructions en attente? priorité?\n";
echo "Tâches planifiées ?\n";

echo "Attente d'instruction\n";
echo "Opportunité de recharger batteries ?\n";
echo "phase d'apprentissage en arriere plan\n";

}

function charge(){
$this->_etatTexte="Charge";
$this->afficheEtat();
while($this->_charge<90){
$this->_charge=$this->_charge+1;
echo $this->_charge."% ";}
echo "\n";
}

function observation(){
$this->_etatTexte="Observation";
$this->afficheEtat();
echo "Recup coordonnees gps\n";
echo "y a t'il de la lumière ? sources de lumières fenetres, portes\n";
echo "Le plafond est-il visible? interieur. ou xterieur?\n";
echo "enregistrement des sources de lumière , des meubles et objets principaux\n";
echo "où suis-je situé ?\n_près. d'une porte? /n_d'une fenetre? \n_d'une lumière ?\n Combien y'a t-il de portes de fenêtres de lumières?\n Suis-je proche d'un meuble ou d'un objet connu?\n Où est mon chargeur?";

}

function reperage(){
$this->_etatTexte="Repérage";
$this->afficheEtat();
echo "Cet endroit est-il repertorié dans la base?\n";
echo " Sinon un endroit similaire en fonction des objets reconnus(cuisine = cuisine)";
echo "determiner les coordonnees de la piece par rapport a l.origine du batiment ,
en abscisse ordonnee , en m et cos par rapport a l''origine, en portes (3eme porte á gauche)";
}

function recuperationDonnees()
{$this->_etatTexte="Récupération de données ";
$this->afficheEtat();
echo "verification connexion serveur\n";
echo "connexion base\n";
echo "identification de la piece\n";
echo "verification des regles eventuelles applicables à la pièce ou aux objets repérés\n";
echo "identification des changements par rapport au dernier passage\n";
echo "demande eventuelle de confirmation des changements\n";
echo "mise a jour eventuelle des infos du serveur relatives a la pièce et au positionnement des objets\n";
}

function analyse(){
$this->_etatTexte="Analyse de la pièce et des objets a ranger, des modifications par rapport a l'environnement connu";
$this->afficheEtat();
$this->mode();
}

function reflexion(){
$this->_etatTexte="Réflexion sur la méthode de rangement, la prehension, les objets inconnus trier les objets connus";
$this->afficheEtat();
}

function apprentissage (){
$this->_etatTexte="Questionnement et Apprentissage";
$this->afficheEtat();
}

function rangement(){
$this->_etatTexte="Rangement";
$this->afficheEtat();
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

switch ($this->_mode)
{case "autonome":
echo "je range en fonction des emplacements enregistrés dans la base";
break;
case "instructions":
echo "j'exécute les instruction qui sont realisables par ordre de priorite ou de pratique : dois je mettre la boite dans l'etagere avant ou après l'avoir remplie?";
echo "si aucune instruction, veille ou charge ou apprentissage ou taches en attente";
break;
case "manuel";
echo "je me laisse guider et j'apprend, tout en proposant mon assistance pour lrs manœuvres que je maitrise";
break;
default:
echo "@@@ Veuillez Choisir un mode de fonctionnement";

}
}



}

