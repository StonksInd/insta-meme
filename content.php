<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

$stmt = db()->prepare("SELECT * FROM contenus");
$stmt->execute();
$contenus = $stmt->fetchAll();
?>

<?php echo pageHeader("Menu Insta Meme");?>
<link rel="stylesheet" href="css/content.css">
<main>
    
    <article><img src="../image/img1.gif" alt="" class=" meme"></article>

<div id="crea">
    <h2> Jean</h2>
    <p id=P1>
        Descriptions : <br />
         Lorem ipsum dolor sit amet,<br />
         consectetur adipiscing elit.<br />
         Vestibulum vel accumsan nibh. <br />
         Cras aliquet rutrum sem.<br />
    </p>
    <div id="reaction">
    <button id="lish">aimer</button>
    <button id="lish">partage</button>
    </div>

   <p id=P1>
    Aimé par ...<br />
    <br />
    
    </p>

    <form>
        <textarea class="carrecommentaire" placeholder="Commentaire :"></textarea>
    </form>
</div>



</main>

<?php echo pageFooter(); ?>