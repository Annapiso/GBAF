<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf_8"/>
        <title>GBAF</title>
        <link href="style.css" rel="stylesheet"  />
        
    </head>
    <body>

        <header>
            <?php include("header.php")?>
        </header>

       <section>

         <p>  <b>Bienvenue</b> sur notre page et merci de votre visite.</p>
            <!--Vérification des informations de connexion-->
            <?php
            //session_start();
            include("connexionbdd.php");
            if(isset($_SESSION['Nom_visiteur']) && isset($_SESSION["prenom_visiteur"])){// si on est déjà connecté
                header("location:index.php");
            }else{
                if(isset($_SESSION["success"])){
                    echo '<div class="alert alert-success">' . $_SESSION["success"] . '</div>';
                }else{
                   
                }
                if(isset($_POST['boutonconnexion'])){ //le bouton est appuyé
                        $pseudo=$_POST['pseudo'];
                        $motdepasse=$_POST['motdepasse'];
                        if ($pseudo!=" " && $motdepasse!=""){ //les infos ne sont pas vides
                        
                            
                            try {
                                $sql="SELECT * FROM account WHERE username=:username";
                                $sql=$bdd->prepare($sql);
                                $sql->execute(array(':username'=>$pseudo));
                                $row=$sql->FETCH(PDO::FETCH_ASSOC);
                                $password=$row['password'];
                                $verifPassword=password_verify($motdepasse,$password);
                                $count=$sql->rowcount();
                                
                                if ($verifPassword==TRUE && $count==1){ //Mot de passe correct et il existe une seule ligne
                                $_SESSION["Id_visiteur"]=$row["id_user"];
                                $_SESSION["Nom_visiteur"]=$row["nom"];
                                $_SESSION["prenom_visiteur"]=$row["prenom"];
                                echo '<div class="alert alert-success">'. "Vous allez être redirigé vers la page que vous avez demandé."."</div>";
                                header("refresh:2; index.php");
                                }else{                                
                                    echo '<div class="alert alert-failure">'.'Mot de passe incorrect.'."</div>";
                                }
                           	
                           
                            } catch (Exception $e){                           
                                                    
                            echo '<div class="alert alert-failure">'."Erreur de connexion. Veuillez indiquer des informations correctes."."</div>";
                            $e->getMessage();
                            }
                            	
                            
                        }
                        else //un des infos est vide
                        {
                        	echo 'Veuillez indiquer vos informations de connexion.';
                        }
                    }
                    else  //le bouton n'est pas appuyé.           
                	{
                		echo 'Veuillez indiquer vos informations de connexion!';
                   
               		 }
                }
           
           FORMULAIRE:
           ?>
           <form method="POST" id="form"> 
                <p><label for="pseudo"> Nom d'utilisateur </label><input type="text" name="pseudo" id="pseudo"  /></p>
                <p><label for="motdepasse"> Mot de passe </label><input type="password" name="motdepasse" id="motdepasse" /></p>
                <p><input type="submit" name="boutonconnexion" value="Connexion"/></p>       

                <p>Si vous n'avez pas encore de compte, veuillez vous inscrire en cliquant <a href="inscription.php">ici</a></p>
                <p>Mot de passe oublié? Cliquez <a href ="verifID.php">ici</a></p>
            </form>
        </section>
         <footer>
        <?php include('footer.php')?>
        </footer>
    </body>
</html>
