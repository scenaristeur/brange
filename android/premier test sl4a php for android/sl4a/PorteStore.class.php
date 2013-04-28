<?php

require_once("Android.php");
$droid = new Android();

class PorteStore extends SplObjectStorage{

public function attach(Porte $porte) {
 parent::attach($porte);}


}