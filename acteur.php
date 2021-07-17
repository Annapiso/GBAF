<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf_8"/>
        <link rel="stylesheet" href="style.css" />
        <title>GBAF</title>
    </head>
    <body>
        
        <header>
            <?php include("header.php")?>
             
            
        </header>
        <section>

        <?php
       // session_start();
        include("connexionbdd.php");
        if(isset($_SESSION['Nom_visiteur']) && isset($_SESSION["prenom_visiteur"]))
        {
            
            try
            {
            $acteur=(int)$_GET["acteur"];
            if ($acteur!="")
                {  

                //Affichage des infos sur l'acteur.
                $post=$bdd->prepare("SELECT * FROM acteur WHERE id_acteur=:id_acteur");
                $post->execute(array(":id_acteur"=>$acteur));
                $commentaire=$post->fetch();
                ?><div class="acteur"><h2>
                    <div class="logo"><?php
                    echo "<img src=\"".$commentaire['logo'].".png\" alt=\" \">"."</div>";
               // echo "<br>". "<h3>".$commentaire['acteur']."</h3>"."<br>". $commentaire['description']."<br>";
                    echo "<br>"."<div class=\"description\">".$commentaire['description']."<br>"."</div>";


                ?>

                <div class="retour"><p><a href="index.php">Retour à la liste des acteurs</a></p></div>
            </h2></div>
                </section>
                <section><div class="commentaire"><?php                              
                                                 
                    //Récupérer le vote de l'utilisateur 
                    if(isset($_POST['boutonVote']))
                    {
                        $choix=$_POST["vote"];
                        $choixVote=$bdd->PREPARE("SELECT * FROM vote WHERE id_acteur=:id_acteur AND id_user=:id_user");
                        $choixVote->EXECUTE(array(":id_acteur"=>$acteur,":id_user"=>$_SESSION["Id_visiteur"]));
                        $countVote=$choixVote->rowcount();
                        if($countVote==0)
                        {
                        $leaveVote=$bdd->PREPARE("INSERT INTO vote(id_user, id_acteur,vote)VALUES(:id_user,:id_acteur,:vote)");
                        $leaveVote->EXECUTE(array(":id_user"=>$_SESSION["Id_visiteur"],":id_acteur"=>$acteur,":vote"=>$choix));
                        
                        echo '<div class="alert alert-success">'."Votre vote a bien été enregistré."."<br>"."</div>";
                        //echo "<meta http-equiv='refresh' content='0'>";

                        }
                        else
                        {
                        $leaveVote="UPDATE vote SET vote=:newVote WHERE id_acteur=:id_acteur AND id_user=:id_user";
                        $leaveVote=$bdd->prepare($leaveVote);
                        $leaveVote->execute(array(":newVote"=>$choix,":id_acteur"=>$acteur,":id_user"=>$_SESSION["Id_visiteur"]));
                        
                        echo '<div class="alert alert-success">'."Votre vote a été modifié."."</div>";
                        //echo "<meta http-equiv='refresh' content='0'>";
                        
                        }
                    }
                    else
                    {
                    }
                    //Récupérer le commentaire de l'utilisateur 
                    if(isset($_POST['boutonPost']))
                    {
                        $verifPost=$bdd->prepare("SELECT * FROM post WHERE id_acteur =:id_acteur AND id_user=:id_user" );
                        $verifPost->execute(array(":id_acteur"=>$acteur, ":id_user"=>$_SESSION["Id_visiteur"]));
                        $countPost=$verifPost->rowcount();
                        if ($countPost==0)
                        {
                       $leavePost=$bdd->prepare("INSERT INTO post(id_user,id_acteur,post)VALUES(:id_user,:id_acteur,:post)");
                       $leavePost->execute(array(":id_user"=>$_SESSION["Id_visiteur"],":id_acteur"=>$acteur,":post"=>$_POST["commentaire"]));
                       echo '<div class="alert alert-success">'."\"".htmlspecialchars($_POST["commentaire"])."\"". "."." "."Votre commentaire a bien été enregistré."."<br>"."</div>";
                        }
                        else
                        {
                        echo "Vous avez déjà laissé un commentaire pour cet acteur.";
                        }
                    }
                    else
                    {

                    }
                    
                    
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
                    
                    
                    
                    <div class="postActeur"><?php
                        //afficher le nombre de commentaires et de votes.
                        echo "<div class=\"comsActeur\">".$count." " ."commentaires"."</div>".
                        "<div><form method=\"POST\" action=\"\"><input type=\"submit\" name=\"btcommentaire\" value=\"Laisser un commentaire\"/></form></div>"."<div class=\"likeActeur\">".$countLike."<img src=\"image/like.png\"/>"." ".$countDislike."<img src=\"image/dislike.png\"/>"."<br>"."</div>";
                             ?>
                             
                    </div><?php
                     if(isset($_POST['btcommentaire']))// AND empty($_POST['boutonVote']))
                    {
                    $display = "block";
                    }
                    else
                    {
                    $display = "none";
                  
                    }


                 
                                 

                    //Afficher les commentaires
                    
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
                            echo "<br>"."<em>".$prenom['prenom']."<br>".$donnees["date_add"]."</em>".$donnees["post"]."<br>";
                        }
                        $req->closeCursor();
                    }
                   
                    //Pour laisser un commentaire?>
                   

                <div id="vote" style="display:<?php echo $display ?>">
                <h1>Pour laisser un commentaire :</h1>
                <form method="POST"> 
                <label for="commentaire"> Votre commentaire </label><br/>
                <textarea class="textarea" name="commentaire" id="commentaire" rows=" " cols=""></textarea>
                <p><input type="submit" name="boutonPost" value="Envoyer"/></p>

                </form>
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
            else // si l'acteur n'existe pas
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
    </body>
    </html>