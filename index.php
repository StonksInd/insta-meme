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
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

<main id="main" class="container mx-auto py-10 grid grid-cols-3 gap-4">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            foreach ($contenus as $contenu) {
                echo 
                '<div class="bg-white p-4 rounded-lg shadow-lg">
                    <h2 class="text-lg font-medium"><a href="user_ac.php?pseudo='.$contenu['pseudo'].'" class="text-indigo-600 hover:underline">'.$contenu['pseudo'].'</a></h2>
                    <a href="content.php?contenu='.$contenu["id"].'"><img src="' . 'images/' . $contenu['chemin_image'] . '" class="meme" /></a>
                    <div class="flex items-center mt-2">
                        <form action="like.php" method="POST" class="mr-2">
                            <input type="hidden" value="' . $contenu['id'] . '" name="id_contenu">
                            <button name="like" type="submit" class="Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Like</button>
                        </form>
                        <a href="partage.php?fichier='. $contenu['chemin_image'] .'" class="Button bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">Partage</a>
                    </div>
                    <p class="mt-2">Aimé par ' . $contenu['likes'] . ' utilisateurs</p>
                    <p class="mt-2">' . $contenu['description'] . '</p>
                    <div class="carrecommentaire mt-2">' . $contenu['messages'] . '</div>';
                if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){
                    echo '
                    <form action="index.php" method="POST" class="mt-2">
                        <input type="text" name="commentaire" class="block w-full border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                        <input type="hidden" name="id_contenu" value="'. $contenu['id'] .'">
                        <button type="submit" class="Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Publier un commentaire</button>
                    </form>';
                }
                else{
                    echo '<a href="login.php" class="Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Connectez-vous pour commenter</a>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
</main>

<div id="pagination" class="flex justify-center mt-4">
    <?php
    for($i=1;$i<=$nb_pages;$i++){
        if($page!=$i){
            echo "<a class='Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700' href='?page=$i'>$i</a>&nbsp;";
        }
        else{
            echo "<span class='bg-gray-300 px-2 py-1 rounded'>$i</span>&nbsp;";
        }
    }
    ?>
</div>

<?php echo pageFooter(); ?>