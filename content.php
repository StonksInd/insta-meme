<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

$stmt = db()->prepare("SELECT contenus.*, utilisateurs.pseudo, COUNT(likes.id_contenu) as likes
FROM contenus 
JOIN utilisateurs ON  contenus.id_utilisateur = utilisateurs.id 
LEFT JOIN likes ON contenus.id = likes.id_contenu
WHERE contenus.id = :id
GROUP BY contenus.id");
$stmt->execute([
    'id' => $_GET["contenu"]
]);
$contenus = $stmt->fetch();

$commentaires = db()->prepare("SELECT commentaires.* FROM commentaires");
$commentaires->execute();
$commentaires = $commentaires->fetchAll();

?>

<?php echo pageHeader("Menu Insta Meme");?>
<link rel="stylesheet" href="css/content.css">
<main>
<?php
        echo 


        '<div id=span>'
        . '<h2>'. $contenus['pseudo'] .'</h2>'
        .'<a href="content.php"><article> <img src="' . 'images/' . $contenus['chemin_image'] . '" class="meme" /></article></a>'
        .'<div id="reaction">'
        .'<button>aimer</button>'
        .'<button>partage</button>'

       
       .'</div>'
       .'<p id=P1>'
        .'Aimé par ' . $contenus['likes'] . " utilisateurs"
        .'</p>'
        .'<p id=P1>'
        . $contenus['description']
        .'</p>'
        .'<form>'
        .    '<textarea class="carrecommentaire" placeholder="Commentaire : ">'
        . foreach($commentaire in $commentaire){$commentaires['message'];} 
        .'</textarea>'
        .'</form>'
    .'</div>';
            
    
    ?> 



</main>

<?php echo pageFooter(); ?>