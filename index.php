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
        //session_start();
        include("connexionbdd.php");
        if(isset($_SESSION['Nom_visiteur']) && isset($_SESSION["prenom_visiteur"])){?>
       
            <div class="illustration"><h1>
                <p><b>Le Groupement Banque Assurance Français (GBAF) </b>est une fédération
                représentant les 6 grands groupes français :</p>
                <ul>
                    <li>BNP Paribas</li>
                    <li>BPCE</li>
                    <li>Crédit Agricole</li>
                    <li>Crédit Mutuel-CIC</li>
                    <li>Société Générale</li>
                    <li>La Banque Postale </li>
                </ul>
                <p>Le <b>GBAF</b> est le représentant de la profession bancaire et des assureurs sur tous
                les axes de la réglementation financière française. Sa mission est de promouvoir
                l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des
                pouvoirs publics.</p>
            </div></h1></section>
            <section>
                <?php

        
            echo "<h2>"."Acteurs et partenaires"."</h2>";

            $acteur=$bdd->prepare('SELECT * FROM acteur ORDER BY id_acteur');
            $acteur->execute();
            // Compter le nombre de commentaires
           

            
            while ($donnees=$acteur->FETCH())
            {            
               
                 ?>
                <div class="acteur">
                    <?php
                    $post=$bdd->prepare('SELECT*FROM post WHERE id_acteur=:id_acteur');
                    $post->execute(array(":id_acteur"=>$donnees["id_acteur"]));
                    $post->FETCH();
                    $count=$post->rowcount();
                    $vote=$bdd->prepare('SELECT * FROM vote WHERE id_acteur=:id_acteur AND vote=:vote');
                    $vote->execute(array(":id_acteur"=>$donnees["id_acteur"],":vote"=>"1"));
                    $countLike=$vote->rowcount();
                    $vote->execute(array(":id_acteur"=>$donnees["id_acteur"],":vote"=>"0"));
                    $countDislike=$vote->rowCOUNT();
                    ?>
                        <div class="logoActeur"><?php
                        echo "<br>"."<img src=\"".$donnees['logo'].".png\" alt=\" \">";
                        ?></div>
                        <div class="descriptionActeur"><?php
                        $description=explode(".", $donnees['description']);
                        $description=$description[0];
                
                        echo "<br>". "<h3><a href=\"acteur.php?acteur=".$donnees['id_acteur']."\">".$donnees['acteur']."</a>"."<br>".$description."..."."<a href=\"acteur.php?acteur=".$donnees['id_acteur']."\" class=\"bouton\">"."Lire la suite <img src=\"image/flecheblanchedroite.png\" alt=\"\"/>"."</a>"."</h3>";
                    ?>
                        </div>
                        <div class="post"><?php
                    echo $count."  " ."commentaires"."  ".$countLike." "."<img src=\"image/like.png\"/>"."  ".$countDislike." "."<img src=\"image/dislike.png\"/>"."<br>";
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
        </div>
        </section>
        <footer>
        <?php include('footer.php')?>
        </footer>
    </body>
</html>