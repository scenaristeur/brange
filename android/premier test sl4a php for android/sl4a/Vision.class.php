<?php

require_once("Android.php");
$droid = new Android();
//include_once("Library/opencv");

class Vision{


public function verificationVision(){
echo "Verification vision opencv";}

public function envReco(){
//tant que non identifié ou fait le tour 360° et non identifié -> ajouter á la liste des demandes vers l'utilisateur(prendre photo, tourner 90 a droite ou gauche ou 180 ou 270, demander serveur ou base prendre photo)
$this->captureImage();
$this->demandeAnalyse();
echo "transmission au serveur pour identification";
echo "repérage sources lumière \n";
echo "repérage edge\n";
echo "plafond identifié?";
// si plafond alors intérieur sinon extérieur ou mixte
echo "repérage et reconnaissance sinon. enregistrement des sources de lumière , des meubles et objets principaux\n";
echo "Combien y'a t-il de portes de fenêtres de lumières?\n";

echo "prendrePanorammique()\n";
echo "compiser()...= Comparer une photo ou un flux video avec le panoramique qui lui correspond ( requiert d'avoir defini le panoramique et la portion la plus probable) + Isoler chaque discordance dans un objet blob different . déterminer si ces blobs sont des objets repertories definis, sinon voir à les enregistrer et les lister avec coordonnées dans l'espace , faire un plan 3d de l'environnement .\n
 En partant de ce principe, on peut creer un environnement en compisant un panoramique tout blanc ou vide de toute info avec les photos ou videos de cet environnement\n";
}

public function reconnaissancePiece(){
echo "Reconnaissance pièce ";}

public function reconnaissanceObjet(){
echo "Reconnaissance Objet";}

public function detectionObjet(){
echo "Retrouver un objet dans la pièce ";}

protected function captureImage(){
echo "Je prend une image\n";
$photo= new Photo;
//$photo->takePhoto();

}
protected function demandeAnalyse(){

$serveur= new Serveur;
$serveur->testConnexionInternet();
echo "Je demande une analyse";
}
}