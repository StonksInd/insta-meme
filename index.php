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
$nb_elt_page = 10;
$nb_pages= ceil($tcount[0]["cpt"]/$nb_elt_page);
$debut=($page-1)* $nb_elt_page;

//Recupere le contenu
$stmt = db()->prepare("SELECT contenus.*, utilisateurs.pseudo
FROM contenus 
JOIN utilisateurs ON  contenus.id_utilisateur = utilisateurs.id 
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
        . '<h2>  '. $contenu['pseudo'] .' </h2>'
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
<?php
for($i;$i<=$nb_pages;$i++){
    if($page!=$i)
        echo "<a href='?page=$i'>$i</a>&nbsp;";
    else
        echo "<a>$i</a>&nbsp;";
}

?> 
<?php echo pageFooter(); ?>