<?php

require_once("Android.php");
$droid = new Android();

   $droid->dialogCreateAlert("MODE MANUEL\n Choisissez une instruction :");
         $instruction = array("avancer", "tourner à gauche" , "tourner à droite", "reculer","STOP","prendre photo","saisir objet","definir environnement");
         $droid->dialogSetItems($instruction);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$this->_instruction=$instruction[$result['result']->item];