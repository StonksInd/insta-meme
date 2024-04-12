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
WHERE utilisateurs.pseudo = :pseudo
GROUP BY contenus.id");
$stmt->execute([
    'pseudo' => $_GET["pseudo"]
]);
$contenus = $stmt->fetchAll();
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
<link rel="stylesheet" href="css/user_ac.css">

<main>
    <?php
    foreach ($contenus as $contenu) {
        echo 
            
            
            
           

        '<div id=span>'
        . '<h2>  '. $contenu['pseudo'] .' </h2>'
        .'<a href="content.php?contenu='.$contenu["id"].'"><article> <img src="' . 'images/' . $contenu['chemin_image'] . '" class="meme" /></article></a>'
        .'<div id="reaction">'
        .'<form action="like.php" method="POST" enctype="multipart/form-data" >
            <input type="hidden" value="' . $contenu['id'] . '" name="id_contenu">
            <button name="like" type="submit">Like</button>
        </form>'

        .'<a href="partage.php?fichier='. $contenu['chemin_image'] .'"><button type="button">Partage</button></a>'
        .'</div>'
       .'<p id=P1>'
        .'Aimé par ' . $contenu['likes'] . " utilisateurs"
        .'</p>'
        .'<p id=P1>'
        . $contenu['description']
        .'</p>'

        .'<form action="user_ac.php?pseudo='.$_GET["pseudo"].'" method="POST" enctype="multipart/form-data">'
        .'<div class="carrecommentaire">'. $contenu['messages'] . '</div>';
        if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){
            echo
         '<label for="commentaire"></label>'
        . '<input type="text" name="commentaire">'
        . '<input type="hidden" name="id_contenu" value="'. $contenu['id'] .'">'
        . '<button type="submit">Publier un commentaire</button>';
        }
        else{
            echo
            '<a href="login.php"><button type="button">Connectez-vous pour commenter</button></a>';
        }
        echo '</form>'
    .'</div>';
            
    }
        ?>
    
    </main>

<?php echo pageFooter(); ?>