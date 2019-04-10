<?php


require('Script/FonctionBdd.php');

if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}

$hote="localhost";// le chemin vers le serveur
$bd="NSBBDD";// le nom de la base de données 
$util="root";// nom d'utilisateur pour se connecter
$mpas="";// mot de passe de l'utilisateur pour se connecter
$connexion = connexionMysqlBdd($hote,$bd, $util, $mpas);



if (isset($_POST['Valider']) &&  !empty($_POST["Aide"]) && $_POST["Aide"] == "oui" && !isset($_SESSION['membre_id'])) 
{
	var_dump(header('Location:index.php?page=seconnecter'));
}

?>

<div class="contact">
	<form method="post">
		
		<?php
		//1ère question: Aide à la creation d'entreprise
		if (!isset($_POST['Valider']) && !isset($_POST['formeJuridique']))
		{

			if (isset($_SESSION))
			{
				
				if (isset($_SESSION['membre_id']))
				{
					$user = $_SESSION['membre_id'];
				}

				$_SESSION = array();

				if (isset($user))
				{
					$_SESSION['membre_id'] = $user;
				}
			}

			?>
			<h2 class='text-center'>Souhaitez vous être aidé dans le processus de création de votre entreprise ?</h2>       
			<input type='radio' name='Aide' value='oui'> Oui, je souhaite faire appel à vos services pour créer ma société.<br>
			<input type='radio' name='Aide' value='non'> Non, je créerai seul ma sociéte.<br>
			<button class='btn btn-primary' type='submit' name='Valider'>Valider</button><br><br>

			<?php

		}
		//2ème question: Choix de la date de creation de l'entreprise si le client souhaite être aidé + recuperation de la 1ère réponse
		if (isset($_POST['Valider']) &&  !empty($_POST["Aide"]) && $_POST["Aide"] == "oui" && isset($_SESSION['membre_id'])) 
		{
			$_SESSION["Aide"] = $_POST["Aide"];
			

			?>

			<h2 style="text-align: center;">Quel forme juridique ?</h2>
			<div class="btn-group" style="display: grid ;">
				<button class="btn btn-primary" type="submit" name="formeJuridique" value="SARL">SARL</button><br>
				<button class="btn btn-primary" type="submit" name="formeJuridique" value="EURL">EURL</button>
				<button class="btn btn-primary" type="submit" name="formeJuridique" value="SAS">SAS</button>
				<button class="btn btn-primary" type="submit" name="formeJuridique" value="SASU">SASU</button>
				<button class="btn btn-primary" type="submit" name="formeJuridique" value="SA">SA</button>
				<button class="btn btn-primary" type="submit" name="formeJuridique" value="SCI">SCI</button>
				<button class="btn btn-primary" type="submit" name="formeJuridique" value="EARL">EARL</button>
				<button class="btn btn-primary" type="submit" name="formeJuridique" value="Auto-entrepreneur">Auto-entrepreneur</button>
			</div>
			<?php
		}

		if (isset($_POST['formeJuridique']) ) 
		{	
			$_SESSION['formeJuridique'] = $_POST['formeJuridique'];

			?>

			<h2 class="text-center">Quand souhaitez vous créer votre entreprise ?</h2>       
			<input type="radio" name="dateCreation" value="Aujourdhui"> Aujourd'hui.<br>
			<input type="radio" name="dateCreation" value="Dans la semaine"> Dans la semaine.<br>
			<input type="radio" name="dateCreation" value="Dans le mois"> Dans le mois.<br>
			<input type="radio" name="dateCreation" value="Dans l'année"> Dans l'année.<br>
			<button class="btn btn-primary" type="submit"  name="Valider">Valider</button><br><br>

			<?php

		}

		//2ème question: Redirection vers les formulaires si le client ne souhaite pas être aidé + recuperation de la 1ère réponse

		if (isset($_POST['Valider']) &&  !empty($_POST["Aide"]) && $_POST["Aide"] == "non") 
		{
			$_SESSION["Aide"] = $_POST["Aide"];
			echo'<a href="index.php?page=formulairesGratuits" target="blank">FORMULAIRES GRATUITS</a>'; 
		}

		//3ème question: Questionnare d'identité + recuperation de la 2ème réponse
		if (isset($_POST['Valider']) && !empty($_POST["dateCreation"])) {
			$_SESSION["dateCreation"] = $_POST["dateCreation"];
			if (isset($_SESSION['nbassocie']))
			{
				unset($_SESSION["nbassocie"]);
			}
			?>
			<h2 class="text-center">Qui êtes vous ?</h2>    
			<div class="form-liste">
				<h3 style="text-align: center;">Civilité</h3>
				<select name="SexeAssocie" size="1" >
					<option>Monsieur</option>
					<option>Madame</option>
				</select>
			</div>
			<h4>Nom*</h4>
			<input type="text" name="NomAssocieClient">
			<h4>Nom de naissance (si différent)</h4>
			<input type="text" name="NomNaissanceAssocie">
			<h4>Lieu de naissance*</h4>
			<input type="text" name="LieuNaissanceAssocie">
			<h4>Prenom*</h4>
			<input type="text" name="PrenomAssocie">
			<h3 style="text-align: center;">Adresse</h3>
			<h4>Numéro et voie*</h4>
			<input type="text" name="NumeroEtVoieAssocie">
			<h4>Code Postal*</h4>
			<input type="text" name="CodePostalAssocie">
			<h4>Ville*</h4>
			<input type="text" name="VilleAssocie">
			<select name="PaysAssocie" size="1" >
				<option>Pays</option>
				<?php 
				$listePays = listePays($connexion);
				for($i=0;$i<count($listePays);$i++)
				{
					$pays = recupUnPays($listePays,$i);

				}
				?>
			</select><br>
			<h4>Date de naissance*</h4>
			<input type="date" name="DateNaissanceAssocie"><br>
			<h4>Nationalité*</h4>
			<input type="text" name="NationaliteAssocie">
			<h4>Téléphone*</h4>
			<input type="text" name="TelephoneAssocie">
			<h4>Email*</h4>
			<input type="email" name="EmailAssocie">
			<h4> Fonds injecté dans la société (en euros)*</h4>
			<input type="text" name="SommeAssocie"><br><br>
			<h3 class="text-center">Êtes vous gérant de la société ?</h3>       
			<input type="radio" name="associeGerant" value="oui"> Oui<br>
			<input type="radio" name="associeGerant" value="non"> Non<br>
			<h2 class="text-center">De combien d'associés disposera la société ?</h2>       
			<input type="radio" name="nombreAssocie" value="un"> Aucun, je crée seul ma sociéte.<br>
			<input type="radio" name="nombreAssocie" value="plusieurs"> Je crée ma société avec un ou plusieurs associés.<br>
			<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
			<?php
			echo "* Champs obligatoires";
		}

		//4ème question: Questionnaire d'identité associé si le client à un associé + recuperation des infos de la fiche d'identité + insertion dans la base des infos de la fiche identité et de la date de creation de l'entreprise
		if (isset($_POST['Valider']) && !empty($_POST["SexeAssocie"]) && !empty($_POST["NomAssocieClient"]) && !empty($_POST["LieuNaissanceAssocie"]) && !empty($_POST["PrenomAssocie"]) && !empty($_POST["NumeroEtVoieAssocie"]) && !empty($_POST["CodePostalAssocie"]) && !empty($_POST["VilleAssocie"]) && !empty($_POST["NationaliteAssocie"]) && !empty($_POST["TelephoneAssocie"]) && !empty($_POST["EmailAssocie"]) && !empty($_POST["SommeAssocie"])&& !empty($_POST["nombreAssocie"]) && ($_POST["nombreAssocie"] == 'plusieurs') && !empty($_POST["associeGerant"]) && !empty($_POST["PaysAssocie"]) && ($_POST["PaysAssocie"] != 'PaysAssocie')  && !empty($_POST["DateNaissanceAssocie"]))
		{
			$_SESSION["SexeAssocie"]=$_POST["SexeAssocie"];
			$_SESSION["NomAssocieClient"]=$_POST["NomAssocieClient"];
			$_SESSION["PrenomAssocie"]=$_POST["PrenomAssocie"];
			$_SESSION["NomNaissanceAssocie"]=$_POST["NomNaissanceAssocie"];
			$_SESSION["LieuNaissanceAssocie"]=$_POST["LieuNaissanceAssocie"];	
			$_SESSION["NumeroEtVoieAssocie"]=$_POST["NumeroEtVoieAssocie"];
			$_SESSION["CodePostalAssocie"]=$_POST["CodePostalAssocie"];
			$_SESSION["VilleAssocie"]=$_POST["VilleAssocie"];
			$_SESSION["PaysAssocie"]=$_POST["PaysAssocie"];
			$_SESSION["NationaliteAssocie"]=$_POST["NationaliteAssocie"];
			$_SESSION["TelephoneAssocie"]=$_POST["TelephoneAssocie"];
			$_SESSION["EmailAssocie"]=$_POST["EmailAssocie"];
			$_SESSION["DateNaissanceAssocie"] = date('Y-m-d', strtotime(str_replace('/','-',$_POST["DateNaissanceAssocie"])));
			$_SESSION["associeGerant"] = $_POST["associeGerant"];
			$_SESSION["SommeAssocie"] = $_POST["SommeAssocie"];
			$_SESSION["nbassocie"] = 1 ;

			?>
			<h2 class="text-center">Qui est votre associé n°<?php echo $_SESSION["nbassocie"]; ?> ?</h2> <?php
			if ($_SESSION["associeGerant"] == "non") 
			{ 
				echo "Ajoutez maintenant l'associé gérant<br><br>";
			}
			?>
			<div class="form-liste">
				<h3>Civilité</h3>
				<select name="SexeAssocie" size="1" >
					<option>Monsieur</option>
					<option>Madame</option>
				</select>
				<h4>Nom*</h4>
				<input type="text" name="NomAssocie">
				<h4>Nom de naissance (si différent)</h4>
				<input type="text" name="NomNaissanceAssocie">
				<h4>Lieu de naissance*</h4>
				<input type="text" name="LieuNaissanceAssocie">
				<h4>Prenom*</h4>
				<input type="text" name="PrenomAssocie"><br><br>
				<h3 style="text-align: center;">Adresse de l'associé*</h3>
				<h4>Numéro et voie*</h4>
				<input type="text" name="NumeroEtVoieAssocie">
				<h4>Code Postal*</h4>
				<input type="text" name="CodePostalAssocie">
				<h4>Ville*</h4>
				<input type="text" name="VilleAssocie">
				<select name="PaysAssocie" size="1" >
					<option value = "PaysAssocie">Pays</option>
					<?php 
					$listePays = listePays($connexion);
					for($i=0;$i<count($listePays);$i++)
					{
						$pays = recupUnPays($listePays,$i);

					}
					?>
				</select><br>
				<h4>Date de naissance*</h4>
				<input type="date" name="DateNaissanceAssocie"><br>
				<h4>Nationalité*</h4>
				<input type="text" name="NationaliteAssocie">
				<h4>Téléphone*</h4>
				<input type="text" name="TelephoneAssocie">
				<h4>Email*</h4>
				<input type="email" name="EmailAssocie">
				<h4> Fonds injecté dans la société (en euros)*</h4>
				<input type="text" name="SommeAssocie"><br><br>
				<?php
				if ($_SESSION["associeGerant"] == "non") 
				{ 
					?>
					<h3 class="text-center">L'associé est il gérant de la société ?</h3>       
					<input type="radio" name="associeGerant" value="oui"> Oui <br>
					<input type="radio" name="associeGerant" value="non"> Non <br>
					<?php
				}
				?>
				<h3 class="text-center">Souhaitez vous ajouter un autre associé ?</h3>       
				<input type="radio" name="AjouterAssocie" value="oui"> Oui<br>
				<input type="radio" name="AjouterAssocie" value="non"> Non</br><br>
				<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
			</div>
			<?php
			echo "* Champs obligatoires";
			
		}

		//5ème question: Questionnare d'identité associé si le client à un ou plusieur autre(s) associé a à ajouter + recuperation des infos de la fiche associé précédente + insertion dans la base des infos de la fiche associé précédente
		if ( isset($_POST['Valider']) && !empty($_POST["SexeAssocie"]) && !empty($_POST["NomAssocie"]) && !empty($_POST["PrenomAssocie"]) && !empty($_POST["LieuNaissanceAssocie"])&& !empty($_POST["NumeroEtVoieAssocie"]) && !empty($_POST["CodePostalAssocie"]) && !empty($_POST["VilleAssocie"]) && !empty($_POST["NationaliteAssocie"]) && !empty($_POST["PaysAssocie"]) && !empty($_POST["DateNaissanceAssocie"]) && !empty($_POST["EmailAssocie"]) && !empty($_POST["TelephoneAssocie"]) && !empty($_POST["SommeAssocie"]) && isset($_POST["AjouterAssocie"]) && ($_POST["AjouterAssocie"] == 'oui') && ($_POST["PaysAssocie"] != 'PaysAssocie'))
		{
			$_SESSION["SexeAssocie".$_SESSION["nbassocie"]]=$_POST["SexeAssocie"];
			$_SESSION["NomAssocie".$_SESSION["nbassocie"]]=$_POST["NomAssocie"];
			$_SESSION["PrenomAssocie".$_SESSION["nbassocie"]]=$_POST["PrenomAssocie"];
			$_SESSION["NomNaissanceAssocie".$_SESSION["nbassocie"]]=$_POST["NomNaissanceAssocie"];
			$_SESSION["LieuNaissanceAssocie".$_SESSION["nbassocie"]]=$_POST["LieuNaissanceAssocie"];	
			$_SESSION["NumeroEtVoieAssocie".$_SESSION["nbassocie"]]=$_POST["NumeroEtVoieAssocie"];
			$_SESSION["CodePostalAssocie".$_SESSION["nbassocie"]]=$_POST["CodePostalAssocie"];
			$_SESSION["VilleAssocie".$_SESSION["nbassocie"]]=$_POST["VilleAssocie"];
			$_SESSION["PaysAssocie".$_SESSION["nbassocie"]]=$_POST["PaysAssocie"];
			$_SESSION["NationaliteAssocie".$_SESSION["nbassocie"]]=$_POST["NationaliteAssocie"];
			$_SESSION["TelephoneAssocie".$_SESSION["nbassocie"]]=$_POST["TelephoneAssocie"];
			$_SESSION["EmailAssocie".$_SESSION["nbassocie"]]=$_POST["EmailAssocie"];
			$_SESSION["DateNaissanceAssocie".$_SESSION["nbassocie"]] = date('Y-m-d', strtotime(str_replace('/','-',$_POST["DateNaissanceAssocie"])));

			if (isset($_POST["associeGerant"])) 
			{
				$_SESSION["associeGerant".$_SESSION["nbassocie"]] = $_POST["associeGerant"];
			}
			else
			{
				$_SESSION["associeGerant".$_SESSION["nbassocie"]] = "non";
			}
			$_SESSION["SommeAssocie".$_SESSION["nbassocie"]] = $_POST["SommeAssocie"];
			$_SESSION["AjouterAssocie"] = $_POST["AjouterAssocie"];

			
			?>
			<h2 class="text-center">Qui est votre associé n°<?php echo $_SESSION["nbassocie"]+1; ?> ?</h2>    
			<div class="form-liste">
				<h3>Civilité</h3>
				<select name="SexeAssocie" size="1" >
					<option>Monsieur</option>
					<option>Madame</option>
				</select>
				<h4>Nom*</h4>
				<input type="text" name="NomAssocie">
				<h4>Nom de naissance (si différent)</h4>
				<input type="text" name="NomNaissanceAssocie">
				<h4>Lieu de naissance*</h4>
				<input type="text" name="LieuNaissanceAssocie">			
				<h4>Prenom*</h4>
				<input type="text" name="PrenomAssocie"><br><br>
				<h3 style="text-align: center;">Adresse de l'associé*</h3>
				<h4>Numéro et voie*</h4>
				<input type="text" name="NumeroEtVoieAssocie">
				<h4>Code Postal*</h4>
				<input type="text" name="CodePostalAssocie">
				<h4>Ville*</h4>
				<input type="text" name="VilleAssocie">	
				<select name="PaysAssocie" size="1" >
					<option value = "PaysAssocie">Pays</option>
					<?php 
					$listePays = listePays($connexion);
					for($i=0;$i<count($listePays);$i++)
					{
						$pays = recupUnPays($listePays,$i);

					}
					?>
				</select><br>

				<h4>Date de naissance*</h4>
				<input type="date" name="DateNaissanceAssocie"><br>
				<h4>Nationalité*</h4>
				<input type="text" name="NationaliteAssocie">
				<h4>Téléphone*</h4>
				<input type="text" name="TelephoneAssocie">
				<h4>Email*</h4>
				<input type="email" name="EmailAssocie">
				<h4> Fonds injecté dans la société (en euros)*</h4>
				<input type="text" name="SommeAssocie"><br><br>
				<?php 
				for ($i = 1; $i<$_SESSION["nbassocie"];$i++) {
					if ($_SESSION["associeGerant"] == "non" && $_SESSION["associeGerant".$i] == "non") 
					{ 
						?>
						<h3 class="text-center">L'associé est il gérant de la société ?</h3>       
						<input type="radio" name="associeGerant" value="oui"> Oui <br>
						<input type="radio" name="associeGerant" value="non"> Non <br>
						<?php
					}
				}
				?>
				<h3 class="text-center">Souhaitez vous ajouter un autre associé ?</h3>       
				<input type="radio" name="AjouterAssocie" value="oui"> Oui<br>
				<input type="radio" name="AjouterAssocie" value="non"> Non</br><br>
				<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
			</div><br>
			<?php
			echo "* Champs obligatoires";
			$_SESSION["nbassocie"] = $_SESSION["nbassocie"] + 1 ;
		}

		//4ème question: Determination de l'activité et du secteur d'activité de l'entreprise si le client n'a pas d'associé + recuperation des infos de la fiche d'identité + insertion dans la base des infos de la fiche identité et de la date de creation de l'entreprise
		if (isset($_POST['Valider']) && !empty($_POST["SexeAssocie"]) && !empty($_POST["NomAssocieClient"]) && !empty($_POST["LieuNaissanceAssocie"]) && !empty($_POST["PrenomAssocie"]) && !empty($_POST["NumeroEtVoieAssocie"]) && !empty($_POST["CodePostalAssocie"]) && !empty($_POST["VilleAssocie"]) && !empty($_POST["NationaliteAssocie"]) && !empty($_POST["TelephoneAssocie"]) && !empty($_POST["EmailAssocie"]) && !empty($_POST["nombreAssocie"]) && ($_POST["nombreAssocie"] == 'un') && !empty($_POST["associeGerant"]) && !empty($_POST["DateNaissanceAssocie"]) && !empty($_POST["SommeAssocie"]) && !empty($_POST["PaysAssocie"]) && ($_POST["PaysAssocie"] != 'PaysAssocie'))
		{

			$_SESSION["SexeAssocie"]=$_POST["SexeAssocie"];
			$_SESSION["NomAssocieClient"]=$_POST["NomAssocieClient"];
			$_SESSION["PrenomAssocie"]=$_POST["PrenomAssocie"];
			$_SESSION["NomNaissanceAssocie"]=$_POST["NomNaissanceAssocie"];
			$_SESSION["LieuNaissanceAssocie"]=$_POST["LieuNaissanceAssocie"];	
			$_SESSION["NumeroEtVoieAssocie"]=$_POST["NumeroEtVoieAssocie"];
			$_SESSION["CodePostalAssocie"]=$_POST["CodePostalAssocie"];
			$_SESSION["VilleAssocie"]=$_POST["VilleAssocie"];
			$_SESSION["PaysAssocie"]=$_POST["PaysAssocie"];
			$_SESSION["NationaliteAssocie"]=$_POST["NationaliteAssocie"];
			$_SESSION["TelephoneAssocie"]=$_POST["TelephoneAssocie"];
			$_SESSION["EmailAssocie"]=$_POST["EmailAssocie"];
			$_SESSION["DateNaissanceAssocie"] = date('Y-m-d', strtotime(str_replace('/','-',$_POST["DateNaissanceAssocie"])));
			$_SESSION["associeGerant"] = $_POST["associeGerant"];
			$_SESSION["SommeAssocie"] = $_POST["SommeAssocie"];

			?>
			<h2 class="text-center">Activité de la société ?</h2>       
			<h4>Secteur d'activité*</h4>
			<select name="SecteurActivite" size="1" >
				<option value = "Choisir">Choisir</option>
				<?php 
				$listeSecteurDActivite = listeSecteurDActivites($connexion);
				for($i=0;$i<count($listeSecteurDActivite);$i++)
				{
					$SecteurDActivite = recupUnSecteurDActivite($listeSecteurDActivite,$i);
				}
				?>
			</select>
			<h4>Activité*</h4>
			<select name="Activite" size="1" >
				<option value = "Choisir">Choisir</option>
				<?php 
				$listeActivite = listeActivite($connexion);
				for($i=0;$i<count($listeActivite);$i++)
				{
					$Activite = recupUneActivite($listeActivite,$i);

				}
				?>
			</select><br>
			<h4>Description*</h4>
			<textarea class="form-control" name="Description" maxlength="1000" placeholder="Decrivez votre activité"></textarea>
			<button class="btn btn-primary" type="submit" name="Valider">Valider </button><br><br>
			<?php
			echo "* Champs obligatoires";

		}

		//5ème ou 6ème question: Determination de l'activité et du secteur d'activité de l'entreprise si le client à au moins un associé + recuperation des infos de la dernière fiche associé + insertion dans la base des infos de la fiche associé

		if (isset($_POST['Valider']) && !empty($_POST["SexeAssocie"]) && !empty($_POST["NomAssocie"]) && !empty($_POST["PrenomAssocie"]) && !empty($_POST["LieuNaissanceAssocie"])&& !empty($_POST["NumeroEtVoieAssocie"]) && !empty($_POST["CodePostalAssocie"]) && !empty($_POST["VilleAssocie"]) && !empty($_POST["NationaliteAssocie"]) && !empty($_POST["PaysAssocie"]) && !empty($_POST["DateNaissanceAssocie"]) && !empty($_POST["EmailAssocie"]) && !empty($_POST["TelephoneAssocie"]) && !empty($_POST["SommeAssocie"]) && isset($_POST["AjouterAssocie"]) && ($_POST["AjouterAssocie"] == 'non') && ($_POST["PaysAssocie"] != 'PaysAssocie'))
		{
			$_SESSION["SexeAssocie".$_SESSION["nbassocie"]]=$_POST["SexeAssocie"];
			$_SESSION["NomAssocie".$_SESSION["nbassocie"]]=$_POST["NomAssocie"];
			$_SESSION["PrenomAssocie".$_SESSION["nbassocie"]]=$_POST["PrenomAssocie"];
			$_SESSION["NomNaissanceAssocie".$_SESSION["nbassocie"]]=$_POST["NomNaissanceAssocie"];
			$_SESSION["LieuNaissanceAssocie".$_SESSION["nbassocie"]]=$_POST["LieuNaissanceAssocie"];	
			$_SESSION["NumeroEtVoieAssocie".$_SESSION["nbassocie"]]=$_POST["NumeroEtVoieAssocie"];
			$_SESSION["CodePostalAssocie".$_SESSION["nbassocie"]]=$_POST["CodePostalAssocie"];
			$_SESSION["VilleAssocie".$_SESSION["nbassocie"]]=$_POST["VilleAssocie"];
			$_SESSION["PaysAssocie".$_SESSION["nbassocie"]]=$_POST["PaysAssocie"];
			$_SESSION["NationaliteAssocie".$_SESSION["nbassocie"]]=$_POST["NationaliteAssocie"];
			$_SESSION["TelephoneAssocie".$_SESSION["nbassocie"]]=$_POST["TelephoneAssocie"];
			$_SESSION["EmailAssocie".$_SESSION["nbassocie"]]=$_POST["EmailAssocie"];
			$_SESSION["DateNaissanceAssocie".$_SESSION["nbassocie"]] = date('Y-m-d', strtotime(str_replace('/','-',$_POST["DateNaissanceAssocie"])));
			if (isset($_POST["associeGerant"])) 
			{
				$_SESSION["associeGerant".$_SESSION["nbassocie"]] = $_POST["associeGerant"];
			}
			else
			{
				$_SESSION["associeGerant".$_SESSION["nbassocie"]] = "non";
			}

			$_SESSION["SommeAssocie".$_SESSION["nbassocie"]] = $_POST["SommeAssocie"];

			?>
			<h2 class="text-center">Activité de la société ?</h2>       
			<h4>Secteur d'activité*</h4>
			<select name="SecteurActivite" size="1" >
				<option value = "Choisir">Choisir</option>
				<?php 
				$listeSecteurDActivite = listeSecteurDActivites($connexion);
				for($i=0;$i<count($listeSecteurDActivite);$i++)
				{
					$SecteurDActivite = recupUnSecteurDActivite($listeSecteurDActivite,$i);

				}
				?>
			</select>
			<h4>Activité*</h4>
			<select name="Activite" size="1" >
				<option value = "Choisir">Choisir</option>
				<?php 
				$listeActivite = listeActivite($connexion);
				for($i=0;$i<count($listeActivite);$i++)
				{
					$Activite = recupUneActivite($listeActivite,$i);

				}
				?>
			</select><br>
			<h4>Description*</h4>
			<textarea class="form-control" name="Description" maxlength="1000" placeholder="Decrivez votre activité"></textarea>
			<button class="btn btn-primary" type="submit" name="Valider">Valider </button><br><br>
			<?php
			echo "* Champs obligatoires";
		}

		//5ème 6ème ou 7ème question: Determination du nom de l'entreprise + récuperation/insertion dans la base du secteur d'activité et de l'activité de l'entreprise

		if (isset($_POST['Valider']) && !empty($_POST["SecteurActivite"]) && !empty($_POST["Activite"]) && !empty($_POST["Description"]) && ($_POST["SecteurActivite"] != 'Choisir') && ($_POST["Activite"] != 'Choisir')) 
		{
			$_SESSION["SecteurActivite"]=$_POST["SecteurActivite"];
			$_SESSION["Activite"]=$_POST["Activite"];
			$_SESSION["Description"]=$_POST["Description"];

			?>
			<div class="form-group">                      
				<h2 class="text-center">Votre société</h2>    
				<h4>Nom*</h4>
				<input type="text" name="NomSociete"><br>
				<h4>Duree de vie de la société (en année)*</h4>
				<input type="text" name="DureeVieSociete" placeholder="Généralement 99 ans"><br>
				<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
				<?php
			}

			//6ème 7ème ou 8ème question: Determination du type de domiciliation de l'entreprise + récuperation/insertion dans la base du nom de l'entreprise

			if (isset($_POST['Valider']) && !empty($_POST["NomSociete"]) && !empty($_POST["DureeVieSociete"])) 
			{
				$_SESSION["NomSociete"]=$_POST["NomSociete"];
				$_SESSION["DureeVieSociete"]=$_POST["DureeVieSociete"];
				?>
				<h2 style="text-align: center;">Adresse</h2>
				<h3>Le siège de votre société se trouve</h3>
				<div class="form-group">
					<input type="radio" name="adresseSiege" value="A l'adresse du gérant"> A l'adresse du gérant<br>
					<input type="radio" name="adresseSiege" value="Chez NBS"> Je souhaite domicilier avec NBS<br>
					<input type="radio" name="adresseSiege" value="Chez une autre entreprise"> Je domicilie avec une autre entreprise<br>
					<input type="radio" name="adresseSiege" value=" Dans des locaux que je loues"> Je loues des locaux<br>
					<input type="radio" name="adresseSiege" value="Dans des locaux gratuits"> Dans des locaux mis gratuitement à ma disposition<br>
					<input type="radio" name="adresseSiege" value="Ailleurs"> Ailleurs (pepinière, incubateur...)<br>
				</div>
				<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
				<?php
			}

			//7ème 8ème ou 9ème question: Questionnaire relatif a l'adresse de l'entreprise si l'entreprise est domicilié ailleurs que chez le gérant + récuperation/insertion dans la base du type de domiciliation

			if (isset($_POST['Valider']) && !empty($_POST["adresseSiege"]) && ($_POST["adresseSiege"] != "A l'adresse du gérant")) 
			{
				$_SESSION["adresseSiege"]=$_POST["adresseSiege"];

				?>
				<h3>Quelle sera l'adresse de votre société ?</h3><br><br>
				<h4>Numéro et voie*</h4>
				<input type="text" name="NumeroEtVoieSociete">
				<h4>Code Postal*</h4>
				<input type="text" name="CodePostalSociete">
				<h4>Ville*</h4>
				<input type="text" name="VilleSociete">
				<select name="PaysSociete" size="1" >
					<option value = "PaysSociete">Pays</option>
					<?php 
					$listePays = listePays($connexion);
					for($i=0;$i<count($listePays);$i++)
					{
						$pays = recupUnPays($listePays,$i);

					}
					?>
				</select><br>
			</br>
			<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
			<?php
			echo "* Champs obligatoires";
		}

		//7ème 8ème ou 9ème question: Demande des capitaux de l'entrprise injecté par chaque associé(e)(s) (si il y en a) et du client de l'entreprise si l'entreprise est domicilié ailleurs que chez le gérant + récuperation/insertion dans la base de l'adresse de l'entreprise
		if (isset($_POST['Valider']) && !empty($_POST["adresseSiege"]) && ($_POST["adresseSiege"] == "A l'adresse du gérant")) 
		{
			$_SESSION["adresseSiege"]=$_POST["adresseSiege"];
			?>
			<h2 class="text-center">Quel sera votre régime fiscal ?</h2>    
			<div class="form-liste">
				<h3>Régime Fiscal*</h3>
				<select name="RegimeFiscal">
					<option value = "Choisir">Choisir</option>
					<?php 
					$listeRegimeFiscaux = listeRegimeFiscaux($connexion);
					for($i=0;$i<count($listeRegimeFiscaux);$i++)
					{
						$RegimeFiscal = recupUnRegimeFiscal($listeRegimeFiscaux,$i);

					}
					?>
				</select>
			</div>
			<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
			<?php

		}

		//8ème 9ème ou 10ème question: Demande des capitaux de l'entrprise injecté par chaque associé(e)(s) (si il y en a) et du client de l'entreprise si l'entreprise est domicilié ailleurs que chez le gérant + récuperation/insertion dans la base de l'adresse de l'entreprise
		if (isset($_POST['Valider']) && !empty($_POST["NumeroEtVoieSociete"]) && !empty($_POST["PaysSociete"]) && !empty($_POST["CodePostalSociete"]) && !empty($_POST["VilleSociete"])) 
		{
			$_SESSION["NumeroEtVoieSociete"]=$_POST["NumeroEtVoieSociete"];
			$_SESSION["CodePostalSociete"]=$_POST["CodePostalSociete"];
			$_SESSION["VilleSociete"]=$_POST["VilleSociete"];
			$_SESSION["PaysSociete"]=$_POST["PaysSociete"];
			?>
			<h2 class="text-center">Quel sera votre régime fiscal ?</h2>    
			<div class="form-liste">
				<h3>Régime Fiscal*</h3>
				<select name="RegimeFiscal">
					<option value = "Choisir">Choisir</option>
					<?php 
					$listeRegimeFiscaux = listeRegimeFiscaux($connexion);
					for($i=0;$i<count($listeRegimeFiscaux);$i++)
					{
						$RegimeFiscal = recupUnRegimeFiscal($listeRegimeFiscaux,$i);
					}
					?>
				</select>
			</div>
			<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
			<?php
		}
		?>
		<?php

		//10ème 11ème ou 12ème question: Demande du statut social choisi pour l'entreprise + récuperation/insertion dans la base du regime fiscal de l'entreprise
		if (isset($_POST['Valider']) && !empty($_POST["RegimeFiscal"]) && ($_POST["RegimeFiscal"] != "Choisir")) 
		{
			$_SESSION["RegimeFiscal"]=$_POST["RegimeFiscal"];
			?>
			<h2 class="text-center">Quel sera votre statut social ?</h2>    
			<div class="form-liste">
				<h3>Statut Social*</h3>
				<select name="StatutSocial">
					<option>TNS</option>
					<option>Assimilié salariés</option>
				</select>
			</div>
			<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
			<?php
		}

		//11ème 12ème ou 13ème question: Vérification des infos remplies par le client + récuperation/insertion dans la base du statut sociale de l'entreprise
		if (isset($_POST['Valider']) && !empty($_POST["StatutSocial"])) 
		{
			$_SESSION["StatutSocial"]=$_POST["StatutSocial"];

			//Insertion de la Société si l'adresse se situe chez le gérant
			if ($_SESSION["adresseSiege"] != "A l'adresse du gérant")
			{
				$nom_societe = $_SESSION["NomSociete"];
				$forme_juridique_societe = $_SESSION['formeJuridique'];
				$regime_fiscal_societe = $_SESSION["RegimeFiscal"];
				$secteur_d_activite_societe = $_SESSION["SecteurActivite"];
				$activite_societe = $_SESSION["Activite"];
				$description_activite_societe = $_SESSION["Description"]; 
				$duree_vie_societe = $_SESSION["DureeVieSociete"];
				$adresse_societe = $_SESSION["NumeroEtVoieSociete"];
				$code_postal_societe = $_SESSION['CodePostalSociete'];
				$ville_societe = $_SESSION["VilleSociete"];
				$pays_societe = $_SESSION["PaysSociete"];
				$statut_social_societe = $_SESSION["StatutSocial"];

				try {
					$req = $connexion->prepare("INSERT INTO Societes(nom_societe,forme_juridique_societe,regime_fiscal_societe,statut_social_societe,secteur_d_activite_societe,activite_societe,description_activite_societe,duree_vie_societe,adresse_societe,code_postal_societe,ville_societe,pays_societe) values(:nom_societe,:forme_juridique_societe,:regime_fiscal_societe,:statut_social_societe,:secteur_d_activite_societe,:activite_societe,:description_activite_societe,:duree_vie_societe,:adresse_societe,:code_postal_societe,:ville_societe,:pays_societe);");
					$req->execute(array(
						'nom_societe'=>$nom_societe,
						'forme_juridique_societe'=>$forme_juridique_societe,
						'regime_fiscal_societe'=>$regime_fiscal_societe,
						'statut_social_societe'=> $statut_social_societe,
						'secteur_d_activite_societe'=>$secteur_d_activite_societe,
						'activite_societe'=>$activite_societe,
						'description_activite_societe'=>$description_activite_societe,
						'duree_vie_societe'=>$duree_vie_societe,
						'adresse_societe'=>$adresse_societe,
						'code_postal_societe'=>$code_postal_societe,
						'ville_societe'=>$ville_societe,
						'pays_societe'=>$pays_societe,

					));       
					$id_societe = $connexion->lastInsertId();
					$_SESSION["id_societe"] = $id_societe;

				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}
			}

			//Insertion de la Société si la société ne se situe pas chez le gérant
			if ($_SESSION["adresseSiege"] == "A l'adresse du gérant")
			{
				$nom_societe = $_SESSION["NomSociete"];
				$forme_juridique_societe = $_SESSION['formeJuridique'];
				$regime_fiscal_societe = $_SESSION["RegimeFiscal"];
				$statut_social_societe = $_SESSION["StatutSocial"];
				$secteur_d_activite_societe = $_SESSION["SecteurActivite"];
				$activite_societe = $_SESSION["Activite"];
				$description_activite_societe = $_SESSION["Description"]; 
				$duree_vie_societe = $_SESSION["DureeVieSociete"];
				$adresse_societe = " ";
				$code_postal_societe = 0;
				$ville_societe = " ";
				$pays_societe = " ";

				
				try {

					$req = $connexion->prepare("INSERT INTO Societes(nom_societe,forme_juridique_societe,regime_fiscal_societe,statut_social_societe,secteur_d_activite_societe,activite_societe,description_activite_societe,duree_vie_societe,adresse_societe,code_postal_societe,ville_societe,pays_societe) 
						values(:nom_societe,:forme_juridique_societe,:regime_fiscal_societe,:statut_social_societe,:secteur_d_activite_societe,:activite_societe,:description_activite_societe,:duree_vie_societe,:adresse_societe,:code_postal_societe,:ville_societe,:pays_societe);");
					$req->execute(array(
						'nom_societe'=>$nom_societe,
						'forme_juridique_societe'=>$forme_juridique_societe,
						'regime_fiscal_societe'=>$regime_fiscal_societe,
						'statut_social_societe'=> $statut_social_societe,
						'secteur_d_activite_societe'=>$secteur_d_activite_societe,
						'activite_societe'=>$activite_societe,
						'description_activite_societe'=>$description_activite_societe,
						'duree_vie_societe'=>$duree_vie_societe,
						'adresse_societe'=>$adresse_societe,
						'code_postal_societe'=>$code_postal_societe,
						'ville_societe'=>$ville_societe,
						'pays_societe'=>$pays_societe,
					));        
					$id_societe = $connexion->lastInsertId();
					$_SESSION["id_societe"] = $id_societe;
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}
			}


			//Insertion du Client
			$nomAssocie=$_SESSION["NomAssocieClient"];
			$NomNaissanceAssocie=$_SESSION["NomNaissanceAssocie"];
			$PrenomAssocie=$_SESSION["PrenomAssocie"];
			$SexeAssocie=$_SESSION["SexeAssocie"];
			$LieuNaissanceAssocie=$_SESSION["LieuNaissanceAssocie"];
			$DateNaissanceAssocie=$_SESSION["DateNaissanceAssocie"];
			$NumeroEtVoieAssocie=$_SESSION["NumeroEtVoieAssocie"];
			$CodePostalAssocie=$_SESSION["CodePostalAssocie"];
			$VilleAssocie=$_SESSION["VilleAssocie"];
			$PaysAssocie=$_SESSION["PaysAssocie"];
			$NationaliteAssocie=$_SESSION["NationaliteAssocie"];
			$TelephoneAssocie=$_SESSION["TelephoneAssocie"];
			$EmailAssocie= $_SESSION["EmailAssocie"];
			$SommeAssocie= $_SESSION["SommeAssocie"];
			$id_societe = $_SESSION["id_societe"];

			if ($_SESSION["associeGerant"] == "oui")
			{
				$gerant_societe = 1;

			}

			else
			{
				$gerant_societe=0;

			}
			try {

				$req = $connexion->prepare("INSERT INTO Associes(nom_associe,nom_naissance_associe,prenom_associe,sexe_associe,lieu_naissance_associe,date_naissance_associe,adresse_associe,code_postal_associe,ville_associe,pays_associe,nationalite_associe,telephone_associe,email_associe,fond_associes,id_societe,gerant_societe) 
					values(:nom_associe,:nom_naissance_associe,:prenom_associe,:sexe_associe,:lieu_naissance_associe,:date_naissance_associe,:adresse_associe,:code_postal_associe,:ville_associe,:pays_associe,:nationalite_associe,:telephone_associe,:email_associe,:fond_associes,:id_societe,:gerant_societe);");
				$req->execute(array(
					'nom_associe'=>$nomAssocie,
					'nom_naissance_associe'=>$NomNaissanceAssocie,
					'prenom_associe'=>$PrenomAssocie,
					'sexe_associe'=>$SexeAssocie,
					'lieu_naissance_associe'=>$LieuNaissanceAssocie,
					'date_naissance_associe'=>$DateNaissanceAssocie,
					'adresse_associe'=>$NumeroEtVoieAssocie,
					'code_postal_associe'=>$CodePostalAssocie,
					'ville_associe'=>$VilleAssocie,
					'nationalite_associe'=>$NationaliteAssocie,
					'pays_associe'=>$PaysAssocie,
					'telephone_associe'=>$TelephoneAssocie,
					'email_associe'=>$EmailAssocie,
					'fond_associes'=>$SommeAssocie,
					'id_societe'=>$id_societe,
					'gerant_societe'=>$gerant_societe,
				));        
			}
			catch (PDOException $e) {
				echo $e->getMessage();
			}

			//Insertion des Associés
			if(isset($_SESSION["nbassocie"]) && $_SESSION["nbassocie"] >= 1) 
			{
				for($i=1;$i<=$_SESSION["nbassocie"];$i++) 
				{
					$nomAssocie=$_SESSION["NomAssocie".$i];
					$NomNaissanceAssocie=$_SESSION["NomNaissanceAssocie".$i];
					$PrenomAssocie=$_SESSION["PrenomAssocie".$i];
					$SexeAssocie=$_SESSION["SexeAssocie".$i];
					$LieuNaissanceAssocie=$_SESSION["LieuNaissanceAssocie".$i];
					$DateNaissanceAssocie=$_SESSION["DateNaissanceAssocie".$i];
					$NumeroEtVoieAssocie=$_SESSION["NumeroEtVoieAssocie".$i];
					$CodePostalAssocie=$_SESSION["CodePostalAssocie".$i];
					$VilleAssocie=$_SESSION["VilleAssocie".$i];
					$PaysAssocie=$_SESSION["PaysAssocie".$i];
					$NationaliteAssocie=$_SESSION["NationaliteAssocie".$i];
					$TelephoneAssocie=$_SESSION["TelephoneAssocie".$i];
					$EmailAssocie= $_SESSION["EmailAssocie".$i];
					$SommeAssocie= $_SESSION["SommeAssocie".$i];
					$id_societe = $_SESSION["id_societe"];
					if ($_SESSION["associeGerant".$i] == "oui")
					{
						$gerant_societe = 1;

					}

					else
					{
						$gerant_societe=0;

					}

					try {

						$req = $connexion->prepare("INSERT INTO Associes(nom_associe,nom_naissance_associe,prenom_associe,sexe_associe,lieu_naissance_associe,date_naissance_associe,adresse_associe,code_postal_associe,ville_associe,pays_associe,nationalite_associe,telephone_associe,email_associe,fond_associes,id_societe,gerant_societe) 
							values(:nom_associe,:nom_naissance_associe,:prenom_associe,:sexe_associe,:lieu_naissance_associe,:date_naissance_associe,:adresse_associe,:code_postal_associe,:ville_associe,:pays_associe,:nationalite_associe,:telephone_associe,:email_associe,:fond_associes,:id_societe,:gerant_societe);");
						$req->execute(array(
							'nom_associe'=>$nomAssocie,
							'nom_naissance_associe'=>$NomNaissanceAssocie,
							'prenom_associe'=>$PrenomAssocie,
							'sexe_associe'=>$SexeAssocie,
							'lieu_naissance_associe'=>$LieuNaissanceAssocie,
							'date_naissance_associe'=>$DateNaissanceAssocie,
							'adresse_associe'=>$NumeroEtVoieAssocie,
							'code_postal_associe'=>$CodePostalAssocie,
							'ville_associe'=>$VilleAssocie,
							'nationalite_associe'=>$NationaliteAssocie,
							'pays_associe'=>$PaysAssocie,
							'telephone_associe'=>$TelephoneAssocie,
							'email_associe'=>$EmailAssocie,
							'fond_associes'=>$SommeAssocie,
							'id_societe'=>$id_societe,
							'gerant_societe'=>$gerant_societe,
						));        
						echo "C'est inséré";
					}
					catch (PDOException $e) {
						echo $e->getMessage();
					}
				}
			}
			//Insertion de Dossier
			$requete = $connexion->prepare("select id_associe from associes where gerant_societe = 1 and id_societe = $id_societe;");
			$requete->execute(array(
				'id_societe' => $id_societe,
			));

			$ligne = $requete->Fetch();
			$_SESSION["gerant"] = $ligne["id_associe"];
			$delai_de_creation=$_SESSION["dateCreation"];
			$id_societe = $_SESSION["id_societe"];
			$gerant = $_SESSION["gerant"];
			$id_user = $_SESSION["membre_id"];
			try {
				$req = $connexion->prepare("INSERT INTO Dossiers(delai_de_creation,id_societe,gerant_societe,id_user) 
					values(:delai_de_creation,:id_societe,:gerant_societe,:id_user);");
				$req->execute(array(
					"delai_de_creation" => $delai_de_creation,
					"gerant_societe" => $gerant,
					"id_societe" => $id_societe,
					"id_user" => $id_user,
				));        
			}
			catch (PDOException $e) {
				echo $e->getMessage();
			}

			if ($_SESSION["adresseSiege"] == "A l'adresse du gérant")
			{
				$requete = $connexion->prepare("select adresse_associe, code_postal_associe, ville_associe, pays_associe from associes where gerant_societe = 1 and id_societe=:id_societe;");
				$requete->execute(array(
					'id_societe' => $id_societe
				));
				$ligne = $requete->Fetch();

				$_SESSION["NumeroEtVoieSociete"] = $ligne['adresse_associe'];
				$_SESSION['CodePostalSociete'] = $ligne['code_postal_associe'];
				$_SESSION["VilleSociete"] = $ligne['ville_associe'];
				$_SESSION["PaysSociete"] = $ligne["pays_associe"];

				$adresse_societe = $_SESSION["NumeroEtVoieSociete"];
				$code_postal_societe = $_SESSION['CodePostalSociete'];
				$ville_societe = $_SESSION["VilleSociete"];
				$pays_societe = $_SESSION["PaysSociete"];

				$requete = $connexion->prepare("UPDATE Societes set adresse_societe = :adresse_societe, code_postal_societe = :code_postal_societe, ville_societe = :ville_societe, pays_societe = :pays_societe where id_societe=:id_societe;");
				$requete->execute(array(
					'adresse_societe' => $adresse_societe,
					'code_postal_societe' => $code_postal_societe,
					'ville_societe' => $ville_societe,
					'pays_societe' => $pays_societe,
					'id_societe' => $id_societe,
				));

			}

			$requete = $connexion->prepare("select * from associes where id_societe = :id_societe order by id_associe;");
			$requete->execute(array(
				'id_societe' => $id_societe
			));
			$ligne = $requete->Fetch();
			echo'<h4>Vous êtes</h4>';?><br><?php
			$_SESSION['compteur'] = 1;
			while ($ligne) 
			{
				$_SESSION["associe"]["id_associe".$_SESSION['compteur']] = $ligne["id_associe"];

				$_SESSION["associe"]["SexeAssocie".$_SESSION['compteur']] = $ligne["sexe_associe"];
				echo'Sexe: <input type="text" name="SexeAssocie'.$_SESSION['compteur'].'" value="'. $ligne["sexe_associe"].'">';?><br><?php

				$_SESSION["associe"]["NomAssocie".$_SESSION['compteur']] = $ligne["nom_associe"];
				echo'Nom: <input type="text" name="NomAssocie'.$_SESSION['compteur'].'" value="'. $ligne['nom_associe'].'">';?><br><?php

				if(!empty($SESSION["NomNaissanceAssocie"]))
				{
					$_SESSION["associe"]["NomNaissanceAssocie".$_SESSION['compteur']] = $ligne["nom_naissance_associe"];
					echo'Nom de naissance: <input type="text" name="NomNaissanceAssocie'.$_SESSION['compteur'].'" value="'. $ligne["nom_naissance_associe"].'">';?><br><?php
				}

				$_SESSION["associe"]["LieuNaissanceAssocie".$_SESSION['compteur']] = $ligne["lieu_naissance_associe"];
				echo'Lieu de naissance: <input type="text" name="LieuNaissanceAssocie'.$_SESSION['compteur'].'" value="'.$ligne['lieu_naissance_associe'].'">';?><br><?php

				$_SESSION["associe"]["PrenomAssocie".$_SESSION['compteur']] = $ligne["prenom_associe"];
				echo'Prenom: <input type="text" name="PrenomAssocie'.$_SESSION['compteur'].'" value="'.$ligne['prenom_associe'].'">';?><br><?php

				$_SESSION["associe"]["NumeroEtVoieAssocie".$_SESSION['compteur']] = $ligne["adresse_associe"];
				echo'Numero et voie: <input type="text" name="NumeroEtVoieAssocie'.$_SESSION['compteur'].'" value="'.$ligne["adresse_associe"].'">';?><br><?php

				$_SESSION["associe"]["CodePostalAssocie".$_SESSION['compteur']] = $ligne["code_postal_associe"];
				echo'Code Postal:  <input type="text" name="CodePostalAssocie'.$_SESSION['compteur'].'" value="'. $ligne["code_postal_associe"].'">';?><br><?php

				$_SESSION["associe"]["VilleAssocie".$_SESSION['compteur']] = $ligne["ville_associe"];
				echo'Ville:  <input type="text" name="VilleAssocie'.$_SESSION['compteur'].'" value="'. $ligne["ville_associe"].'">';?><br><?php

				$_SESSION["associe"]["PaysAssocie".$_SESSION['compteur']] = $ligne["pays_associe"];
				echo'Pays:  <input type="text" name="PaysAssocie'.$_SESSION['compteur'].'" value="'. $ligne["pays_associe"].'">';?><br><?php

				$_SESSION["associe"]["NationaliteAssocie".$_SESSION['compteur']] = $ligne["nationalite_associe"];
				echo'Nationalite:  <input type="text" name="NationaliteAssocie'.$_SESSION['compteur'].'" value="'. $ligne["nationalite_associe"].'">';?><br><?php

				$_SESSION["associe"]["TelephoneAssocie".$_SESSION['compteur']] = $ligne["telephone_associe"];
				echo'Telephone:  <input type="text" name="TelephoneAssocie'.$_SESSION['compteur'].'" value="'. $ligne["telephone_associe"].'">';?><br><?php

				$_SESSION["associe"]["EmailAssocie".$_SESSION['compteur']] = $ligne["email_associe"];
				echo'Email:  <input type="text" name="EmailAssocie'.$_SESSION['compteur'].'" value="'. $ligne["email_associe"].'">';?><br><?php

				$_SESSION["associe"]["SommeAssocie".$_SESSION['compteur']] = $ligne["fond_associes"];
				echo'Fonds:  <input type="text" name="SommeAssocie'.$_SESSION['compteur'].'" value="'. $ligne["fond_associes"].'">';?><br><?php

				$_SESSION["associe"]["DateNaissanceAssocie".$_SESSION['compteur']] = $ligne["date_naissance_associe"];
				echo'Date de naissance:  <input type="text" name="DateNaissanceAssocie'.$_SESSION['compteur'].'" value="'. $ligne["date_naissance_associe"].'">';?><br><?php

				if ($ligne["gerant_societe"] == 1) 
				{
					echo "Gerant de la société";
				}
				$ligne = $requete->Fetch();
				if ($ligne == true) {

					echo'<h4>Associé n°'.$_SESSION['compteur'].'</h4><br>';
					$_SESSION['compteur'] = $_SESSION['compteur'] +1;
				}

				
			}

			$requete = $connexion->prepare("select * from societes where id_societe = :id_societe;");
			$requete->execute(array(
				'id_societe' => $id_societe
			));
			$ligne = $requete->Fetch();
			echo'<h4>Votre Societe</h4>';?><br><?php
			$_SESSION["id_societe"] = $ligne["id_societe"];

			$_SESSION["NomSocieteA"] = $ligne["nom_societe"];
			echo'Nom: <input type="text" name="NomSocieteA" value="'.$ligne['nom_societe'].'">';?><br><?php

			echo'Forme juridique: '.$ligne['forme_juridique_societe'];?><br><?php

			$_SESSION["RegimeFiscalA"] = $ligne["regime_fiscal_societe"];
			echo'Regime fiscal: <input type="text" name="RegimeFiscalA" value="'.$ligne['regime_fiscal_societe'].'">';?><br><?php

			$_SESSION["StatutSocialA"] = $ligne["statut_social_societe"];
			echo'Statut social: <input type="text" name="StatutSocialA" value="'.$ligne['statut_social_societe'].'">';?><br><?php

			$_SESSION["SecteurActiviteA"] = $ligne["secteur_d_activite_societe"];
			echo'Secteur Activité: <input type="text" name="SecteurActiviteA" value="'.$ligne["secteur_d_activite_societe"].'">';?><br><?php

			$_SESSION["ActiviteA"] = $ligne["activite_societe"];
			echo'Activité: <input type="text" name="ActiviteA" value="'.$ligne["activite_societe"].'">';?><br><?php

			$_SESSION["DescriptionA"] = $ligne["description_activite_societe"];
			echo'Description: <input type="text" name="DescriptionA" value="'.$ligne["description_activite_societe"].'">';?><br><?php

			$_SESSION["DureeVieSocieteA"] = $ligne["duree_vie_societe"];
			echo'Durée de vie de la société: <input type="text" name="DureeVieSocieteA" value="'.$ligne["duree_vie_societe"].'"> ans';?><br><?php

			if ($_SESSION["adresseSiege"] != "A l'adresse du gérant"){
			$_SESSION["NumeroEtVoieSocieteA"] = $ligne["adresse_societe"];
			echo'Numero et voie: <input type="text" name="NumeroEtVoieSocieteA" value="'.$ligne["adresse_societe"].'">';?><br><?php

			$_SESSION["CodePostalSocieteA"] = $ligne["code_postal_societe"];
			echo'Code Postal: <input type="text" name="CodePostalSocieteA" value="'.$ligne["code_postal_societe"].'">';?><br><?php

			$_SESSION["VilleSocieteA"] = $ligne["ville_societe"];
			echo'Ville: <input type="text" name="VilleSocieteA" value="'.$ligne["ville_societe"].'">';?><br><?php

			$_SESSION["PaysSocieteA"] = $ligne["pays_societe"];
			echo'Pays: <input type="text" name="PaysSocieteA" value="'.$ligne["pays_societe"].'">';?><br><?php
		}
			else {
			echo'Numero et voie: '.$ligne["adresse_societe"];?><br><?php

			echo'Code Postal: '.$ligne["code_postal_societe"];?><br><?php

			echo'Ville: '.$ligne["ville_societe"];?><br><?php

			echo'Pays: '.$ligne["pays_societe"];?><br><?php
			}

			?>

			<button class="btn btn-primary" type="submit" name="Valider">Valider</button><br><br>
			<?php
		}

		if( isset($_POST['Valider']) && isset($_SESSION["compteur"]))
		{

			//En cas de modification des infos de la société
			if (isset($_POST["NomSocieteA"]) && $_POST["NomSocieteA"] != $_SESSION["NomSocieteA"] && isset($_SESSION["NomSocieteA"])) 
			{
				$nom_societe = $_POST["NomSocieteA"];
				$id_societe = $_SESSION["id_societe"];
				$requete = $connexion->prepare("UPDATE Societes set nom_societe = :nom_societe where id_societe=:id_societe;");
				$requete->execute(array(
					'nom_societe' => $nom_societe,
					'id_societe' => $id_societe,
				));

			}

			if (isset($_POST["RegimeFiscalA"]) && $_POST["RegimeFiscalA"] != $_SESSION["RegimeFiscalA"] && isset($_SESSION["RegimeFiscalA"])) 
			{
				$regime_fiscal_societe = $_POST["RegimeFiscalA"];
				$id_societe = $_SESSION["id_societe"];
				$requete = $connexion->prepare("UPDATE Societes set regime_fiscal_societe = :regime_fiscal_societe where id_societe=:id_societe;");
				$requete->execute(array(
					'regime_fiscal_societe' => $regime_fiscal_societe,
					'id_societe' => $id_societe,
				));

			}

			if (isset($_POST["StatutSocialA"]) && $_POST["StatutSocialA"] != $_SESSION["StatutSocialA"] && isset($_SESSION["StatutSocialA"])) 
			{
				$statut_social_societe = $_POST["StatutSocialA"];
				$id_societe = $_SESSION["id_societe"];
				$requete = $connexion->prepare("UPDATE Societes set statut_social_societe = :statut_social_societe where id_societe=:id_societe;");
				$requete->execute(array(
					'statut_social_societe' => $statut_social_societe,
					'id_societe' => $id_societe,
				));

			}

			if (isset($_POST["SecteurActiviteA"]) && $_POST["SecteurActiviteA"] != $_SESSION["SecteurActiviteA"] && isset($_SESSION["SecteurActiviteA"])) 
			{
				$secteur_d_activite_societe = $_POST["SecteurActiviteA"];
				$id_societe = $_SESSION["id_societe"];
				$requete = $connexion->prepare("UPDATE Societes set secteur_d_activite_societe = :secteur_d_activite_societe where id_societe=:id_societe;");
				$requete->execute(array(
					'secteur_d_activite_societe' => $secteur_d_activite_societe,
					'id_societe' => $id_societe,
				));

			}

			if (isset($_POST["ActiviteA"]) && $_POST["ActiviteA"] != $_SESSION["ActiviteA"] && isset($_SESSION["ActiviteA"])) 
			{
				$activite_societe = $_POST["ActiviteA"];
				$id_societe = $_SESSION["id_societe"];
				$requete = $connexion->prepare("UPDATE Societes set activite_societe = :activite_societe where id_societe=:id_societe;");
				$requete->execute(array(
					'activite_societe' => $activite_societe,
					'id_societe' => $id_societe,
				));

			}

			if (isset($_POST["DescriptionA"]) && $_POST["DescriptionA"] != $_SESSION["DescriptionA"] && isset($_SESSION["DescriptionA"])) 
			{
				$description_activite_societe = $_POST["DescriptionA"];
				$id_societe = $_SESSION["id_societe"];
				$requete = $connexion->prepare("UPDATE Societes set description_activite_societe = :description_activite_societe where id_societe=:id_societe;");
				$requete->execute(array(
					'description_activite_societe' => $description_activite_societe,
					'id_societe' => $id_societe,
				));

			}

			if (isset($_POST["DureeVieSocieteA"]) && $_POST["DureeVieSocieteA"] != $_SESSION["DureeVieSocieteA"] && isset($_SESSION["DureeVieSociete"])) 
			{
				$duree_vie_societe = $_POST["DureeVieSocieteA"];
				$id_societe = $_SESSION["id_societe"];
				$requete = $connexion->prepare("UPDATE Societes set duree_vie_societe = :duree_vie_societe where id_societe=:id_societe;");
				$requete->execute(array(
					'duree_vie_societe' => $duree_vie_societe,
					'id_societe' => $id_societe,
				));

			}
			if ($_SESSION["adresseSiege"] != "A l'adresse du gérant") 
			{
				if (isset($_POST["NumeroEtVoieSocieteA"]) && $_POST["NumeroEtVoieSocieteA"] != $_SESSION["NumeroEtVoieSocieteA"] && isset($_SESSION["NumeroEtVoieSocieteA"])) 
				{
					$adresse_societe = $_POST["NumeroEtVoieSocieteA"];
					$id_societe = $_SESSION["id_societe"];
					$requete = $connexion->prepare("UPDATE Societes set adresse_societe = :adresse_societe where id_societe=:id_societe;");
					$requete->execute(array(
						'adresse_societe' => $adresse_societe,
						'id_societe' => $id_societe,
					));

				}

				if (isset($_POST["CodePostalSocieteA"]) && $_POST["CodePostalSocieteA"] != $_SESSION["CodePostalSocieteA"] && isset($_SESSION["CodePostalSocieteA"])) 
				{
					$code_postal_societe = $_POST["CodePostalSocieteA"];
					$id_societe = $_SESSION["id_societe"];
					$requete = $connexion->prepare("UPDATE Societes set code_postal_societe = :code_postal_societe where id_societe=:id_societe;");
					$requete->execute(array(
						'code_postal_societe' => $code_postal_societe,
						'id_societe' => $id_societe,
					));

				}

				if (isset($_POST["VilleSocieteA"]) && $_POST["VilleSocieteA"] != $_SESSION["VilleSocieteA"] && isset($_SESSION["VilleSocieteA"])) 
				{
					$ville_societe = $_POST["VilleSocieteA"];
					$id_societe = $_SESSION["id_societe"];
					$requete = $connexion->prepare("UPDATE Societes set ville_societe = :ville_societe where id_societe=:id_societe;");
					$requete->execute(array(
						'ville_societe' => $ville_societe,
						'id_societe' => $id_societe,
					));

				}

				if (isset($_POST["PaysSocieteA"]) && $_POST["PaysSocieteA"] != $_SESSION["PaysSocieteA"] && isset($_SESSION["PaysSocieteA"])) 
				{
					$pays_societe = $_POST["PaysSocieteA"];
					$id_societe = $_SESSION["id_societe"];
					$requete = $connexion->prepare("UPDATE Societes set pays_societe = :pays_societe where id_societe=:id_societe;");
					$requete->execute(array(
						'pays_societe' => $pays_societe,
						'id_societe' => $id_societe,
					));

				}
			}

//	En cas de modification des infos de l'associé
			for ($i=1;$i<=$_SESSION['compteur'];$i++)
			{	
				if (isset($_POST["SexeAssocie".$i]) && $_POST["SexeAssocie".$i] != $_SESSION["associe"]["SexeAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$sexe_associe = $_POST["SexeAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set sexe_associe = :sexe_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'sexe_associe' => $sexe_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["NomAssocie".$i]) && $_POST["NomAssocie".$i] != $_SESSION["associe"]["NomAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$nom_associe = $_POST["NomAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set nom_associe = :nom_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'nom_associe' => $nom_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["NomNaissanceAssocie".$i]) && $_POST["NomNaissanceAssocie".$i] != $_SESSION["associe"]["NomNaissanceAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$nom_naissance_associe = $_POST["NomNaissanceAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set nom_naissance_associe = :nom_naissance_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'nom_naissance_associe' => $nom_naissance_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["LieuNaissanceAssocie".$i]) && $_POST["LieuNaissanceAssocie".$i] != $_SESSION["associe"]["LieuNaissanceAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$lieu_naissance_associe = $_POST["LieuNaissanceAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set lieu_naissance_associe = :lieu_naissance_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'lieu_naissance_associe' => $lieu_naissance_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["PrenomAssocie".$i]) && $_POST["PrenomAssocie".$i] != $_SESSION["associe"]["PrenomAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$prenom_associe = $_POST["PrenomAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set prenom_associe = :prenom_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'prenom_associe' => $prenom_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["NumeroEtVoieAssocie".$i]) && $_POST["NumeroEtVoieAssocie".$i] != $_SESSION["associe"]["NumeroEtVoieAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$adresse_associe = $_POST["NumeroEtVoieAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set adresse_associe = :adresse_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'adresse_associe' => $adresse_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["CodePostalAssocie".$i]) && $_POST["CodePostalAssocie".$i] != $_SESSION["associe"]["CodePostalAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$code_postal_associe = $_POST["CodePostalAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set code_postal_associe = :code_postal_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'code_postal_associe' => $code_postal_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["VilleAssocie".$i]) && $_POST["VilleAssocie".$i] != $_SESSION["associe"]["VilleAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$ville_associe = $_POST["VilleAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set ville_associe = :ville_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'ville_associe' => $ville_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["PaysAssocie".$i]) && $_POST["PaysAssocie".$i] != $_SESSION["associe"]["PaysAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$pays_associe = $_POST["PaysAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set pays_associe = :pays_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'pays_associe' => $pays_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["NationaliteAssocie".$i]) && $_POST["NationaliteAssocie".$i] != $_SESSION["associe"]["NationaliteAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$nationalite_associe = $_POST["NationaliteAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set nationalite_associe = :nationalite_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'nationalite_associe' => $nationalite_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["TelephoneAssocie".$i]) && $_POST["TelephoneAssocie".$i] != $_SESSION["associe"]["TelephoneAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$telephone_associe = $_POST["TelephoneAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set telephone_associe = :telephone_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'telephone_associe' => $telephone_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["EmailAssocie".$i]) && $_POST["EmailAssocie".$i] != $_SESSION["associe"]["EmailAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$email_associe = $_POST["EmailAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set email_associe = :email_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'email_associe' => $email_associe,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["SommeAssocie".$i]) && $_POST["SommeAssocie".$i] != $_SESSION["associe"]["SommeAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$fond_associes = $_POST["SommeAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set fond_associes = :fond_associes where id_associe=:id_associe;");
					$requete->execute(array(
						'fond_associes' => $fond_associes,
						'id_associe' => $id_associe,
					));
					
				}

				if (isset($_POST["DateNaissanceAssocie".$i]) && $_POST["DateNaissanceAssocie".$i] != $_SESSION["associe"]["DateNaissanceAssocie".$i] && isset($_SESSION["associe"])) 
				{
					$date_naissance_associe = $_POST["DateNaissanceAssocie".$i];
					$id_associe = $_SESSION["associe"]["id_associe".$i];
					$requete = $connexion->prepare("UPDATE Associes set date_naissance_associe = :date_naissance_associe where id_associe=:id_associe;");
					$requete->execute(array(
						'date_naissance_associe' => $date_naissance_associe,
						'id_associe' => $id_associe,
					));
					
				}

			}

		}
		?>
	</form>
</div>
<?php
deConnexionMysqlBdd($connexion);
?>