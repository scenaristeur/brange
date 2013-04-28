<?php

require_once("Android.php");
$droid = new Android();

class Objet extends SplObjectStorage {
// objet peut en contenir d'autres
private $_id;
private $_typeObjet;
private $_position;
private $_piece;
private $_batiment;
private $_boite;
private $_forme;
private $_couleur;
private $_dimensions ;// l H p
private $_prehension; // manière d'attrapper
private $_nePasRanger; // objet ã sa place ou qu'on ne veut pas ranger maintenant ex une table ou des chaises


function attrapper(){
// id et prehension
}


}