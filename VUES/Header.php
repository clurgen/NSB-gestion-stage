<?php

if(session_status() == PHP_SESSION_NONE)
{
	session_start();
}
?>


<!DOCTYPE html >
<html >
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="html, css" />
	<meta name="description" content="à CHANGER!!!!!!!!" />
	<title>Vitrine des differents services proposés</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700" />
	<link rel="stylesheet" href="http://localhost/php/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://localhost/php/CSS/Header-Blue.css" />
	<link rel="stylesheet" href="http://localhost/php/CSS/Footer-Dark.css" />
	<link rel="stylesheet" href="http://localhost/php/CSS/Contact.css" />
	<link rel="stylesheet" href="http://localhost/PHP/CSS/FormeJuridique.css" />

	<link rel="stylesheet" href="CSS/Style.css" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<div class="topnav" id="myTopnav">
			<a href="#home" class="left-home active" style="font-weight: bolder;">NS-B GESTION</a>
			<div class="drop_down">
				<a href="index.php?page=menuCreationEntreprise" class="dropbtn" style="font-weight: bolder;">
					Création d'Entreprise
				</a>
				<div class="dropdown-content" role="menu">
					<div class="ligne">
						<div class="colonne">
							<a href="index.php?page=creationMonEntreprise" style="font-weight: bolder; text-decoration: underline;">Créer mon Entreprise</a>
							<a href="index.php?page=formulairesGratuits" style="font-weight: bolder; text-decoration: underline;">FormulairesGratuits</a>
							<a href="index.php?page=FAQ" style="font-weight: bolder; text-decoration: underline;">FAQ</a> 
						</div>
					</div>
				</div>
			</div>
			<div class="drop_down">
				<a href="index.php?page=domiciliation" class="dropbtn" style="font-weight: bolder;">
					Domiciliation
				</a>
				<div class="dropdown-content" role="menu">
					<div class="ligne">
						<div class="colonne">
							<a href="index.php?page=creationMonEntreprise" style="font-weight: bolder; text-decoration: underline;">Créer mon Entreprise</a>
							<a href="index.php?page=formulairesGratuits" style="font-weight: bolder; text-decoration: underline;">FormulairesGratuits</a>
							<a href="index.php?page=FAQ" style="font-weight: bolder; text-decoration: underline;">FAQ</a> 
						</div>
					</div>
				</div>
			</div>
			<div class="drop_down">
				<a href="index.php?page=location" class="dropbtn" style="font-weight: bolder;">
					Location
				</a>
				<div class="dropdown-content" role="menu" style="">
					<div class="ligne">
						<div class="colonne">
							<a href="index.php?page=creationMonEntreprise" style="font-weight: bolder; text-decoration: underline;">Créer mon Entreprise</a>
							<a href="index.php?page=formulairesGratuits" style="font-weight: bolder; text-decoration: underline;">FormulairesGratuits</a>
							<a href="index.php?page=FAQ" style="font-weight: bolder; text-decoration: underline;">FAQ</a> 
						</div>
					</div>
				</div>
			</div>
			<div class="drop_down">							  	
				<a href="index.php?page=partenaires" class="dropbtn" role="button">
					Partenaires
				</a> 
			</div>
			
			<a href="index.php?page=seconnecter" class="login" style="font-size: 17px; padding: 10px 10px; margin: 15px;">Se Connecter</a>
			<a class="inscrire" href="index.php?page=inscription" style="font-size: 17px; padding: 10px 10px; margin: 15px;">S'inscrire</a>

			<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="headerResponsive()">&#9776;</a>
		</div>

		<script>
			function headerResponsive() {
				var x = document.getElementById("myTopnav");
				if (x.className === "topnav") {
					x.className += " responsive";
				} else {
					x.className = "topnav";
				}
			}

		</script>
