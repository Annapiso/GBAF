<naV>
    <div id="logo"> <!--logo gbaf-->
    <a href="index.php"> <img src="image/logo.png" alt=""/></a>
    </div>
    <?php
    session_start(); //initialisation de la session
    include("connexionbdd.php");
    if(isset($_SESSION['Nom_visiteur']) && isset($_SESSION["prenom_visiteur"])){ // si l'utilisateur est déjà connecté
    ?>
    <div id="menu">  
        <?php
        echo "<div class=\"compte\">"."<img src=\"image/compte.png\" alt=\"\">"." "."<div class=\"utilisateur\">"."<h1>".htmlspecialchars($_SESSION["Nom_visiteur"])." ".htmlspecialchars($_SESSION["prenom_visiteur"])."</h1>"."</div>"."</div>";
        ?>
            <div>
            <ul class="sousMenu">
                <li>
            <?php
            echo "<a href=\"deconnexion.php\">Déconnexion</a>";?></li><li><?php
            echo "<a href=\"modifID.php\">Paramètres du compte</a>";?></li></ul> 
            </div>
         <?php
        }
        else
        {
        }
        ?>
    </div>
</naV>
