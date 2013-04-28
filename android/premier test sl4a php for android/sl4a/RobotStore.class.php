<?php

require_once("Android.php");
$droid = new Android();

class RobotStore extends SplObjectStorage {
public function attach(Robot $robot) {
 parent::attach($robot); 
}

public function detach(Robot $robot) {
 parent::detach($robot); }

public function liste() {
echo "\n".count($this)." robots \n";
foreach($this as $robot) { 
//echo "- ".$robot->getNom()."\n";
echo $robot->affiche();
 }
 }

public function setRobotStore(){
//$this->_racine="/sdcard/_ExternalSD/Range/";
$file=Range::_racine."/Robots/robots.txt";
if (file_exists($file)) { 
$tab=file($file);
for($i=0;$i<(sizeof($tab));$i++){
list($nom,$type,$base,$etat)=explode("|",$tab[$i]);
$robot= new Robot($nom, $type,$base,$etat);
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
public function configRobots(){
$droid = new Android();

  $droid->dialogCreateAlert("Configuration des robots :");
         $confRob = array("Ajouter un robot", "Modifier un robot","Supprimer un robot");
         $droid->dialogSetItems($confRob);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$confRob=$confRob[$result['result']->item];
//for($i=0;$i<sizeof($result);$i++){
//print $i." ".$confRob[$result['$i']];
switch($confRob){
case "Ajouter un robot":
$this->addRobot();
break;
case "Modifier un robot":
//$robot_nom=explode("|",$this->selectRobot());
list($nom,$type,$etat)=explode("|",$this->selectRobot());
//var_dump($robot_nom[0],$robot_nom[1],$robot_nom[2]);
//echo $robot;
//echo $nom;
$robot= new Robot($nom,$type,$etat);
//$robot->modif($robot_nom);
//$robot->setDemarrage();
//$robot->changeEtat(0);
break;
case "Supprimer un robot":
$robot=$this->selectRobot();

$this->delRobot($robot);
break;
default:
$this->selectConfig();
}
}


public function addRobot(){
$nom="";
$type="";
$droid = new Android();

$file=Range::_racine."/Robots/robots.txt";
//echo $file;
if (file_exists($file)) { 
 $fp = fopen($file, "a");
//while($nom!="s"){
$result=$droid->dialogGetInput('Nouveau Robot', 'Entrez son nom :', null);
$nom=$result['result'];
if($nom!=""){
$droid->dialogCreateAlert("Type du robot :");
  $types=$this->getTypes();
    //     $type = array("phone", "range","peintre","drone transport","autre");
         $droid->dialogSetItems($types);
         $droid->dialogShow();
         $result = $droid->dialogGetResponse();
$type=$types[$result['result']->item];
$etat=0;
$base="13 gare/dégagement";
$ligne=$nom."|".$type."|".$base."|".$etat."\n";
$result=fputs($fp, $ligne);
}
//}
 fclose ($fp);
$this->configRobots();
}

else { $fh = fopen($file, "w");
 if($fh==false) die("unable to create file"); 
/*fputs ($fh, 1); 
fclose ($fh); 
$count = file($file);
 echo $count[0]; */
echo "fichier robots.txt créé vide";
}
// fin add robots
}

public function delRobot($robot){
$file=Range::_racine."/Robots/robots.txt";
 $lignes = file($file); 
foreach ($lignes as $num => $data){
if(strpos($data, $robot)===0){
unset ($lignes[$num]);
}
}
$handle=fopen($file, 'w+');
fwrite($handle, implode($lignes));
fclose($handle);
$this->configRobots();
}

public function selectRobot(){
// Quel robot

$file=Range::_racine."/Robots/robots.txt";
$tab=file($file);

$droid = new Android();
 $droid->dialogCreateAlert("Choisissez un robot:");
         $droid->dialogSetItems($tab);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$robot=$tab[$result['result']->item];
echo "config de ".$robot;
return $robot;
}

public function getTypes(){
$list= new Commun;
$list->ScanDirectory("/sdcard/_ExternalSD/Range/Robots/Type");
var_dump($list->getEntrees());
return $list->getEntrees();


}




}