?php

require_once("Android.php");
$droid = new Android();

   $droid->dialogCreateAlert("INSTRUCTIONS\n Choisissez une instruction à executer en priorité ou creez une nouvelle instruction :");
         $instructionChoix = array("Liste des instructions en attente", "créer une nouvelle instruction");
         $droid->dialogSetItems($instructionChoix);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$this->_instructionChoix=$instructionChoix[$result['result']->item];