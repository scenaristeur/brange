<?php

require_once("Android.php");
$droid = new Android();
require_once 'Library/Application.php';
require_once 'Library/ScriptAbstract.php';

function chargerClasse($class){
require $class.'.class.php';
}spl_autoload_register('chargerClasse');
$commun=explode("/",Range::_racine."/Environnements/13 gare");

$debut=new Piece("salon",$commun);
$fin=new Piece("chambre Lucie",$commun);
$parcours=new Parcours1($debut,$fin);
//$parcours->determine($debut,$fin);
//$parcours->resultat();
//var_dump($parcours->getResult());