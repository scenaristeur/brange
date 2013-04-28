<?php

require_once("Android.php");
$droid = new Android();

class RobotStore extends SplObjectStorage {
public function attach(Robot $robot) { parent::attach($robot); 
}

public function detach(Robot $robot) { parent::detach($robot); }

public function liste() {
echo "\n".count($this)." robots \n";
foreach($this as $robot) { 
//echo "- ".$robot->getNom()."\n";
echo $robot->affiche();
 }
 }

public function setRobotStore(){
//$this->_racine="/sdcard/_ExternalSD/Range/";
$file=Range::_racine."Robots/robots.txt";
if (file_exists($file)) { 
$tab=file($file);
for($i=0;$i<(sizeof($tab));$i++){
list($nom,$type,$etat)=explode("|",$tab[$i]);
$robot= new Robot($nom, $type,$etat);
$this->attach($robot);
}
}
else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
echo "fichier robots.txt créé vide";
}
$this->liste();
}

public function select(){
foreach($this as $robot){
$tab[]=$robot->getNom();
}
$droid = new Android();
$droid->dialogCreateAlert("Choisissez  un robot:");
$droid->dialogSetItems($tab);
$droid->dialogShow();
$result = $droid->dialogGetResponse();
$_nom=$tab[$result['result']->item];
$robot=$this->trouve($_nom);
return $robot;

}

public function trouve($nomRobot){
foreach($this as $robot){
if ((strcmp($robot->getNom(),$nomRobot))==0){
$trouve[]=$robot;
//echo count($trouve)." ".$nomRobot;
if ((count($trouve))==1){
return $robot;}
else{echo "Erreur : plusieurs robots trouvés";
}

}
}
}
public function getObjectByKey($key) { 
if (isset($this->map[$key])) { 
parent::rewind(); 
while(parent::valid()) { 
if (parent::key() === $key) {
 return parent::current();
  } 
  parent::next(); 
  } 
  }
   }

}