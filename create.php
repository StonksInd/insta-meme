<?php
require_once 'php/affichage.php';
require_once 'php/db.php';
?>

<?php echo pageHeader("Menu Insta Meme");?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">

<main class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
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
                echo "<p class='text-red-500'>erreur " . $error . "</p>"; 
            }
            else{
                echo "<p class='text-red-500'>image trop lourde</p>";
            }
        }
        ?>
        <form action="create.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <label for="file" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" name="file" accept="image/png, image/jpeg, image/jpg, image/gif" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <input type="text" name="description" class="block w-full border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Poster</button>
        </form>
    </div>
</main> 

<?php echo pageFooter(); ?>