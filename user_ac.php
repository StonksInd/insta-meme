<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

$stmt = db()->prepare("SELECT contenus.*, utilisateurs.pseudo, COUNT(likes.id_contenu) as likes
FROM contenus 
JOIN utilisateurs ON  contenus.id_utilisateur = utilisateurs.id 
LEFT JOIN likes ON contenus.id = likes.id_contenu
WHERE utilisateurs.pseudo = :pseudo
GROUP BY contenus.id");
$stmt->execute([
    'pseudo' => $_GET["pseudo"]
]);
$contenus = $stmt->fetchAll();

$commentaires = db()->prepare("SELECT commentaires.* FROM commentaires");
$commentaires->execute();
$commentaires = $commentaires->fetchAll();


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
        .'</p>';

        echo '<form>'
        .    '<textarea class="carrecommentaire" placeholder="Commentaire : ">';
        foreach($commentaires as $commentaire){
            if($commentaire['id_contenu'] === $contenu['id']){
                echo $commentaire['message'];
            }
        } echo
        '</textarea>'
        .'</form>'
    .'</div>';
            
    }
        ?>
    
    </main>

<?php echo pageFooter(); ?>