<!DOCTYPE HTML>
<HTML lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="style.css" />
        <title>GBAF</title>
    </head>
    <body>
                <header>
                    <?php include("header.php")?>           
                </header>
                <section>
                    <?php        
                        include("connexionbdd.php");//connexion à la bade de données
                        if(isset($_SESSION['Nom_visiteur']) && isset($_SESSION["prenom_visiteur"])){// si l'utilisateur est connecté
                    ?>      
                            <div class="illustration"> <!--présentation du gbaf-->
                                <h2>Le Groupement Banque Assurance Français (GBAF)</h2><h1>est une fédération
                                représentant les 6 grands groupes français : </h1>
                                <ul>
                                    <li>BNP Paribas</li>
                                    <li>BPCE</li>
                                    <li>Crédit Agricole</li>
                                    <li>Crédit Mutuel-CIC</li>
                                    <li>Société Générale</li>
                                    <li>La Banque Postale </li>
                                </ul>
                               <h1> Le <b>GBAF</b> est le représentant de la profession bancaire et des assureurs sur tous
                                les axes de la réglementation financière française. Sa mission est de promouvoir
                                l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des
                                pouvoirs publics.
                            </h1>
                        </div>
                    <?php        
                        echo "<h2>"."Acteurs et partenaires"."</h2>"; // présentation des acteurs
                        $acteur=$bdd->prepare('SELECT * FROM acteur ORDER BY id_acteur'); // récupération des acteurs dans la base
                        $acteur->execute();                        
                        // Compter le nombre de commentaires pour chaque acteur         
                        while ($donnees=$acteur->FETCH()) //pour chaque acteur
                        {           
                     ?>
                    <div class="acteur">
                        <?php
                        $post=$bdd->prepare('SELECT*FROM post WHERE id_acteur=:id_acteur'); //récupérer le commentaire
                        $post->execute(array(":id_acteur"=>$donnees["id_acteur"]));
                        $post->FETCH();
                        $count=$post->rowcount(); //compter le nombre de commentaire
                        // compter le nombre de like et dislike pour l'acteur
                        $vote=$bdd->prepare('SELECT * FROM vote WHERE id_acteur=:id_acteur AND vote=:vote');
                        $vote->execute(array(":id_acteur"=>$donnees["id_acteur"],":vote"=>"1"));
                        $countLike=$vote->rowcount();
                        $vote->execute(array(":id_acteur"=>$donnees["id_acteur"],":vote"=>"0"));
                        $countDislike=$vote->rowCOUNT();
                        ?>
                        <div class="logoActeur"><?php
                            echo "<br>"."<img src=\"".$donnees['logo'].".png\" alt=\" \">";// afficher logo acteur
                            ?>
                        </div>
                        <div class="descriptionActeur"><?php // description de l'acteur
                            $description=explode(".", $donnees['description']);
                            $description=$description[0];
                    
                            echo "<div>"."<br>"."<h3><a href=\"acteur.php?acteur=".$donnees['id_acteur']."\">".$donnees['acteur']."</a>"."<br>".$description."..."."</h3>"."</div>".
                            "<h3>"."<a href=\"acteur.php?acteur=".$donnees['id_acteur']."\" class=\"bouton\">"."Lire la suite <img src=\"image/flecheblanchedroite.png\" alt=\"\"/>"."</a>"."</h3>";
                        ?>
                        </div>
                        <div class="post"><?php // commentaire et vote de l'acteur
                        echo "<div>".$count."  " ."commentaires"."  "."</div>"."<div>".$countLike." "."<img src=\"image/like.png\" alt=\"\"/>"."  ".$countDislike." "."<img src=\"image/dislike.png\" alt=\"\"/>"."</div>"."<br>";
                        ?>
                        </div>
                    </div>
                    <?php
                    }                  
                    $acteur->closeCursor();
                    }
                    else
                    {
                    header("location:connexion.php");
                    }
                    ?>
                
                </section>
                <footer>
                    <?php include('footer.php')?>
                </footer> 
        </body>
                
</HTML>