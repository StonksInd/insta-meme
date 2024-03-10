<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

$stmt = db()->prepare("SELECT * FROM contenus");
$stmt->execute();
$contenus = $stmt->fetchAll();
?>

<?php echo pageHeader("Menu Insta Meme");?>
<link rel="stylesheet" href="css/style.css">





<main>

<?php
    foreach ($contenus as $contenu) {
        echo 
            
            
            
           

        '<div id=span>'
        .'<h2> Jean</h2>'
        .'<a href="content.php"<article> <img src="' . 'images/' . $contenu['chemin_image'] . '" class="meme" /></article></a>'
        .'<div id="reaction">'
        .'<button>aimer</button>'
        .'<button>partage</button>'

       
       .'</div>'
       .'<p id=P1>'
        .'Aimé par ...'
        .'</p>'
        .'<p id=P1>'
        . $contenu['description']
        .'</p>'
        .'<form>'
        .    '<textarea class="carrecommentaire" placeholder="Commentaire :"></textarea>'
        .'</form>'
    .'</div>';
            
    }
    ?> 
    
</main>

<?php echo pageFooter(); ?>