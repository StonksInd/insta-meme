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
$stmt = db()->prepare("SELECT contenus.*, utilisateurs.pseudo,  COALESCE(likes_count.likes, 0) AS likes,
GROUP_CONCAT(DISTINCT commentaires.message SEPARATOR '/ ') AS messages
FROM contenus 
JOIN utilisateurs ON  contenus.id_utilisateur = utilisateurs.id 
LEFT JOIN (
    SELECT id_contenu, COUNT(*) as likes
    FROM likes
    GROUP BY id_contenu
) as likes_count ON contenus.id = likes_count.id_contenu
LEFT JOIN commentaires ON contenus.id = commentaires.id_contenu
GROUP BY contenus.id

LIMIT $debut, $nb_elt_page ");
$stmt->execute();
$contenus = $stmt->fetchAll();
if(count($contenus)==0)
    header("location:./");
?>

<?php
if(isset($_POST["commentaire"])){
    $commentaires = db()->prepare(
        "INSERT INTO commentaires (id_contenu, id_utilisateur, message, date_publication) 
        VALUES (?, ? ,? ,CURRENT_TIMESTAMP)");
    $commentaires->execute([$_POST["id_contenu"], $_SESSION["id_user"], $_POST["commentaire"]]);
    
}

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

        .'<div id="reaction">'
        .'<form action="like.php" method="POST" enctype="multipart/form-data" >
            <input type="hidden" value="' . $contenu['id'] . '" name="id_contenu">
            <button name="like" type="submit">Like</button>
        </form>'

        .'<form action="partage.php" method="POST" enctype="multipart/form-data" >
        <input type="hidden" value="' . $contenu['id'] . '" name="id_contenu">
        <button name="partage" type="submit">Partage</button>
        </form>'
        .'</div>'

       .'<p id=P1>'
        .'Aimé par ' . $contenu['likes'] . " utilisateurs"
        .'</p>'
        .'<p id=P1>'
        . $contenu['description']
        .'</p>'
        .'<form action="index.php" method="POST" enctype="multipart/form-data">'
        .'<div class="carrecommentaire">'. $contenu['messages'] . '</div>'
        . '<label for="commentaire"></label>'
        . '<input type="text" name="commentaire">'
        . '<input type="hidden" name="id_contenu" value="'. $contenu['id'] .'">'
        . '<button type="submit">Publier un commentaire</button>'

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
//partage -->