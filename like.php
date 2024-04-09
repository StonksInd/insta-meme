<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){

        $count = db()->prepare("SELECT count(id_contenu) as cpt from likes WHERE id_utilisateur = ? AND id_contenu = ?");
        $count->execute([$_SESSION["id_user"], $_POST['id_contenu']]);
        $count = $count->fetchAll();
        
        if ($count[0]['cpt'] == 0) {

            $insert = db()->prepare("INSERT INTO likes (id_utilisateur, id_contenu) VALUES (?, ?)");
            $insert->execute([$_SESSION["id_user"], $_POST['id_contenu']]);
            header("location:index.php?page=". $_GET['page']."");
        }
        elseif ($count[0]['cpt'] == 1) {

            $delete = db()->prepare("DELETE FROM likes WHERE id_utilisateur = ? AND id_contenu = ?");
            $delete->execute([$_SESSION["id_user"], $_POST['id_contenu']]);
            header("location:index.php?page=". $_GET['page']."");
        } 

        

    }
    else{
        header("Location: login.php");

    }
}

?>