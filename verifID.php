<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf_8"/>
        <title>Page de changement de mot de passe.</title>
        <link href="style.css" rel="stylesheet"  />
    </head>
    <body>
        <div id="bloc_page">
            <header>
            <?php include("header.php")?>
            </header>

            <section>
                <?php 
                include("connexionbdd.php"); //connexion à la base de données
                if(isset($_POST['resetmdp'])){// Si on a appuyer sur le bouton
                    $username=$_POST['username'];
                    $answer=$_POST['reponse'];
                    $newMdp=$_POST['nouveauMdp'];
                    $confirmMdp=$_POST['confirmMdp'];
                    if($username==""||$answer==""||$newMdp==""||$confirmMdp==""){ //Si un des champs est vide
                        echo "<div class=\"alert alert-failure\">". "*Tous les champs sont obligatoires."."</div>";
                    }
                    else{ //Si tous les champs sont renseignés
                        try{
                            $req="SELECT * FROM account WHERE username=:username";
                            $req=$bdd->prepare($req);
                            $req->execute(array(":username"=>$username));
                            $verifReponse=$req->FETCH(PDO::FETCH_ASSOC);                   
                            $count=$req->rowcount(); //Si l'utilisateur est dans la base
                            if ($count==1){
                                if($verifReponse['reponse']==$answer){ //Si la réponse à la question secrète est correcte                            
                                    if($newMdp==$confirmMdp){ //Si les deux mots de passe sont identiques
                                        echo "true new password";
                                        echo "<p>".htmlspecialchars($verifReponse['password']);
                                        $changeMdp="UPDATE account SET password=:newMdp WHERE username=:username";
                                        $changeMdp=$bdd->prepare($changeMdp);
                                        $changeMdp->execute(array(":newMdp"=>password_hash($newMdp, PASSWORD_DEFAULT),":username"=>$username));
                                        $_SESSION["success"] = "Votre mot de passe a bien été modifié avec succès.";
                                        header("location: connexion.php");
                                    }
                                     else{
                                        echo "<div class=\"alert alert-failure\">"."Les deux mots de passe sont différents."."</div>"; //Si les deux mdp sont différents
                                    } 
                                }else{
                                    echo "<div class=\"alert alert-failure\">"."La réponse à la question secrète est incorrecte."."</br>".
                                    "Veuillez répondre à la question :"." ".$verifReponse['question']."</div>";
                                }
                            }else{echo "<div class=\"alert alert-failure\">"."Un problème est survenu. Compte inexistant."."</div>"; //si l'utilisateur n'existe pas
                            }
                            
                        }
                        catch (Exception $e)  
                        {                        
                        echo "Un problème est survenu. Compte inexistant.";//.$e->getMessage();
                        }
                    }
                }
                else //si on n'appuye pas le bouton
                {
                    echo "<h1>"."Changement de mot de passe."."</h1>";
                }

                ?>
                     <form method="POST" action="" id="form">
                        <p><label for="username"> Nom d'utilisateur </label><input type="text" name="username" id="username" required="required"/></p>
                        <p><label for="reponse"> Reponse à la question secrète </label><input type="text" name="reponse" id="reponse" required="required"/></p>
                        <p><label for="nouveauMdp"> Votre nouveau mot de passe </label><input type="password" name="nouveauMdp" id="nouveauMdp"/></p>
                        <p><label for="confirmMdp"> Confirmation de votre nouveau mot de passe </label><input type="password" name="confirmMdp" id="confirmMdp" value="" /></p>
                        <p><input type="submit" name="resetmdp" value="Valider" onclick="cacherFormulaire()"/></p>
                      </form>
               
                
       
                </section>
                <footer>
                    <?php include('footer.php')?>
                </footer>
            </div>
        </body>
    </html>