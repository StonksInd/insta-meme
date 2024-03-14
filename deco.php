<?php 
session_start();

if($_SESSION["Is_conected"]){
    session_unset();
    session_destroy();
}
header("location:index.php");

?>