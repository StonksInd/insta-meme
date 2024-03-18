<?php
require_once 'php/affichage.php';
require_once 'php/db.php';
//recup le nombre de contenus
$count = db()->prepare("SELECT count(id) as cpt from contenus ");
$count->setFetchMode(PDO::FETCH_ASSOC);
$count->execute();
$tcount=$count->fetchAll();

//Pagination
@$page=$_GET["page"];
if(empty($page)) $page=1;
$nb_elt_page = 9;
$nb_pages= ceil($tcount[0]["cpt"]/$nb_elt_page);
$debut=($page-1)* $nb_elt_page;

//Recupere le contenu
$stmt = db()->prepare("SELECT contenus.*, utilisateurs.pseudo, COUNT(likes.id_contenu) as likes, 
GROUP_CONCAT(DISTINCT commentaires.message SEPARATOR ', ') AS messages
FROM contenus 
JOIN utilisateurs ON  contenus.id_utilisateur = utilisateurs.id 
LEFT JOIN likes ON contenus.id = likes.id_contenu
LEFT JOIN commentaires ON contenus.id = commentaires.id_contenu
GROUP BY contenus.id
LIMIT $debut, $nb_elt_page ");
$stmt->execute();
$contenus = $stmt->fetchAll();
if(count($contenus)==0)
    header("location:./");
?>





<?php echo pageHeader("Menu Insta Meme");?>
<link rel="stylesheet" href="css/style.css">





<main>

<?php
    foreach ($contenus as $contenu) {
        echo 
            

        '<div id=span>'
        . '<h2><a href="user_ac.php?pseudo='.$contenu['pseudo'].'">'.$contenu['pseudo'].'</a>  </h2>'
        .'<a href="content.php?contenu='.$contenu["id"].'"><article> <img src="' . 'images/' . $contenu['chemin_image'] . '" class="meme" /></article></a>'
        .'<form action="like.php" method="POST" enctype="multipart/form-data" id="reaction">
            <button name="like" type="submit">Like</button>
            <button name="partage" type="submit">Partage</button>
        </form>'

       
       .'<p id=P1>'
        .'Aimé par ' . $contenu['likes'] . " utilisateurs"
        .'</p>'
        .'<p id=P1>'
        . $contenu['description']
        .'</p>'
        .'<form>'
        .    '<textarea class="carrecommentaire" placeholder="Commentaire : ">'. $contenu['messages'] . '</textarea>'
        .'</form>'
    .'</div>';
            
    }
    ?> 
    
</main>
<?php

for($i=1;$i<=$nb_pages;$i++){
    if($page!=$i){
        echo "<a class='Button' href='?page=$i'>$i</a>&nbsp;";}
    else{
        echo "<a>$i</a>&nbsp;";}
}

?> 
<?php echo pageFooter(); ?>


<!-- //! choses à ajouter :
//commentaires
//recherche avec auto complétion
//inscription
//likes
//partage -->