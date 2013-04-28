<?php

require_once("Android.php");
$droid = new Android();

require_once 'Library/ScriptAbstract.php';

function chargerClasse($class){
require $class.'.class.php';
}spl_autoload_register('chargerClasse');


$debut=new Piece("salon",$commun);
$fin=new Piece("bureau",$commun);
$parcours=new Parcours($debut,$fin);
$parcours->determine();