<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

$stmt = db()->prepare("SELECT contenus.*, utilisateurs.pseudo, COALESCE(likes_count.likes, 0) as likes,
GROUP_CONCAT(DISTINCT commentaires.message SEPARATOR '/ ') AS messages
FROM contenus 
JOIN utilisateurs ON  contenus.id_utilisateur = utilisateurs.id 
LEFT JOIN (
    SELECT id_contenu, COUNT(*) as likes
    FROM likes
    GROUP BY id_contenu
) as likes_count ON contenus.id = likes_count.id_contenu
LEFT JOIN commentaires ON contenus.id = commentaires.id_contenu
WHERE contenus.id = :id
GROUP BY contenus.id");
$stmt->execute([
    'id' => $_GET["contenu"]
]);
$contenus = $stmt->fetch();

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
<link rel="stylesheet" href="css/content.css">
<main>
<?php
        echo 


        '<div id=span>'
        . '<h2><a href="user_ac.php?pseudo='.$contenus['pseudo'].'">'.$contenus['pseudo'].'</a>  </h2>'
        .'<a href="content.php?contenu='.$contenus["id"].'"><article> <img src="' . 'images/' . $contenus['chemin_image'] . '" class="meme" /></article></a>'

        .'<div id="reaction">'
        .'<form action="like.php" method="POST" enctype="multipart/form-data" >
            <input type="hidden" value="' . $contenus['id'] . '" name="id_contenu">
            <button name="like" type="submit">Like</button>
        </form>'

        .'<a href="partage.php?fichier='. $contenus['chemin_image'] .'"><button type="button">Partage</button></a>'
        .'</div>'

       .'<p id=P1>'
        .'Aimé par ' . $contenus['likes'] . ' utilisateurs'
        .'</p>'
        .'<p id=P1>'
        . $contenus['description']
        .'</p>'
        
        .'<form action="content.php?contenu=' . $_GET["contenu"].'" method="POST" enctype="multipart/form-data">'
        .'<div class="carrecommentaire">'. $contenus['messages'] . '</div>';
        if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){
            echo
         '<label for="commentaire"></label>'
        . '<input type="text" name="commentaire">'
        . '<input type="hidden" name="id_contenu" value="'. $contenus['id'] .'">'
        . '<button type="submit">Publier un commentaire</button>';
        }
        else{
            echo
            '<a href="login.php"><button type="button">Connectez-vous pour commenter</button></a>';
        }
        echo '</form>'
    .'</div>'; 
            
    
    ?> 
    

</main>

<?php echo pageFooter(); ?>