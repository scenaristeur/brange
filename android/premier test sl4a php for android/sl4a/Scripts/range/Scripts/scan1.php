<?php
// version 1.0
require_once("Android.php");
$droid = new Android();
$listeRep="";
$listeFichiers="";

function ScanDirectory($Directory,$profondeur,$fichiers){
//si profondeur =0 pas de limite
$profondeur--;
// fichiers affiche les fichiers bool
//echo $Directory."=repertoire";
$MyDirectory = opendir($Directory) or die('Erreur');
 while($Entry = @readdir($MyDirectory)) {
if(is_dir($Directory.'/'.$Entry)&& $Entry != '.' && $Entry != '..') {
$rep=$Entry;
$chemin=$Directory."/".$Entry;
$listeRep[]=$rep;
$listeChemins[]=$chemin;
//affiche repertoires
//echo $rep."\n";
// echo '<ul>'.$Directory;
if($profondeur<>0){
ScanDirectory($Directory.'/'.$Entry,$profondeur,$fichiers);}
// echo '</ul>'; 
//echo "\n";
} else { 
//echo '<li>'.$Entry.'</li>'; 
if( $Entry != '.' && $Entry != '..'&& $fichiers) {
//affiche fichiers
//echo $Entry."\n";
$listeFichiers[]=$Entry;
}
}
 }
 closedir($MyDirectory); 
 if($listeRep){$retour[0]=$listeRep;}
 if($listeFichiers){$retour[1]=$listeFichiers;}
 if($listeChemins){$retour[2]=$listeChemins;}
 return $retour;
}