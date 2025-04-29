<?php
require_once 'php/affichage.php';
require_once 'php/db.php';
?>

<?php echo pageHeader("Menu Insta Meme");?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
<?php
if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){
    if(isset($_POST['description']) and !empty($_POST['description'])){
        $stmt = db()->prepare("INSERT INTO contenus (id_utilisateur, description, chemin_image, date_publication) VALUES (?, ? ,? ,CURRENT_TIMESTAMP)");
        $stmt->execute([ $_SESSION["id_user"], $_POST["description"], $_GET['fichier']]);
        header("Location: user_ac.php?pseudo=".$_SESSION["pseudo"]."");
    }
    echo
    '<article class="container mx-auto p-4">
        <img src="' . 'images/' . $_GET['fichier'] . '" class="w-full rounded-lg" />
        <form action="partage.php?fichier='.$_GET['fichier'].'" method="POST" class="mt-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <input type="text" name="description" class="block w-full border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Poster</button>
        </form>
    </article>';
}else{
    header("Location: login.php");
}
?>
<?php echo pageFooter(); ?>