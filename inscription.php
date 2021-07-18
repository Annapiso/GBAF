<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf_8"/>
        <title>Page d'inscription</title>
        <link href="style.css" rel="stylesheet"  />
        
    </head>
    <body>
    	<div id="bloc_page">

        	<header>
            	<?php include("header.php")?>
        	</header>

      		 <section>      
				<?php
				// on initilise les données
				$nom = $prenom = $username = $password = $question = $reponse = "";
				include("connexionbdd.php");
				if(isset($_POST['boutonInscription'])) {//si le bouton est appuyé 
			        $nom=$_POST['nom'];
			        $prenom=$_POST['prenom'];
			        $username=$_POST['username'];
			        $password = $_POST['motdepasse'];
			        $password_hash=password_hash($password,PASSWORD_DEFAULT);
			        $question=$_POST['question'];
			        $reponse=$_POST['reponse'];
		            if($nom ==""||$prenom==""||$username==""||$password==""||$question==""||$reponse=="") {//un champ est vide
		        		echo "<div class=\"alert alert-failure\">"."*Tous les champs sont obligatoires"."</div>";
		        		}
		        		else{// tous les champs sont remplis
		        			try{		        		
				        		$sql="SELECT * FROM account WHERE username=:username"; // on vérifie si le nom d'utilisateur est libre
				        		$sql=$bdd->prepare($sql);
				        		$sql->execute(array(':username'=>$username));
				        		$count=$sql->rowcount();
				        		if($count>0){ // si le nombre de ligne est positif
				        			echo "<div class=\"alert alert-failure\">"."Ce nom d'utilisateur existe déja."."</div>";
				        		}
				        		else{
				        			//Ecrire dans la BDD
									$req = $bdd->prepare('INSERT INTO account(nom, prenom, username, password,question,reponse) VALUES(?, ?,?,?,?,?)');
									$req->execute(array($nom,$prenom,$username,$password_hash,$question,$reponse));
									echo"<p>" .htmlspecialchars($nom). " ".htmlspecialchars($prenom)." "."(".htmlspecialchars($username).")"."</p>";
									echo '<div class="alert alert-success">'."Votre compte a été créé avec succès"."</div>";
									echo "<p><a href=\"connexion.php\">Page de connexion</a></p>";
									$_SESSION["success"] = "Votre compte a été créé avec succès !";
									header("location: connexion.php");
								}
        					}
        					catch (PDOException $e) {
            				echo "Error : ".$e->getMessage();
       						}

						}
				}
				else {//si le bouton n'est pas appuyé
			
				}

		?>
		 	<!--Formulaire d'inscriptions-->
       	<form method="POST" id="form"> 
          <p><label for="nom"> Nom  </label><input type="text" name="nom" id="nom"  /></p>
          <p><label for="prenom"> Prénom </label><input type="text" name="prenom" id="prenom"  /></p>
          <p><label for="username"> Nom d'utilisateur </label><input type="text" name="username" id="username" value=" " /></p>
          <p><label for="motdepasse"> Mot de passe </label><input type="password" name="motdepasse" id="motdepasse"/></p>
          <p><label for="question"> Question secrète </label><input type="text" name="question" id="question"  /></p>
          <p><label for="reponse"> Réponse à la question secrète </label><input type="text" name="reponse" id="reponse"  /></p>
          <p><input type="submit" name="boutonInscription" value="Inscription"/></p>
         </form>
         
     </section>
      <footer>
        <?php include('footer.php')?>
        </footer>
    	</div>
 	</body>
 </html>


        