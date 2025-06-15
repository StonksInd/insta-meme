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
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
<?php echo pageHeader("Menu Insta Meme");?>

<div class='flex items-center justify-center min-h-screen bg-gray-100'>
    <form action="" method="POST" class="bg-white p-8 rounded-lg shadow-lg w-96 ">
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
                {if(count($utilisateur) > 0){echo '<p class="text-red-500">Ce pseudo est déjà pris, choisissez en un autre</p>';}
                elseif(count($utilisateur) <= 0){echo '<p class="text-green-500">Compte créé</p>';}}
                ?>
            <li>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Inscription</button>
            </li>
        </ul>
    </form>
</div>

<?php echo pageFooter(); ?>