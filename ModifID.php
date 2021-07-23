<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf_8"/>
        <title>Page de changement de mot de passe.</title>
        <link href="style.css" rel="stylesheet"  />
               
    </head>
    <body>
         <header>
            <div id="logoCentre">
                <?php include("header.php")// en-tête
                ?>
                </div>
        </header>

       <section>
        <?php 
        include("connexionbdd.php");
        if(isset($_SESSION['Nom_visiteur']) && isset($_SESSION["prenom_visiteur"])){ // si l'utilisateur est déjà connecté  
            if(isset($_POST['resetinfo'])){ // si le bouton est appuyé
                $newUsername=$_POST["username"];
                $newQuestion=$_POST["question"];
                $newReponse=$_POST["reponse"];                   
                if ($newUsername==""&& $newQuestion==""&&$newReponse=="") //si  tous les champs sont vides
                    {
                    Echo "<div class=\"alert alert-failure\">"."Renseignez au moins un champ"."</div>";
                    }
                else{
                    if($newUsername!="") // si Username n'est pas vide
                        {   
                            $verifID="SELECT * FROM account where username=:username";
                            $verifID=$bdd->prepare($verifID);
                            $verifID->execute(array(":username"=>$newUsername));
                            $count=$verifID->rowcount();
                            if ($count>0)
                                {
                                    echo "<div class=\"alert alert-failure\">"."Ce nom d'utilisateur existe déja."."</div>";
                                    return false;
                                }
                            else                        
                                {
                                $changeUsername="UPDATE account SET username=:username WHERE id_user=:id_user";//on modifie les infos
                                $changeUsername=$bdd->prepare($changeUsername);
                                $changeUsername->execute(array(":username"=>$newUsername,":id_user"=>$_SESSION["Id_visiteur"]));

                                }
                            }
                    else //si username est vide
                    {}
                    if($newQuestion!="") //Si la question n'est pas vide
                        {
                            $changeQuestion="UPDATE account SET question=:question WHERE id_user=:id_user";//on modifie les infos
                            $changeQuestion=$bdd->prepare($changeQuestion);
                            $changeQuestion->execute(array(":question"=>$newQuestion,":id_user"=>$_SESSION["Id_visiteur"]));
                        }
                    else //si la question est vide
                    {}
                    if($newReponse!="")
                        {
                            $changeReponse="UPDATE account SET reponse=:reponse WHERE id_user=:id_user";//on modifie les infos
                            $changeReponse=$bdd->prepare($changeReponse);
                            $changeReponse->execute(array(":reponse"=>$newReponse,":id_user"=>$_SESSION["Id_visiteur"]));                                   
                        }
                    else
                    {}
                    $_SESSION["success"] = "Vos informations personnelles ont bien été modifiées avec succès !";
                        echo '<div class="alert alert-success">'.$_SESSION["success"]."<br>"."</div>";
                }
            }
            else// le bouton n'est pas appuyé
                {
                    
                }
            ?>
            <h1>Pour modifier vos informations personnelles :</h1>
             <form method="POST" action=" " id="form">
            <!--<p><label for="nom"> Nom de famille </label><input type="text" name="nom" id="nom" required="required"/></p>
            <p><label for="prenom"> Prénom </label><input type="text" name="prenom" id="prenom" required="required"/></p>-->
            <p><label for="username"> Nom d'utilisateur (pseudo) </label><input type="text" name="username" id="username"/></p>
            <p><label for="question"> Question secrète </label><input type="text" name="question" id="question" /></p>
            <p><label for="reponse"> Reponse </label><input type="text" name="reponse" id="reponse"/></p>
            <p><input type="submit" name="resetinfo" value="Valider" onclick="cacherFormulaire()"/></p>
            </form>
            <?php
        }
        else// l'utilisateur n'est pas connecté
        {
            header("location=connexion.php");
        }

        ?>

            </section>
            <footer>
                <?php include('footer.php')?>
            </footer>
    </body>
</html>