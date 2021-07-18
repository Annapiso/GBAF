<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf_8"/>
        <title>Header</title>
        <link rel="stylesheet" href="style.css" />
        
    </head>
    <body>

        <div id="logo"> <!--logo gbaf-->
            <a href="index.php"> <img src="image/logo.png"/></a>
        </div>

        <div class="connexion">
        <?php
        session_start(); //initialisation de la session
        include("connexionbdd.php");
        if(isset($_SESSION['Nom_visiteur']) && isset($_SESSION["prenom_visiteur"])){ // si l'utilisateur est déjà connecté
            ?>
            <ul id="menu">           
                <?php
            
                 echo "<div class=\"compte\">"."<img src=\"image/compte.png\">"." "."<div class=\"utilisateur\">"."<h1>".htmlspecialchars($_SESSION["Nom_visiteur"])." ".htmlspecialchars($_SESSION["prenom_visiteur"])."</h1>"."</div>"."</div>";
                ?>
                <li class="sousMenu"><ul>
                <?php
                echo "<p>"."<a href=\"deconnexion.php\">Déconnexion</a>"."</p>";?></a></ul><ul><?php
                echo "<p>"."<a href=\"modifID.php\">Paramètres du compte</a>"."</p>";
                ?></a></ul></li></ul>         
                 <?php
        }
        else
        {

        }
        ?>
        </div>


    </body>
</html>