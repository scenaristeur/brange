<?php

require_once("Android.php");
$droid = new Android();
require_once 'Library/Application.php';
require_once 'Library/ScriptAbstract.php';

function chargerClasse($class){
require $class.'.class.php';
}spl_autoload_register('chargerClasse');


$appli= new Range();
/*
$bot= new Robot ();
$chargealeatoire=rand(0,100);
$bot->setCharge($chargealeatoire);
$bot->setDemarrage();

$bot->changeEtat(0);
*/


//$droid->viewHtml($url);
//$droid->ttsSpeak('message');
//$droid->ttsIsSpeaking();

//faire un robot general avec plusieurs fonctions , un sous rep par fonction : ranger paser aspi . peindre. voler stabilisé


// l.environnement. peut changer dans la journée ou par pzriode. ex une salle de sport avec filets a mettre. ballons a preparer ou salle de reunion
// ex vers 19h ou quand les devoirs sont termines mettre la table en fpnction du repas : si soupe, poisson, raclette, petit dej... ensuite debarrasser metttr au lave vaisselle et poubelle. ramasser. miettes . passer aspi et serpi. faire vaisselle
