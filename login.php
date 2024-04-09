<?php
require_once 'php/affichage.php';
require_once 'php/db.php';
if(isset($_POST['user_pseudo']) && !empty($_POST['user_pseudo'])
&& isset($_POST['password']) && !empty($_POST['password'])){
    $utilisateur = db()->prepare("SELECT id, pseudo FROM utilisateurs WHERE pseudo = ? AND mot_de_passe = ?");
    $utilisateur->setFetchMode(PDO::FETCH_ASSOC);
    $utilisateur->execute([$_POST['user_pseudo'], md5($_POST['password'])]);
    $utilisateur=$utilisateur->fetchAll();
    if(count($utilisateur) > 0){
        $_SESSION["id_user"]= $utilisateur[0]['id'];
        $_SESSION["pseudo"] = $utilisateur[0]['pseudo'];
        $_SESSION["Is_conected"] = True;

        header('Location: index.php');
    }
}

?>
<link rel="stylesheet" href="css/login.css">
<?php echo pageHeader("Menu Insta Meme");?>

<body>
<div class='formulaire'>
<form action="" method="post">
  <ul>
    <li>
      <label for="name">Pseudo&nbsp;:</label>
      <input type="text" name="user_pseudo" />
    </li>
    <li>
      <label for="mail">Password&nbsp;:</label>
      <input type="password" name="password" />
    </li>
    <?php if(isset($_POST['user_pseudo']) && !empty($_POST['user_pseudo'])&& isset($_POST['password']) && !empty($_POST['password']))
                {if(count($utilisateur) <= 0){echo "Il y a erreur dans le pseudo ou le compte n'existe pas" .PHP_EOL
                  . '<a href="inscription.php"><button type="button">Inscription</button></a>';}} ?>

        <button type="submit">Connexion</button>

  </ul>
</form>
</div>

</body>

<?php echo pageFooter(); ?>