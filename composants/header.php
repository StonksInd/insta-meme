<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a class="Button" href="index.php"> 
                <img src="image/Logo.png" alt="" width="70" style="padding-right:5px;">
            </a>
            <a class="Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700" href="index.php">Accueil</a>
        </div>

        <div>
            <form action="" method="post" class="flex items-center">
                <label for="name"></label>
                <input type="search" name="pseudo" placeholder="Rechercher un compte…" size="30" class="block w-full border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500">
                <button type="submit" class="bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Rechercher</button>
            </form>
            <?php if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
                header("location:recherche.php?recherche=". $_POST['pseudo']." ");
            }
            ?>
        </div>

        <div> 
            <?php if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){
                echo '<a class="Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700" href="deco.php">Deconnexion</a>&nbsp;'
                .  '<a class="Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700" href="user_ac.php?pseudo='. $_SESSION['pseudo'] .'">Profil</a>&nbsp;'
                . '<a class="Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700" href="create.php">Nouveau post</a>';
            } else{
                echo '<a class="Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700" href="login.php">Connexion</a>&nbsp;'
                . '<a class="Button bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700" href="inscription.php">Inscription</a>';
            }
            ?>
        </div>
    </div>
</header>