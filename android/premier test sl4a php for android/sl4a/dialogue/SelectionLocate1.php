<?php

require_once("Android.php");
$droid = new Android();

   $droid->dialogCreateAlert("Localisation :");
         $locate = array("localiser maintenant","plus tard");
         $droid->dialogSetItems($locate);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();

$this->_locate=$locate[$result['result']->item];

switch($this->_locate){
case "Localiser maintenant":
echo "1";
include('Scripts/OuSuisJe.php');
echo $longitude;
echo $latitude;
break;
case "plus tard":
echo "2";
$default="longitude : 0 \n latitude : 0 \n";
$f=fopen($path."/config.txt","w");
fputs($f,$default);
break;
default:
echo "marche pas";
break;
}


