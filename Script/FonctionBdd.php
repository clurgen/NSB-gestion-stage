<?php
function connexionMysqlBdd($hote,$bd, $util, $mpas){
		$PARAM_hote=$hote; 
		$PARAM_nom_bd=$bd; 
		$PARAM_utilisateur=$util; 
		$PARAM_mot_passe=$mpas; 
		try{ 
			$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
			$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}  
		catch(Exception $e){
			echo 'Erreur : '.$e->getMessage(); 
		}
		return $connexion;
	}
	// fonction deconnexion
	function deConnexionMysqlBdd($connexion){
		$connexion = null;
	}
	
	// listeJoueurs pour retourner le tableau des ocuurences de clients
	function listeClients($connexion){
		
		$requete="select * from Clients;";
		$resultats=$connexion->query($requete) ;
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		return $liste;
	}
	// recupUnJoueur pour stocker les informations du client dans le tableau associatif $_POST
	function recupUnClient($liste, $i){
	//choix de l'occurrence dans le tableau
		$ligne = $liste[$i];
	// alimentation du tableau $_POST
		$_POST["Nom"]=$ligne->nom;
		$_POST["NomNaissance"]=$ligne->nom_naissance_client;
		$_POST["Prénom"]=$ligne->prenom_client;
		$_POST["LieuNaissance"]=$ligne->lieu_naissance_client;
		$_POST["Jour"]=$ligne->date_naissance_client.DAY(); 
		$_POST["Mois"]=$ligne->date_naissance_client.MONTH(); 
		$_POST["Annee"]=$ligne->date_naissance_client.YEAR();
		$_POST["dateCreation"]=$ligne->delai_de_creation_client; 
		$_POST["NumeroEtVoie"]=$ligne->adresse_client;			
		$_POST["CodePostal"]=$ligne->code_postal_client;
		$_POST["NomJoueur"]=$ligne->ville_client;
		$_POST["Prenom"]=$ligne->pays_client;
		$_POST["Nationalite"]=$ligne->nationalite_client;
		$_POST["Telephone"]=$ligne->telephone_client;
		$_POST["Email"]=$ligne->email_client;
		$_POST["Somme"]=$ligne->fond_client;  
			// retour du tableau
		return $_POST;
	}

	function listeAssociés($connexion){
		
		$requete="select * from Associes;";
		$resultats=$connexion->query($requete) ;
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		return $liste;
	}
	// recupUnJoueur pour stocker les informations du client dans le tableau associatif $_POST
	function recupUneFormulaire($liste, $i){
	//choix de l'occurrence dans le tableau
		$ligne = $liste[$i];
	// alimentation du tableau $_POST
		$_POST["NomAssocie"]=$ligne->nomassocie;
		$_POST["NomNaissanceAssocie"]=$ligne->nom_naissance_associe;
		$_POST["PrénomAssocie"]=$ligne->prenom_associe;
		$_POST["LieuNaissanceAssocie"]=$ligne->lieu_naissance_associe;
		$_POST["JourAssocie"]=$ligne->date_naissance_associe.DAY(); 
		$_POST["MoisAssocie"]=$ligne->date_naissance_associe.MONTH(); 
		$_POST["AnneeAssocie"]=$ligne->date_naissance_associe.YEAR();
		$_POST["NumeroEtVoieAssocie"]=$ligne->adresse_associe;			
		$_POST["CodePostalAssocie"]=$ligne->code_postal_associe;
		$_POST["VilleAssocie"]=$ligne->ville_associe;
		$_POST["PaysAssocie"]=$ligne->pays_associe;
		$_POST["NationaliteAssocie"]=$ligne->nationalite_associe;
		$_POST["TelephoneAssocie"]=$ligne->telephone_associe;
		$_POST["EmailAssocie"]=$ligne->email_associe;
		$_POST["SommeAssocie"]=$ligne->fond_associe;  
			// retour du tableau
	}

	function listeFormesJuridique($connexion){
		
		$requete="select * from FormesJuridique;";
		$resultats=$connexion->query($requete) ;
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		return $liste;
	}

	// lisrePays permet de stocker les pays stockés dans la BDD dans une listes
	function listePays($connexion){
		$requete="select pays from LesPays;";
		$resultats=$connexion->query($requete) ;
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		return $liste;
	}
	// recupUnPays permet d'afficher les pays stockés dans la BDD dans les listes deroulantes correspondantes
	function recupUnPays($liste, $i){
		$ligne = $liste[$i];
		?>
		<option><?php echo utf8_encode($ligne->pays); ?></option><?php 

	}				

	function listeSecteurDActivites($connexion){
		
		$requete="select libelle_secteur_d_activite from SecteurDActivites;";
		$resultats=$connexion->query($requete) ;
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		return $liste;
	}
	// recupUnSecteurDActivite permet d'afficher les secteur d'activités stockés dans la BDD dans les listes deroulantes correspondantes
	function recupUnSecteurDActivite($liste, $i){
		$ligne = $liste[$i];
		?>
		<option><?php echo utf8_encode($ligne->libelle_secteur_d_activite); ?></option><?php 

	}	

	function listeActivite($connexion){
		
		$requete="select libelle_activite from Activites;";
		$resultats=$connexion->query($requete) ;
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		return $liste;
	}
	// recupUneActivite permet d'afficher les activités stockés dans la BDD dans les listes deroulantes correspondantes
	function recupUneActivite($liste, $i){
		$ligne = $liste[$i];
		?>
		<option><?php echo utf8_encode($ligne->libelle_activite); ?></option><?php 
	}	

	function listeRegimeFiscaux($connexion){
		
		$requete="select libelle_regime_fiscal from RegimesFiscaux;";
		$resultats=$connexion->query($requete) ;
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		return $liste;
	}
	// recupUnRegimeFiscal permet d'afficher les regimes fiscaux stockés dans la BDD dans les listes deroulantes correspondantes
	function recupUnRegimeFiscal($liste, $i){
		$ligne = $liste[$i];
		?>
		<option><?php echo $ligne->libelle_regime_fiscal; ?></option><?php 
	}

	function AfficherLaSociete ($connexion,$id_societe){
		
		$requete = $connexion->prepare("select * from societes where id_societe = :id_societe;");
		$requete->execute(array(
			'id_societe' => $id_societe
		));
		$ligne = $requete->Fetch();
		echo'<h4>Votre Societe</h4>';?><br><?php

			echo'Nom: '.$ligne['nom_societe'];?><br><?php
			echo'Forme juridique: '.$ligne['forme_juridique_societe'];?><br><?php
			echo'Regime fiscal: '.$ligne['regime_fiscal_societe'];?><br><?php
			echo'Statut social: '.$ligne['statut_social_societe'];?><br><?php
			echo'Secteur Activité: '.$ligne["secteur_d_activite_societe"];?><br><?php
			echo'Activité: '.$ligne["activite_societe"];?><br><?php
			echo'Description: '.$ligne["description_activite_societe"];?><br><?php
			echo'Durée de vie de la société: '.$ligne["duree_vie_societe"];?><br><?php
			echo'Numero et voie: '.$ligne["adresse_societe"];?><br><?php
			echo'Code Postal: '.$ligne["code_postal_societe"];?><br><?php
			echo'Ville: '.$ligne["ville_societe"];?><br><?php
			echo'Pays: '.$ligne["pays_societe"];?><br><?php
	}

	function str_random($length)
	{
		$alphabet = "0123456789AZERTYUIOPQSDFGHJKLMWXCVBNnbvcxwmlkjhgfdsqpoiuytreza";
		return substr(str_shuffle(str_repeat($alphabet, $length)),0,$length);
	}

	function logged_only()
	{
		if(session_status() == PHP_SESSION_NONE)
		{
			session_start();
		}

		if(isset($_SESSION['membre_id']) AND isset($_SESSION['mail_user']) AND !empty($_SESSION['membre_id']) AND !empty($_SESSION['mail_user']))
		{			
		    $_SESSION = array();
		    $_SESSION = [];
		    session_destroy();

		    echo "session detruite."/*.array_dump($_SESSION)*/;

		    if(isset($passwordconnect) AND !empty($passwordconnect))
		    {
		        $passwordconnect = null;
		        echo "variable detruite.";
		    }
		    if(isset($passwd1) AND !empty($passwd1) OR isset($mail1) AND !empty($mail1))
            {
                $passwd1 = null;
                $mail1 = null;
                echo "variable detruite.";
            }
		}
	}