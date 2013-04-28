<?php

require_once("Android.php");
$droid = new Android();

class PieceStore extends SplObjectStorage{

public function attach(Piece $piece) {
 parent::attach($piece);}


}