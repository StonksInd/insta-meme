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
    <?php  
    if(isset($_FILES['file'])){
        $tmpName = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $taille_max = 20000000; //20 mo

        if($size <$taille_max and $error==0){
            $unique_name=uniqid('',false);
            $file_name = explode(".", $name)[0] . "." . $unique_name . '.' . explode("." , $name)[1] ;
            
            move_uploaded_file($tmpName, './images/'.$file_name);
        }
        elseif($error!=0){
            echo "erreur " . $error; 
        }
        else{
            echo "image trop lourde";
        }
        
    }

    
    
    
    ?>
    <form action="create.php" method="POST" enctype="multipart/form-data">
        <label for="file">Image</label>
        <input type="file" name="file" accept="image/png, image/jpeg, image/jpg, image/gif">
        <button type="submit"> Poster </button>


    </form>








<!-- <div id="post">

        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
        <form>
            <textarea class="carrecommentaire" placeholder="Champs de description :"></textarea>
        </form>

        <button id="publication">Publier</button>
    </div>-->
</main> 

<?php echo pageFooter(); ?>