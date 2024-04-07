<?php
require_once 'php/affichage.php';
require_once 'php/db.php';
?>

<?php echo pageHeader("Menu Insta Meme");?>
<?php
if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){
    if(isset($_POST['description']) and !empty($_POST['description'])){



        $stmt = db()->prepare("INSERT INTO contenus (id_utilisateur, description, chemin_image, date_publication) VALUES (?, ? ,? ,CURRENT_TIMESTAMP)");
        $stmt->execute([ $_SESSION["id_user"], $_POST["description"], $_GET['fichier']]);
        header("Location: user_ac.php?pseudo=".$_SESSION["pseudo"]."");
    }




    echo
    '<article> <img src="' . 'images/' . $_GET['fichier'] . '" class="meme" /></article>'
    .'<form action="partage.php?fichier='.$_GET['fichier'].'" method="POST" enctype="multipart/form-data">
            <label for="description">Description</label>
            <input type="text" name="description">
            <button type="submit"> Poster </button>


        </form>';
}else{

    header("Location: login.php");
}

?>
<?php echo pageFooter(); ?>