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
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
<?php echo pageHeader("Menu Insta Meme");?>

<div class='container mx-auto p-4'>
    <form action="" method="post" class="bg-white p-8 rounded-lg shadow-lg w-96">
        <ul class="space-y-4">
            <li>
                <label for="name" class="block text-sm font-medium text-gray-700">Pseudo&nbsp;:</label>
                <input type="text" name="user_pseudo" class="block w-full border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
            </li>
            <li>
                <label for="mail" class="block text-sm font-medium text-gray-700">Password&nbsp;:</label>
                <input type="password" name="password" class="block w-full border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
            </li>
            <?php if(isset($_POST['user_pseudo']) && !empty($_POST['user_pseudo'])&& isset($_POST['password']) && !empty($_POST['password']))
                {if(count($utilisateur) <= 0){echo '<p class="text-red-500">Il y a erreur dans le pseudo ou le compte n\'existe pas</p>' . '<a href="inscription.php" class="text-indigo-600 hover:underline">Inscription</a>';}}
                ?>
            <li>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Connexion</button>
            </li>
        </ul>
    </form>
</div>

<?php echo pageFooter(); ?>