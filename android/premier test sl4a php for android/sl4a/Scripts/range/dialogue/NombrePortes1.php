<?php

require_once("Android.php");
$droid = new Android();

   $droid->dialogCreateAlert("DETAIL D'UN BATIMENT\n Ajouter :");
         $nombrePortes = array(0,1,2,3,4,5,6,7,8,9,10,"+");
         $droid->dialogSetItems($nombrePortes);
         $droid->dialogShow();
         $result = $droid->dialogGetResponse();
$this->_nombrePortes=$nombrePortes[$result['result']->item];