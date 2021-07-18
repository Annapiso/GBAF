<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf_8"/>
        <link rel="stylesheet" href="style.css" />
        <title>GBAF</title>
    </head>
    <body>
        <div id="bloc_page">
        
            <header>
                <?php include("header.php")?>               
            </header>
            <section>
                <?php
                    include("connexionbdd.php");// connexion à la bade de données
                    if(isset($_SESSION['Nom_visiteur']) && isset($_SESSION["prenom_visiteur"])){// si l'utilisateur est déjà connecté
                        try
                            {
                            $acteur=(int)$_GET["acteur"]; //si le numéro de l'acteur est un entier 
                            if ($acteur!="")
                            {  
                                //Affichage des infos sur l'acteur.
                                $post=$bdd->prepare("SELECT * FROM acteur WHERE id_acteur=:id_acteur");
                                $post->execute(array(":id_acteur"=>$acteur));
                                $commentaire=$post->fetch();
                ?>
                                <div class="acteur"><h2>
                                <div class="logo">
                                <?php
                                    echo "<img src=\"".$commentaire['logo'].".png\" alt=\" \">"."</div>";
                                    echo "<br>"."<div class=\"description\">".$commentaire['description']."<br>"."</div>";
                                ?>

                                <div class="retour"><p><a href="index.php">Retour à la liste des acteurs</a></p></div>
                                </h2></div>
            </section>
            <section><div class="commentaire"><?php                              
                                // 1) RECUPERER VOTE ET COMMENTAIRES
                                //Récupérer le vote de l'utilisateur 
                                if(isset($_POST['boutonVote'])) //si l'utilisateur vote
                                {
                                    $choix=$_POST["vote"];
                                    $choixVote=$bdd->PREPARE("SELECT * FROM vote WHERE id_acteur=:id_acteur AND id_user=:id_user");
                                    $choixVote->EXECUTE(array(":id_acteur"=>$acteur,":id_user"=>$_SESSION["Id_visiteur"]));
                                    $countVote=$choixVote->rowcount();
                                    if($countVote==0)// si l'utilisateur n'a jamais voté pour cet acteur
                                    {
                                        $leaveVote=$bdd->PREPARE("INSERT INTO vote(id_user, id_acteur,vote)VALUES(:id_user,:id_acteur,:vote)"); // on enregistre le vote
                                        $leaveVote->EXECUTE(array(":id_user"=>$_SESSION["Id_visiteur"],":id_acteur"=>$acteur,":vote"=>$choix));
                                        
                                        echo '<div class="alert alert-success">'."Votre vote a bien été enregistré."."<br>"."</div>";
                                        

                                    }
                                    else //l'utilisateur a déjà voté
                                    {
                                        $leaveVote="UPDATE vote SET vote=:newVote WHERE id_acteur=:id_acteur AND id_user=:id_user"; //update vote
                                        $leaveVote=$bdd->prepare($leaveVote);
                                        $leaveVote->execute(array(":newVote"=>$choix,":id_acteur"=>$acteur,":id_user"=>$_SESSION["Id_visiteur"]));
                        
                                        echo '<div class="alert alert-success">'."Votre vote a été modifié."."</div>";                       
                        
                                    }
                                }
                                else// le bouton vote n'est pas appyué
                                {
                                }
                                //Récupérer le commentaire de l'utilisateur 
                                if(isset($_POST['boutonPost'])) //on appuye le bouton commentaire
                                {
                                    $verifPost=$bdd->prepare("SELECT * FROM post WHERE id_acteur =:id_acteur AND id_user=:id_user" );
                                    $verifPost->execute(array(":id_acteur"=>$acteur, ":id_user"=>$_SESSION["Id_visiteur"]));
                                    $countPost=$verifPost->rowcount();
                                    if ($countPost==0)// l'utilisateur n'a jamais laissé de commentaire pour cet acteur
                                    {
                                        $leavePost=$bdd->prepare("INSERT INTO post(id_user,id_acteur,post)VALUES(:id_user,:id_acteur,:post)");
                                        $leavePost->execute(array(":id_user"=>$_SESSION["Id_visiteur"],":id_acteur"=>$acteur,":post"=>$_POST["commentaire"]));
                                        echo '<div class="alert alert-success">'."\"".htmlspecialchars($_POST["commentaire"])."\"". "."." "."Votre commentaire a bien été enregistré."."<br>"."</div>";
                                    }
                                    else //l'utilisateur a déjà laissé un commentaire
                                    {
                                        echo "<div class=\"alert alert-failure\">"."Vous avez déjà laissé un commentaire pour cet acteur."."</div>";
                                    }
                            }
                            else// $_GET["acteur"] n'existe pas
                            {

                            }
                    
                    
                    //2) COMPTER NOMBRE DE COMMENTAIRES ET VOTE
                    COMMENTAIRE:
                    $req=$bdd->prepare("SELECT * FROM post WHERE id_acteur=:id_acteur");
                    $req->execute(array(":id_acteur"=>$acteur));
                    $count=$req->rowCount();

                    VOTE:
                    $vote=$bdd->prepare('SELECT * FROM vote WHERE id_acteur=:id_acteur AND vote=:vote');
                    $vote->execute(array(":id_acteur"=>$acteur,":vote"=>"1"));
                    $countLike=$vote->rowcount();
                    $vote->execute(array(":id_acteur"=>$acteur,":vote"=>"0"));
                    $countDislike=$vote->rowCOUNT();
                    
                ?>             
                                       
                    <div class="postActeur">
                        <?php
                        //afficher le nombre de commentaires et de votes.
                        echo "<div class=\"comsActeur\">".$count." " ."commentaires"."</div>".
                        "<div><form method=\"POST\" action=\"\"><input type=\"submit\" name=\"btcommentaire\" value=\"Laisser un commentaire\"/></form></div>"."<div class=\"likeActeur\">".$countLike."<img src=\"image/like.png\"/>"." ".$countDislike."<img src=\"image/dislike.png\"/>"."<br>"."</div>";
                        ?>
                             
                    </div>
                    <?php
                     if(isset($_POST['btcommentaire'])) //afficher le formulaire pour laisser un commentaire
                    {
                    $display = "block";
                    }
                    else
                    {
                    $display = "none";
                  
                    }

                    //3) AFFICHER LES COMMENTAIRES
                    // afficher les commentaires
                    echo "<h1>Commentaires sur l'acteur :</h1>"."<br>";
                    if ($count==0)//s'il n'y a pas de commentaire
                        {
                        echo "<br><em>Aucun commentaire à afficher.</em></p>";
                        }
                    else //Afficher les commentaires
                    {

                       
                        While($donnees=$req->fetch())
                        {
                             // Récupérer le prénom de celui qui a laissé laissé le commentaire
                            $id=$donnees["id_user"];
                            $user=$bdd->prepare("SELECT * FROM account WHERE id_user=:id_user");
                            $user->execute(array(":id_user"=>$id));
                            $prenom=$user->FETCH(PDO::FETCH_ASSOC);
                            ?><div class="commentaire_user">
                            <?php
                            echo "<div class=\"user\">"."<em>".$prenom['prenom']."<br>".$donnees["date_add"]."</em>"."</div>"."<div class=\"com\">".$donnees["post"]."<br>"."</div>"."</div>";
                        }
                        $req->closeCursor();
                    }
                   

                    //4) FORMULAIRE
                    //Pour laisser un commentaire?>

                <div id="vote" style="display:<?php echo $display ?>">
                <h1><p>Pour laisser un commentaire: </p>
                <form method="POST"> 
                <textarea class="textarea" name="commentaire" id="commentaire" rows=" " cols=""></textarea>
                <p><input type="submit" name="boutonPost" value="Envoyer"/></p>

                </form>
                </h1>
                </div>
            
              
                <!--Pour voter-->          
                <h1>Avez-vous aimé cet acteur?</h1>
                
                <div id="pouce">
                <form method="POST" action=""> 

                <p><label for="like"><img src="image/like.png"/></label><input type="radio" name="vote" value="1" id="1" checked="checked">
                <label for="dislike"><img src="image/dislike.png"/></label><input type="radio" name="vote" value="0" id="0"></p>
                <p><input type="submit" name="boutonVote" value="Envoyer"/></p>
                
                </form>
                </div>
                
                



            <?php
             }
            else // si l'utilisateur n'est pas conexté
            {
            echo "Une erreur s'est produite. Veuillez vous connecter à nouveau";
            header("location:connexion.php");
            }
           
            
            }
            catch (PDOException $e) {
            echo "Error : ".$e->getMessage();
            }


           

            
           
        }
        else
        {
            header("location=connexion.php");
        }
    ?>
        
        
                    </div>
                </div>
            </section>
            <footer>
                <?php include('footer.php')?>
            </footer>
        </div>
    </body>
</html>