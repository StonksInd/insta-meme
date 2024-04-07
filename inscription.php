<?php
require_once 'php/affichage.php';
require_once 'php/db.php';
if(isset($_POST['user_pseudo']) && !empty($_POST['user_pseudo'])
&& isset($_POST['password']) && !empty($_POST['password'])){
    $utilisateur = db()->prepare("SELECT id, pseudo FROM utilisateurs WHERE pseudo = ?");
    $utilisateur->setFetchMode(PDO::FETCH_ASSOC);
    $utilisateur->execute([$_POST['user_pseudo']]);
    $utilisateur=$utilisateur->fetchAll();
    if(count($utilisateur) <= 0){
        $insert = db()->prepare("INSERT INTO utilisateurs (pseudo, mot_de_passe, date_inscription) VALUES (?, ?, CURRENT_TIMESTAMP)");
        $insert->execute([$_POST["user_pseudo"], md5($_POST['password'])]);
    }
}

?>
<link rel="stylesheet" href="css/login.css">
<?php echo pageHeader("Menu Insta Meme");?>

<body>
<div class='formulaire'>
<form action="" method="POST">
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
                {if(count($utilisateur) > 0){echo 'Ce pseudo est déjà prit, choisissez en un autre';}
                
                
                elseif(count($utilisateur) <= 0){echo 'compte créé';}}
                
                ?>
    <li>
        <button type="submit">Inscription</button>
    </li>

  </ul>
</form>
</div>

</body>

<?php echo pageFooter(); ?>