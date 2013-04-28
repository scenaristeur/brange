<?php

require_once("Android.php");
$droid = new Android();

   $droid->dialogCreateAlert("Démarrage rapide :");
         $demarrageRapide = array("oui", "non","config");
         $droid->dialogSetItems($demarrageRapide);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$this->_demarrageRapide=$demarrageRapide[$result['result']->item];