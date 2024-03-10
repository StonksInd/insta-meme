<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

$stmt = db()->prepare("SELECT * FROM contenus");
$stmt->execute();
$contenus = $stmt->fetchAll();
?>

<?php echo pageHeader("Menu Insta Meme");?>
<link rel="stylesheet" href="css/user_ac.css">

<main>
    
        
        <div id=span>
            
            <article><img src="../image/img1.gif" alt="" class=" meme"></article>
            <div id="reaction">
                <button>aimer</button>
                <button>partage</button>
    
               
               </div>
        </div>

        <div id=span>
            
            <article><img src="../image/img2.jpeg" alt="" class=" meme"></article>
            <div id="reaction">
                <button>aimer</button>
                <button>partage</button>
    
               
               </div>
        </div>

        <div id=span>
            
            <article><img src="../image/img3.jpeg" alt="" class=" meme"></article>
            <div id="reaction">
                <button>aimer</button>
                <button>partage</button>
    
               
               </div>
        </div>

        
            <div id=span>
                
                <article><img src="../image/img6.gif" alt="" class=" meme"></article>
                <div id="reaction">
                    <button>aimer</button>
                    <button>partage</button>
        
                   
                   </div>
            </div>
        

        <div id=span>
            
            <article><img src="../image/img5.gif" alt="" class=" meme"></article>
            <div id="reaction">
                <button>aimer</button>
                <button>partage</button>
    
               
               </div>
        </div>

        <div id=span>
            
            <article><img src="../image/img7.jpeg" alt="" class=" meme"></article>
            <div id="reaction">
                <button>aimer</button>
                <button>partage</button>
    
               
               </div>
        </div>

        <div id=span>
            
            <article><img src="../image/img8.jpeg" alt="" class=" meme"></article>
            <div id="reaction">
                <button>aimer</button>
                <button>partage</button>
    
               
               </div>
        </div>

        <div id=span>
            
            <article><img src="../image/img4.jpeg" alt="" class=" meme"></article>
            <div id="reaction">
                <button>aimer</button>
                <button>partage</button>
    
               
               </div>
        </div>

      

    



    </main>

<?php echo pageFooter(); ?>