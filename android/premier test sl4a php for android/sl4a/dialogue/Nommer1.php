<?php

require_once("Android.php");
$droid = new Android();

$name = $droid->dialogGetInput('Donnez-lui un nom : ');
$this->_nom= $name['result'];