<?php
require_once 'php/affichage.php';
require_once 'php/db.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){

        $count = db()->prepare("SELECT count(like) as cpt from contenus ");
        $count->setFetchMode(PDO::FETCH_ASSOC);
        $count->execute();
        $tcount=$count->fetchAll();
    }


}



?>