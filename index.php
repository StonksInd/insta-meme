<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

$stmt = db()->prepare("SELECT * FROM contenus");
$stmt->execute();
$contenus = $stmt->fetchAll();
?>

<?php echo pageHeader("Menu Insta Meme");?>

<div class="grid grid-cols-3 gap-8">
    <!-- <?php
    foreach ($contenus as $contenu) {
        echo '<div class="flex flex-col justify-center items-center space-y-2" id="' . $contenu['id'] . '">'
            . '<img src="' . 'images/' . $contenu['chemin_image'] . '" class="h-40" />'
            . $contenu['description']
            . '</div>';
    }
    ?> -->
</div>

<link rel="stylesheet" href="css/style.css">
<main>
    
        
    <div id=span>
        <h2> Jean</h2>
        <a href="content.html"<article><img src="../image/img1.gif" alt="" class=" meme"></article></a>
        <div id="reaction">
        <button>aimer</button>
        <button>partage</button>

       
       </div>
       <p id=P1>
        Aimé par ...
        </p>
        <p id=P1>
            Descriptions
        </p>
        <form>
            <textarea class="carrecommentaire" placeholder="Commentaire :"></textarea>
        </form>
    </div>

    <div id=span>
        <h2> Bap tout fragile</h2>
        <a href="content.html"<article><img src="../image/img2.jpeg" alt="" class=" meme"></article></a>
        <div id="reaction">
            <button>aimer</button>
            <button>partage</button>

           
           </div>
           <p id=P1>
            Aimé par ...
            </p>
            <p id=P1>
                Descriptions
            </p>
            <form>
                <textarea class="carrecommentaire" placeholder="Commentaire :"></textarea>
            </form>
    </div>

    <div id=span>
        <h2> Bernard</h2>
        <a href="content.html"<article><img src="../image/img3.jpeg" alt="" class=" meme"></article></a>
        <div id="reaction">
            <button>aimer</button>
            <button>partage</button>

           
           </div>
           <p id=P1>
            Aimé par ...
            </p>
            <p id=P1>
                Descriptions
            </p>
            <form>
                <textarea class="carrecommentaire" placeholder="Commentaire :"></textarea>
            </form>
    </div>

    
        <div id=span>
            <h2> Bernard</h2>
            <a href="content.html"<article><img src="../image/img6.gif" alt="" class=" meme"></article></a>
            <div id="reaction">
                <button>aimer</button>
                <button>partage</button>
    
               
               </div>
               <p id=P1>
                Aimé par ...
                </p>
                <p id=P1>
                    Descriptions
                </p>
                <form>
                    <textarea class="carrecommentaire" placeholder="Commentaire :"></textarea>
                </form>
        </div>
    

    <div id=span>
        <h2> Jean</h2>
        <a href="content.html"<article><img src="../image/img5.gif" alt="" class=" meme"></article></a>
        <div id="reaction">
            <button>aimer</button>
            <button>partage</button>

           
           </div>
           <p id=P1>
            Aimé par ...
            </p>
            <p id=P1>
                Descriptions
            </p>
            <form>
                <textarea class="carrecommentaire" placeholder="Commentaire :"></textarea>
            </form>
    </div>

    <div id=span>
        <h2> Batiste</h2>
        <a href="content.html"<article><img src="../image/img4.jpeg" alt="" class=" meme"></article></a>
        <div id="reaction">
            <button>aimer</button>
            <button>partage</button>

           
           </div>
           <p id=P1>
            Aimé par ...
            </p>
            <p id=P1>
                Descriptions
            </p>
            <form>
                <textarea class="carrecommentaire" placeholder="Commentaire :"></textarea>
            </form>
    </div>


</main>

<?php echo pageFooter(); ?>