<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf_8"/>
        <title>Page de changement de mot de passe.</title>
        <link href="style.css" rel="stylesheet"  />
        <!--<script type="text/javascript">
        function cacherFormulaire(){
        document.getElementById("formulaire").style.display = "none";
        }
        </script>-->
        
    </head>
    <body>

        <header>
            <?php include("header.php")?>
        </header>

       <section>
        <?php 
        
        //session_start();
        include("connexionbdd.php");
        if(isset($_SESSION['Nom_visiteur']) && isset($_SESSION["prenom_visiteur"])){
            
                if(isset($_POST['resetinfo'])){
                    $newNom=$_POST["nom"];
                    $newPrenom=$_POST["prenom"];
                    $newUsername=$_POST["username"];
                    $newQuestion=$_POST["question"];
                    $newReponse=$_POST["reponse"];
                    if ($newNom==""||$newPrenom==""||$newUsername==""||$newQuestion==""||$newReponse=="")
                    {
                        Echo "Aucun champ n'est rempli.";
                    }
                    else
                    {
                        
                        $changeInfo="UPDATE account SET nom=:nom, prenom=:prenom ,username=:username, 
                    question=:question ,reponse=:reponse WHERE id_user=:id_user";
                        $changeInfo=$bdd->prepare($changeInfo);
                        $changeInfo->execute(array(":nom"=>$newNom,":prenom"=>$newPrenom,":username"=>$newUsername,":question"=>$newQuestion,":reponse"=>$newReponse,":id_user"=>$_SESSION["Id_visiteur"]));
                        
                        $_SESSION["success"] = "Vos informations personnelles ont bien été modifiées avec succès !";

                        echo "Vos informations personnelles ont bien été mis à jours. Vous allez être redirigé vers la page de connexion";
                        header("refresh:2;connexion.php");
                    }
                }
                else
                {
                    
                }
            ?>
            <h1>Pour modifier vos informations personnelles :</h1>
             <form method="POST" action="" id="form">
            <p><label for="nom"> Nom de famille </label><input type="text" name="nom" id="nom" required="required"/></p>
            <p><label for="prenom"> Prénom </label><input type="text" name="prenom" id="prenom" required="required"/></p>
            <p><label for="username"> Nom d'utilisateur (pseudo) </label><input type="text" name="username" id="username" required="required"/></p>
            <p><label for="question"> Question secrète </label><input type="text" name="question" id="question" required="required"/></p>
            <p><label for="reponse"> Reponse </label><input type="text" name="reponse" id="reponse" required="required" required="required"/></p>
            <p><input type="submit" name="resetinfo" value="Valider" onclick="cacherFormulaire()"/></p>
            </form>
            <?php

        }
        else
        {
            header("location=connexion.php");
        }
        ?>
       <!-- <input type="button" onclick="location.href='https://google.com';" value="Go to Google" />
        <button><a href="blabla.html">Texte du bouton</a></button>-->
        </section>
         <footer>
        <?php include('footer.php')?>
        </footer>
    </body>
    </html>