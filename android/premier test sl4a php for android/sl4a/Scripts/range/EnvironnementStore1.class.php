<?php

require_once("Android.php");
$droid = new Android();

class EnvironnementStore extends SplObjectStorage {

private $_path;


public function attach(Environnement $environnement) {
 parent::attach($environnement);}

public function detach(Environnnement $environnement) { 
parent::detach($environnement); }

public function liste() {
echo "\n".count($this)." environnements \n";
foreach($this as $environnement) { 
echo $environnement->affiche(); } }

public function setEnvironnementStore(){
$this->removeAll($this);
$rep=Range::_racine."Environnements";
//include('Scripts/contenuRep.php');
$liste=$this->ScanDirectory($rep,1);
for($i=0;$i<sizeof($liste);$i++){
$nom=$liste[$i];
$config=file($rep."/".$liste[$i]."/config.txt");
$environnement= new Environnement($nom,$config,$rep);
$this->attach($environnement); }
$this->liste();}

public function configEnv(){
$result="";
$droid = new Android();

  $droid->dialogCreateAlert("Configuration des environnements :");
         $confEnv = array("Ajouter un environnement", "Modifier un environnement","Supprimer un environnement");
         $droid->dialogSetItems($confEnv);
         $droid->dialogShow();

         $result = $droid->dialogGetResponse();
$confEnv=$confEnv[$result['result']->item];
switch($confEnv){
case "Ajouter un environnement":
$this->addEnv();
break;
case "Modifier un environnement":
$path=Range::_racine."Environnements/";
$retourselect=$this->select($path,"1");
//echo $retour;
//var_dump($retourselect);
$path=$retourselect[0];
$nom=$retourselect[1];
$pathParent=$retourselect[2];
echo "Modification de : ".$nom."\n \t dans ".$pathParent;
//var_dump($path);
//echo $nom;
$env=new Environnement($nom,$path."/config.txt",$pathParent);
$env->modif();
break;
case "Supprimer un environnement":
$env=$this->selectEnv();
$this->delEnv($env);
break;
default:
Range::demarrage();
break;
}
}

function select($path,$nom){
$droid = new Android();
$result['result']->which=" ";
$tab=$this->ScanDirectory($path,1);
$droid->dialogCreateAlert("Sélection d'un environnement", "Choisissez l'environnement puis Validez :");
$droid->dialogSetItems($tab);
$droid->dialogSetPositiveButtonText('Valider');
$droid->dialogSetNegativeButtonText('Annuler');
$droid->dialogShow();

        $result = $droid->dialogGetResponse();
foreach ($result['result'] as $attribut => $valeur) { 
//echo '<strong>', $attribut, '</strong> => ', $valeur;
if ($attribut=="which"){
switch($result['result']->which) {
 case 'positive':
$nomValide=$nom;
$pathValide=$path;
$pathParentValide=$this->_pathParent;
echo $path;
$this->_retourValide[]=$path;
$this->_retourValide[]=$nom;
$this->_retourValide[]=$pathParentValide;
break;
case "negative":
echo "annule";
break;
default:
$this->configEnv();
break;
}

}
else{
$reponse=$tab[$result['result']->item];
$nom=$reponse;
echo 
"parent";
$this->_pathParent=$path;
$this->select($path.$reponse."/",$nom);
}
}
if($this->_retourValide){
//echo "Walide ".$this->_retourValide[1];
return $this->_retourValide;
}
}




function ScanDirectory($Directory,$profondeur){
$this->_listRep=array();
$this->_profondeur=$profondeur;
//echo "prof ".$profondeur;
echo $Directory."=repertoire";
$MyDirectory = opendir($Directory) or die('Erreur');
 while($Entry = @readdir($MyDirectory)) {
if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
//echo $Entry;
$this->_listeRep[]=$Entry;

// echo $Directory."/".$Entry."\n";
// echo '<ul>'.$Directory;
// suppression pour un seul niveau
if($this->_profondeur==0){
$this->ScanDirectory($Directory.'/'.$Entry,$this->_profondeur);
}
// echo '</ul>'; 
//echo "\n";
} else { 
//echo '<li>'.$Entry.'</li>'; 
if( $Entry != '.' && $Entry != '..') {
//echo $Entry."\n";
}
}
 }
 closedir($MyDirectory); 
if(isset($this->_listeRep)){return $this->_listeRep;}
}


function addEnv(){
$nom="";
$config[]=array(0,0);
$droid = new Android();
$name = $droid->dialogGetInput('Donnez-lui un nom : ');
$nom= $name['result'];
//$env=new Environnement($nom,$config);
$this->inclusion($nom);
/*break;

$env->choisir();
$env->reconnaissance();


Environnement::checkReseau();
Environnement::checkCoordonnees();
Environnement::checkAdresse();
Environnement::checkConnu();

//Environnement::choisir();
//Environnement::reconnaissance();
if(!$connu){
$this->nouveauEnvironnement($nom,$config);
echo "actualiz des repertoires";

}
*/}

function inclusion ($nom){
$path=Range::_racine."Environnements";
$droid = new Android();
$droid->dialogCreateAlert("Inclusion d'un environnement : ".$nom , "Cet environnoment est-il dépendant d'un environnement référencé ?");
$droid->dialogSetPositiveButtonText('Oui');
$droid->dialogSetNegativeButtonText('Non');
$droid->dialogSetNeutralButtonText('Rechercher');
$droid->dialogShow();

        $droid->dialogShow();

        // Wait for user input
        $result = $droid->dialogGetResponse();


        switch ($result['result']->which) {
        case "neutral":
        echo "Rechercher . Cette fonction n'est pas active \n";
      //  $this->inclusion($nom);
      //  $droid->dialogCreateSeekBar(50, 100, 'title', 'message');
        break;
        case "negative":
        echo "pas d'inclusion , creation d' nouveau dans ".$path."\n";

        break;
        case "positive":
        echo "liste pour inclusion";
        $path=$this->calculPath($path);
        break;
        default:
        echo "Retour";
        break;
        }
        $droid->dialogDismiss();
 echo " verif si n existe pas deja sinon renommer ou incrementer";
$nouveau=mkdir($path."/".$nom);
fopen($path."/".$nom."/config.txt","w");
$this->setEnvironnementStore();
//echo $nouveau;
return $path;}

function calculPath($path){
$droid = new Android();
$tab=$this->ScanDirectory($path,1);
$droid->dialogCreateAlert("Inclusion d'un environnement dans un autre environnement", "Choisissez l'environnement parent puis Validez :");
$droid->dialogSetItems($tab);
$droid->dialogSetPositiveButtonText('Valider');
$droid->dialogSetNegativeButtonText('Annuler');
$droid->dialogShow();
        $result = $droid->dialogGetResponse();
       // $reponse=$result['result']->which;
       $reponse=$tab[$result['result']->item];
//var_dump($reponse);
//var_dump($result);

       
//echo $reponse;
        switch ($result['result']->which) {
        case "negative":
        echo "retour";

        break;
        case "positive":
        echo "Valider";
       
        break;
        default:
     //   echo $reponse;
            $path=$this->calculPath($path."/".$reponse."/"); 
   break; 
        }
//echo $path;
return $path;
}

function nouveauEnvironnement($nom,$config){
$environnement= new Environnement($nom,$config);
$this->_environnements->attach($environnement); 
}
}