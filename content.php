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
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
<main class="min-h-screen bg-gray-100 p-4">
    <div class="container mx-auto">
        <?php
        echo 
        '<div class="bg-white p-4 rounded-lg shadow-lg mb-4">
            <h2 class="text-lg font-medium"><a href="user_ac.php?pseudo='.$contenus['pseudo'].'" class="text-indigo-600 hover:underline">'.$contenus['pseudo'].'</a></h2>
            <a href="content.php?contenu='.$contenus["id"].'"><img src="' . 'images/' . $contenus['chemin_image'] . '" class="w-full rounded-lg" /></a>
            <div class="flex items-center mt-2">
                <form action="like.php" method="POST" class="mr-2">
                    <input type="hidden" value="' . $contenus['id'] . '" name="id_contenu">
                    <button name="like" type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Like</button>
                </form>
                <a href="partage.php?fichier='. $contenus['chemin_image'] .'" class="bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700">Partage</a>
            </div>
            <p class="mt-2">Aimé par ' . $contenus['likes'] . ' utilisateurs</p>
            <p class="mt-2">' . $contenus['description'] . '</p>
            <div class="carrecommentaire mt-2">' . $contenus['messages'] . '</div>';
        if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){
            echo '
            <form action="content.php?contenu=' . $_GET["contenu"].'" method="POST" class="mt-2">
                <input type="text" name="commentaire" class="block w-full border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                <input type="hidden" name="id_contenu" value="'. $contenus['id'] .'">
                <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Publier un commentaire</button>
            </form>';
        }
        else{
            echo '<a href="login.php" class="bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Connectez-vous pour commenter</a>';
        }
        echo '</div>';
        ?>
    </div>
</main>

<?php echo pageFooter(); ?>