<?php

require_once("Android.php");

class Serveur{


function testConnexionInternet(){

$droid = new Android();

$url = "http://widgets.fabulously40.com/horoscope.json?sign=taurus";
$urlLan="http://192.168.1.1";
$urlLocal="http://localhost";



$droid->dialogCreateSpinnerProgress("Test de connexion ...", "Patientez");
         $droid->dialogShow();

// try serveur , serveur local , base interne

try {
$internet=$this->connexionBase(json_decode(file_get_contents($url)));}
catch (Exception $e) { 
$droid->dialogDismiss();

echo 'Exception reçue : ', $e->getMessage(), "\n"; }
echo $internet;
if ($internet==1){
 $result = json_decode(file_get_contents($url));

         $droid->vibrate();

         // Close spinner
         $droid->dialogDismiss();

         $theFuture = html_entity_decode($result->horoscope->horoscope, ENT_QUOTES, "UTF-8");
         // Something is wrong with &apos;..
         $theFuture = str_replace("&apos;", "'", $theFuture);
         $theFuture .= "\n\n[widgets.fabulously40.com]";

         $droid->dialogCreateAlert("Your Future is here " . $result->horoscope->sign . "!", $theFuture);

         $droid->dialogSetPositiveButtonText("Exit");
         $droid->dialogShow();

         // Wait for user input to continue script
         $droid->dialogGetResponse();
         $action = "bye";
  }      

} 

function connexionBase($url){
if (!$url) {throw new Exception ('internet impossible\n');
return $internet=0;} else {return $internet=1;}
}

}


/*function inverse($x) {
 if (!$x) { throw new Exception('Division par zéro.'); } else return 1/$x; }


*/


//$serveur =new Serveur();
//$serveur->testConnexionInternet();
