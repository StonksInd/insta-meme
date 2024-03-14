
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/header.css">
</head>

<body>

<header>
        
        <div id="img_logo">
            <a class="Button" href="index.php"> <img src="image/Logo.png" alt="" width="70" style="padding-right:5px;"></a>
            
            <a class="Button" href="index.php"> Acceuil </a>
        </div>

        <div>
            <input type="search" placeholder="Rechercher un compte…" size="30">
            <button>Rechercher</button>
        </div>

        <div> 
            <a class="Button" href="create.php">Créer</a>
            
            <?php if(isset($_SESSION["Is_conected"]) && $_SESSION["Is_conected"]){
                echo '<a class="Button" href="deco.php">deco</a>&nbsp;'
                .  '<a class="Button" href="user_ac.php?pseudo='. $_SESSION['pseudo'] .'">profil</a>&nbsp;';

            } else{
                echo '<a class="Button" href="login.php">Login</a>';
            }
            ?>
        </div>
        
        
    </header>


    