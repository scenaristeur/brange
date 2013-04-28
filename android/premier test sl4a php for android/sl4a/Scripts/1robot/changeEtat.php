<?php
function changeEtat($etat){
echo "\n".$this->_etat=$etat;

switch ($this->_etat)
{case 0:
$this->initialisation();
break;
case 1:
$this->veille();
break;
case 2:
$this->charge();
break;
case 3:
$this->observation();
break;
case 4:
$this->reperage();
break;
case 5:
$this->recuperationDonnees();
break;
case 6:
$this->analyse();
break;
case 7:
$this->reflexion();
break;
case 8:
$this->apprentissage ();
break;
case 9:
$this->rangement();
break;
}
}