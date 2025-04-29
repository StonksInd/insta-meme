<link rel="stylesheet" href="css/recherche.css">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
<?php
require_once 'php/affichage.php';
require_once 'php/db.php';
echo pageHeader("Menu Insta Meme");

$stmt = db()->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo LIKE ?");
$stmt->execute(["%" . $_GET["recherche"] . "%"]);
$contenus = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(!empty($contenus)){
    foreach($contenus as $contenu){
        echo  '<h2 class="text-lg font-medium"><a href="user_ac.php?pseudo='.$contenu['pseudo'].'" class="text-indigo-600 hover:underline">'.$contenu['pseudo'].'</a></h2>';
    }
}
else{
    echo "<p class='text-red-500'>Il n'y a pas de compte de ce genre qui existe</p>";
}
echo pageFooter();
?>