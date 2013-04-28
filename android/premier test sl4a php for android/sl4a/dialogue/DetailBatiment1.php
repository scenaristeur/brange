<?php

require_once("Android.php");
$droid = new Android();
$this->_type="STOP";
   $droid->dialogCreateAlert("DETAIL D'UN BATIMENT\n Ajouter :");
         $type = array("bureau","chambre","cuisine","entree", "escalier","salon","STOP");
         $droid->dialogSetItems($type);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$this->_type=$type[$result['result']->item];