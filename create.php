<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

$stmt = db()->prepare("SELECT * FROM contenus");
$stmt->execute();
$contenus = $stmt->fetchAll();
?>

<?php echo pageHeader("Menu Insta Meme");?>
<link rel="stylesheet" href="css/create.css">

<main>
<div id="post">

        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
        <form>
            <textarea class="carrecommentaire" placeholder="Champs de description :"></textarea>
        </form>

        <button id="publication">Publier</button>
    </div>
</main>

<?php echo pageFooter(); ?>