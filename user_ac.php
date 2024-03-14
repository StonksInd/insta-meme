<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

$stmt = db()->prepare("SELECT contenus.*, utilisateurs.pseudo, COUNT(likes.id_contenu) as likes, 
GROUP_CONCAT(DISTINCT commentaires.message SEPARATOR ', ') AS messages
FROM contenus 
JOIN utilisateurs ON  contenus.id_utilisateur = utilisateurs.id 
LEFT JOIN likes ON contenus.id = likes.id_contenu
LEFT JOIN commentaires ON contenus.id = commentaires.id_contenu
WHERE utilisateurs.pseudo :pseudo");
$stmt->execute();
$stmt->bindParam(":pseudo",$_SESSION["pseudo"]);
$contenus = $stmt->fetchAll();
?>

<?php echo pageHeader("Menu Insta Meme");?>
<link rel="stylesheet" href="css/user_ac.css">

<main>
    <?php
    foreach ($contenus as $contenu) {
        echo 
            
            
            
           

        '<div id=span>'
        . '<h2>  '. $contenu['pseudo'] .' </h2>'
        .'<a href="content.php"<article> <img src="' . 'images/' . $contenu['chemin_image'] . '" class="meme" /></article></a>'
        .'<div id="reaction">'
        .'<button>aimer</button>'
        .'<button>partage</button>'

       
       .'</div>'
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

<?php echo pageFooter(); ?>