<?php
require_once 'php/affichage.php';
require_once 'php/db.php';


?>

<?php echo pageHeader("Menu Insta Meme");?>
<link rel="stylesheet" href="css/create.css">

<main>
    <?php  
    if(isset($_FILES['file'])){
        $tmpName = $_FILES['file']['tmp_name'];//on recup les donné de notre fichier
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $taille_max = 20000000; //20 mo
        

        if($size <$taille_max and $error==0){//verifie que c good
            $unique_name=uniqid('',false);
            $file_name = explode(".", $name)[0] . "." . $unique_name . '.' . explode("." , $name)[1] ; //on met le nom du fichier correctement
            
            move_uploaded_file($tmpName, './images/'.$file_name);//on l'upload
            

            $stmt = db()->prepare("INSERT INTO contenus (id_utilisateur, description, chemin_image, date_publication) VALUES (?, ? ,? ,CURRENT_TIMESTAMP)");
            $stmt->execute([ $_SESSION["id_user"], $_POST["description"], $file_name]);
            
        }
        elseif($error!=0){
            echo "erreur " . $error; 
        }
        else{
            echo "image trop lourde";
        }
        
    }

    
    
    
    ?>
    <div id="post">
    <form action="create.php" method="POST" enctype="multipart/form-data">
        <label for="file">Image</label>
        <input type="file" name="file" accept="image/png, image/jpeg, image/jpg, image/gif">
        <label for="description">Description</label>
        <input type="text" name="description">
        <button type="submit"> Poster </button>


    </form>
    </div>








</main> 

<?php echo pageFooter(); ?>