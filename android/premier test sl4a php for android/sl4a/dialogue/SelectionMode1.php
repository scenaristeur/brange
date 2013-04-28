<?php

require_once("Android.php");
$droid = new Android();

   $droid->dialogCreateAlert("Mode de fonctionnement pour ".$this->_nom." :");
         $mode = array("autonome", "instructions", "manuel","veille","maintenance");
         $droid->dialogSetItems($mode);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();

$this->_mode=$mode[$result['result']->item];