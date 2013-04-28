<?php

require_once("Android.php");
$droid = new Android();

   $droid->dialogCreateAlert("Veuillez choisir un environnement :");
         $environnement = array("interieur", "exterieur", "mixte","reconnaissance");
         $droid->dialogSetItems($environnement);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$this->_environnement=$environnement[$result['result']->item];