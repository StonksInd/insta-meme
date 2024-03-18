<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){

        $count = db()->prepare("SELECT count(id_contenu) as cpt from likes WHERE id_utilisateur = ? AND id_contenu = ?");
        $count->execute([$_SESSION["id_user"], $_POST['id_contenu']]);
        $count=$count->fetchAll();
        echo $count[0]['cpt'];
    }


}



?>