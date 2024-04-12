<link rel="stylesheet" href="css/recherche.css">
<?php
require_once 'php/affichage.php';
require_once 'php/db.php';
echo pageHeader("Menu Insta Meme");



$stmt = db()->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo LIKE ?");
$stmt->execute(["%" . $_GET["recherche"] . "%"]);
$contenus = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(!empty($contenus)){
foreach($contenus as $contenu){
    echo  '<h2><a href="user_ac.php?pseudo='.$contenu['pseudo'].'">'.$contenu['pseudo'].'</a>  </h2>';
}}
else{
    echo "il n'y a pas de compte de ce genre qui existe";
}






echo pageFooter(); ?>
