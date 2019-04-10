<?php
	if(session_status() == PHP_SESSION_NONE)
	{
		session_start();
	}

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	else  {
		$page = "accueil"; 
	}


	if(isset($_SESSION['membre_id']))
    {
		include ("vues/HeaderConnecter.php");
     }
    else
    {
		include ("vues/Header.php");
		
    }
?>				
	<div id="conteneur">
<?php 
		switch ($page) {
			case "accueil" :
			include ("VUES/_Menu_01/accueil.php");
			break;
			case "Contact" :
			include ("VUES/Contact.php");
			case "inscription" :
			include ("VUES/Inscription.php");
			break;
			case "seconnecter" :
			include ("VUES/SeConnecter.php");
			break;
			case "deconnexion" :
			include ("VUES/Deconnexion.php");
			break;
			case "profil" :
			include ("VUES/Profil.php");
			break;
			case "menuCreationEntreprise" :
			include ("VUES/_Menu_01/CreationEntreprise/CreationEntreprise.php");
			break;
			case "menuLocation" :
			include ("VUES/_Menu_01/Location/menuLocation.php");
			break;
			case "menuDomiciliation" :
			include ("VUES/_Menu_01/Domiciliation/menuDomiciliation.php");
			break;
			case "partenaires" :
			include ("VUES/_Menu_01/Partenaires/partenaires.php");
			break;
			case "creationMonEntreprise" :
			include ("VUES/_Menu_01/CreationEntreprise/FormulaireCreation/page1.php");
			break;
			case "domiciliation" :
			include ("VUES/_Menu_01/Domiciliation/domiciliation.php");
			break;
			case "location" :
			include ("VUES/_Menu_01/Location/location.php");
			break;
			case "formulairesGratuits" :
			include ("VUES/_Menu_01/CreationEntreprise/FormulairesGratuits/formulaireTelechargement.php");
			break;
			
		}
		?>
	</div><!-- fin de "conteneur" -->
	<footer>
		<?php
			require "vues/Footer.php";
		?>
	</footer><!-- fin de pied -->
</body>
</html>
