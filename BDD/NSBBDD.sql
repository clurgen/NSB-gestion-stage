drop database if exists NSBBDD;
create database NSBBDD;
	USE NSBBDD


	/* création des tables */

	create table LesPays(
		id_les_pays int NOT NULL auto_increment,
		pays varchar(255),
		Primary Key(id_les_pays)
	)ENGINE=InnoDB;

	create table Dossiers(
		id_dossier int NOT NULL auto_increment,
		delai_de_creation varchar(255),
		id_societe int,
		gerant_societe int,
		id_user int,
		Primary Key (id_dossier)
	)ENGINE=InnoDB;

	create table Associes(
		id_associe int NOT NULL auto_increment,
		nom_associe varchar(255),
		nom_naissance_associe varchar(255),
		prenom_associe varchar(255),
		sexe_associe varchar(10),
		lieu_naissance_associe varchar(255),
		date_naissance_associe date,
		adresse_associe varchar(255),
		code_postal_associe int,
		ville_associe varchar(255),
		pays_associe varchar(255),
		nationalite_associe varchar(55),
		telephone_associe varchar(20) ,
		email_associe varchar(255),
		fond_associes int,
		id_societe int,
		gerant_societe boolean,
		Primary Key (id_associe),
		CONSTRAINT UC_Associes UNIQUE (telephone_associe,email_associe)	
	)ENGINE=InnoDB;

	create table Activites (
		id_activite int NOT NULL auto_increment,
		libelle_activite varchar(255),
		id_secteur int NOT NULL,
		Primary Key (id_activite)
	)ENGINE=InnoDB;

	create table SecteurDActivites(
		id_secteur_d_activite int NOT NULL auto_increment,
		libelle_secteur_d_activite varchar(255),
		Primary Key (id_secteur_d_activite)
	)ENGINE=InnoDB;

	create table RegimesFiscaux(
		id_regime_fiscal int NOT NULL auto_increment,
		libelle_regime_fiscal varchar(255),
		Primary Key (id_regime_fiscal)
	)ENGINE=InnoDB;

	create table Societes(
		id_societe int NOT NULL auto_increment,
		nom_societe varchar(255),
		forme_juridique_societe varchar(55),
		regime_fiscal_societe varchar(2),
		statut_social_societe varchar(25),
		secteur_d_activite_societe varchar(255),
		activite_societe varchar(255),
		description_activite_societe text,
		duree_vie_societe int,
		adresse_societe varchar(255),
		code_postal_societe int,
		ville_societe varchar(255),
		pays_societe varchar(255),
		Primary Key (id_societe),
		CONSTRAINT UC_Societes UNIQUE (nom_societe)
	)ENGINE=InnoDB;

	create table Users(
		id_user int NOT NULL auto_increment,
		nom_utilisateur varchar(255),
		password varchar(255),
		confirmation_token varchar(60),
		confirmed_at date,
		reset_token varchar(60),
		reset_at date,
		Primary Key(id_user)
	)ENGINE=InnoDB;


	/* Ajout des clés étrangères */

	alter table Associes
	add constraint fk_Associes_Societes 
	foreign Key (id_societe) 
	references Societes (id_societe);

	alter table Dossiers
	add constraint fk_Dossiers_Societes 
	foreign Key (id_societe) 
	references Societes (id_societe),
	add constraint fk_Dossiers_Users 
	foreign Key (id_user) 
	references Users (id_user);

	alter table Activites
	add constraint fk_Activites_SecteurDActivites 
	foreign Key(id_secteur) 
	references SecteurDActivites (id_secteur_d_activite);

	/* Verification de creation des Tables */

	describe Dossiers;
	describe Associes;
	describe Societes;
	describe Activites;
	describe SecteurDActivites;
	describe LesPays;
	describe RegimesFiscaux;


	/* Insertion des donnees avec l'ordre d'insertion*/


	INSERT INTO LesPays (pays) VALUES('France');
	INSERT INTO LesPays (pays) VALUES('Afrique du Sud');
	INSERT INTO LesPays (pays) VALUES('Afghanistan');
	INSERT INTO LesPays (pays) VALUES('Albanie');
	INSERT INTO LesPays (pays) VALUES('Algérie');
	INSERT INTO LesPays (pays) VALUES('Allemagne');
	INSERT INTO LesPays (pays) VALUES('Andorre');
	INSERT INTO LesPays (pays) VALUES('Angola');
	INSERT INTO LesPays (pays) VALUES('Antigua-et-Barbuda');
	INSERT INTO LesPays (pays) VALUES('Arabie Saoudite');
	INSERT INTO LesPays (pays) VALUES('Argentine');
	INSERT INTO LesPays (pays) VALUES('Arménie');
	INSERT INTO LesPays (pays) VALUES('Australie');
	INSERT INTO LesPays (pays) VALUES('Autriche');
	INSERT INTO LesPays (pays) VALUES('Azerbaïdjan');
	INSERT INTO LesPays (pays) VALUES('Bahamas');
	INSERT INTO LesPays (pays) VALUES('Bahreïn');
	INSERT INTO LesPays (pays) VALUES('Bangladesh');
	INSERT INTO LesPays (pays) VALUES('Barbade');
	INSERT INTO LesPays (pays) VALUES('Belgique');
	INSERT INTO LesPays (pays) VALUES('Belize');
	INSERT INTO LesPays (pays) VALUES('Bénin');
	INSERT INTO LesPays (pays) VALUES('Bhoutan');
	INSERT INTO LesPays (pays) VALUES('Biélorussie');
	INSERT INTO LesPays (pays) VALUES('Birmanie');
	INSERT INTO LesPays (pays) VALUES('Bolivie');
	INSERT INTO LesPays (pays) VALUES('Bosnie-Herzégovine');
	INSERT INTO LesPays (pays) VALUES('Botswana');
	INSERT INTO LesPays (pays) VALUES('Brésil');
	INSERT INTO LesPays (pays) VALUES('Brunei');
	INSERT INTO LesPays (pays) VALUES('Bulgarie');
	INSERT INTO LesPays (pays) VALUES('Burkina Faso');
	INSERT INTO LesPays (pays) VALUES('Burundi');
	INSERT INTO LesPays (pays) VALUES('Cambodge');
	INSERT INTO LesPays (pays) VALUES('Cameroun');
	INSERT INTO LesPays (pays) VALUES('Canada');
	INSERT INTO LesPays (pays) VALUES('Cap-Vert');
	INSERT INTO LesPays (pays) VALUES('Chili');
	INSERT INTO LesPays (pays) VALUES('Chine');
	INSERT INTO LesPays (pays) VALUES('Chypre');
	INSERT INTO LesPays (pays) VALUES('Colombie');
	INSERT INTO LesPays (pays) VALUES('Comores');
	INSERT INTO LesPays (pays) VALUES('Corée du Nord');
	INSERT INTO LesPays (pays) VALUES('Corée du Sud');
	INSERT INTO LesPays (pays) VALUES('Costa Rica');
	INSERT INTO LesPays (pays) VALUES('Côte d’Ivoire');
	INSERT INTO LesPays (pays) VALUES('Croatie');
	INSERT INTO LesPays (pays) VALUES('Cuba');
	INSERT INTO LesPays (pays) VALUES('Danemark');
	INSERT INTO LesPays (pays) VALUES('Djibouti');
	INSERT INTO LesPays (pays) VALUES('Dominique');
	INSERT INTO LesPays (pays) VALUES('Égypte');
	INSERT INTO LesPays (pays) VALUES('Émirats arabes unis');
	INSERT INTO LesPays (pays) VALUES('Équateur');
	INSERT INTO LesPays (pays) VALUES('Érythrée');
	INSERT INTO LesPays (pays) VALUES('Espagne');
	INSERT INTO LesPays (pays) VALUES('Estonie');
	INSERT INTO LesPays (pays) VALUES('États-Unis');
	INSERT INTO LesPays (pays) VALUES('Éthiopie');
	INSERT INTO LesPays (pays) VALUES('Fidji');
	INSERT INTO LesPays (pays) VALUES('Finlande');
	INSERT INTO LesPays (pays) VALUES('Gabon');
	INSERT INTO LesPays (pays) VALUES('Gambie');
	INSERT INTO LesPays (pays) VALUES('Géorgie');
	INSERT INTO LesPays (pays) VALUES('Ghana');
	INSERT INTO LesPays (pays) VALUES('Grèce');
	INSERT INTO LesPays (pays) VALUES('Grenade');
	INSERT INTO LesPays (pays) VALUES('Guatemala');
	INSERT INTO LesPays (pays) VALUES('Guinée');
	INSERT INTO LesPays (pays) VALUES('Guinée équatoriale');
	INSERT INTO LesPays (pays) VALUES('Guinée-Bissau');
	INSERT INTO LesPays (pays) VALUES('Guyana');
	INSERT INTO LesPays (pays) VALUES('Haïti');
	INSERT INTO LesPays (pays) VALUES('Honduras');
	INSERT INTO LesPays (pays) VALUES('Hongrie');
	INSERT INTO LesPays (pays) VALUES('Îles Cook');
	INSERT INTO LesPays (pays) VALUES('Îles Marshall');
	INSERT INTO LesPays (pays) VALUES('Indonésie');
	INSERT INTO LesPays (pays) VALUES('Irak');
	INSERT INTO LesPays (pays) VALUES('Iran');
	INSERT INTO LesPays (pays) VALUES('Irlande');
	INSERT INTO LesPays (pays) VALUES('Islande');
	INSERT INTO LesPays (pays) VALUES('Israël');
	INSERT INTO LesPays (pays) VALUES('Italie');
	INSERT INTO LesPays (pays) VALUES('Jamaïque');
	INSERT INTO LesPays (pays) VALUES('Japon');
	INSERT INTO LesPays (pays) VALUES('Jordanie');
	INSERT INTO LesPays (pays) VALUES('Kazakhstan');
	INSERT INTO LesPays (pays) VALUES('Kenya');
	INSERT INTO LesPays (pays) VALUES('Kirghizistan');
	INSERT INTO LesPays (pays) VALUES('Kiribati');
	INSERT INTO LesPays (pays) VALUES('Koweït');
	INSERT INTO LesPays (pays) VALUES('Laos');
	INSERT INTO LesPays (pays) VALUES('Lesotho');
	INSERT INTO LesPays (pays) VALUES('Lettonie');
	INSERT INTO LesPays (pays) VALUES('Liban');
	INSERT INTO LesPays (pays) VALUES('Liberia');
	INSERT INTO LesPays (pays) VALUES('Libye');
	INSERT INTO LesPays (pays) VALUES('Liechtenstein');
	INSERT INTO LesPays (pays) VALUES('Lituanie');
	INSERT INTO LesPays (pays) VALUES('Luxembourg');
	INSERT INTO LesPays (pays) VALUES('Macédoine');
	INSERT INTO LesPays (pays) VALUES('Madagascar');
	INSERT INTO LesPays (pays) VALUES('Malaisie');
	INSERT INTO LesPays (pays) VALUES('Malawi');
	INSERT INTO LesPays (pays) VALUES('Maldives');
	INSERT INTO LesPays (pays) VALUES('Mali');
	INSERT INTO LesPays (pays) VALUES('Malte');
	INSERT INTO LesPays (pays) VALUES('Maroc');
	INSERT INTO LesPays (pays) VALUES('Maurice');
	INSERT INTO LesPays (pays) VALUES('Mauritanie');
	INSERT INTO LesPays (pays) VALUES('Mexique');
	INSERT INTO LesPays (pays) VALUES('Micronésie');
	INSERT INTO LesPays (pays) VALUES('Moldavie');
	INSERT INTO LesPays (pays) VALUES('Monaco');
	INSERT INTO LesPays (pays) VALUES('Mongolie');
	INSERT INTO LesPays (pays) VALUES('Monténégro');
	INSERT INTO LesPays (pays) VALUES('Mozambique');
	INSERT INTO LesPays (pays) VALUES('Namibie');
	INSERT INTO LesPays (pays) VALUES('Népal');
	INSERT INTO LesPays (pays) VALUES('Nicaragua');
	INSERT INTO LesPays (pays) VALUES('Niger');
	INSERT INTO LesPays (pays) VALUES('Nigeria');
	INSERT INTO LesPays (pays) VALUES('Niue');
	INSERT INTO LesPays (pays) VALUES('Norvège');
	INSERT INTO LesPays (pays) VALUES('Nouvelle-Zélande');
	INSERT INTO LesPays (pays) VALUES('Oman');
	INSERT INTO LesPays (pays) VALUES('Ouganda');
	INSERT INTO LesPays (pays) VALUES('Ouzbékistan');
	INSERT INTO LesPays (pays) VALUES('Pakistan');
	INSERT INTO LesPays (pays) VALUES('Palaos');
	INSERT INTO LesPays (pays) VALUES('Palestine');
	INSERT INTO LesPays (pays) VALUES('Panama');
	INSERT INTO LesPays (pays) VALUES('Papouasie-Nouvelle-Guinée');
	INSERT INTO LesPays (pays) VALUES('Paraguay');
	INSERT INTO LesPays (pays) VALUES('Pays-Bas');
	INSERT INTO LesPays (pays) VALUES('Pérou');
	INSERT INTO LesPays (pays) VALUES('Philippines');
	INSERT INTO LesPays (pays) VALUES('Pologne');
	INSERT INTO LesPays (pays) VALUES('Portugal');
	INSERT INTO LesPays (pays) VALUES('Qatar');
	INSERT INTO LesPays (pays) VALUES('République centrafricaine');
	INSERT INTO LesPays (pays) VALUES('République démocratique du Congo');
	INSERT INTO LesPays (pays) VALUES('République Dominicaine');
	INSERT INTO LesPays (pays) VALUES('République du Congo');
	INSERT INTO LesPays (pays) VALUES('République tchèque');
	INSERT INTO LesPays (pays) VALUES('Roumanie');
	INSERT INTO LesPays (pays) VALUES('Royaume-Uni');
	INSERT INTO LesPays (pays) VALUES('Rwanda');
	INSERT INTO LesPays (pays) VALUES('Saint-Kitts-et-Nevis');
	INSERT INTO LesPays (pays) VALUES('Saint-Vincent-et-les-Grenadines');
	INSERT INTO LesPays (pays) VALUES('Sainte-Lucie');
	INSERT INTO LesPays (pays) VALUES('Saint-Marin');
	INSERT INTO LesPays (pays) VALUES('Salomon');
	INSERT INTO LesPays (pays) VALUES('Salvador');
	INSERT INTO LesPays (pays) VALUES('Samoa');
	INSERT INTO LesPays (pays) VALUES('São Tomé-et-Principe');
	INSERT INTO LesPays (pays) VALUES('Sénégal');
	INSERT INTO LesPays (pays) VALUES('Serbie');
	INSERT INTO LesPays (pays) VALUES('Seychelles');
	INSERT INTO LesPays (pays) VALUES('Sierra Leone');
	INSERT INTO LesPays (pays) VALUES('Singapour');
	INSERT INTO LesPays (pays) VALUES('Slovaquie');
	INSERT INTO LesPays (pays) VALUES('Slovénie');
	INSERT INTO LesPays (pays) VALUES('Somalie');
	INSERT INTO LesPays (pays) VALUES('Soudan');
	INSERT INTO LesPays (pays) VALUES('Soudan du Sud');
	INSERT INTO LesPays (pays) VALUES('Sri Lanka');
	INSERT INTO LesPays (pays) VALUES('Suède');
	INSERT INTO LesPays (pays) VALUES('Suriname');
	INSERT INTO LesPays (pays) VALUES('Swaziland');
	INSERT INTO LesPays (pays) VALUES('Syrie');
	INSERT INTO LesPays (pays) VALUES('Tadjikistan');
	INSERT INTO LesPays (pays) VALUES('Tanzanie');
	INSERT INTO LesPays (pays) VALUES('Tchad');
	INSERT INTO LesPays (pays) VALUES('Thaïlande');
	INSERT INTO LesPays (pays) VALUES('Timor oriental');
	INSERT INTO LesPays (pays) VALUES('Togo');
	INSERT INTO LesPays (pays) VALUES('Tonga');
	INSERT INTO LesPays (pays) VALUES('Trinité-et-Tobago');
	INSERT INTO LesPays (pays) VALUES('Tunisie');
	INSERT INTO LesPays (pays) VALUES('Turkménistan');
	INSERT INTO LesPays (pays) VALUES('Turquie');
	INSERT INTO LesPays (pays) VALUES('Tuvalu');
	INSERT INTO LesPays (pays) VALUES('Ukraine');
	INSERT INTO LesPays (pays) VALUES('Uruguay');
	INSERT INTO LesPays (pays) VALUES('Vanuatu');
	INSERT INTO LesPays (pays) VALUES('Vatican');
	INSERT INTO LesPays (pays) VALUES('Venezuela');
	INSERT INTO LesPays (pays) VALUES('Viêt Nam');
	INSERT INTO LesPays (pays) VALUES('Yémen');
	INSERT INTO LesPays (pays) VALUES('Zambie');
	INSERT INTO LesPays (pays) VALUES('Zimbabwe');

	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ("JE NE TROUVE PAS MON SECTEUR D'ACTIVITÉ");
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('AGROALIMENTAIRE / RESTAURATION');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('ARTS / MULTIMÉDIA / DESSIN / PHOTOGRAPHIE');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('ASSURANCE / BANQUE / CONSEIL / FINANCE ');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('AUTOMOBILE, CYCLES ET MOTOCYCLES');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('BTP / AMÉNAGEMENT');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('COMMERCE / E-COMMERCE / VENTE');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('HABILLEMENT / CHAUSSURE / TEXTILE / TRAVAIL DU CUIR');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('IMMOBILIER');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('INFORMATIQUE / ÉLECTRONIQUE / INTERNET / TÉLÉCOMS');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('SERVICES AUX PARTICULIERS /  COLLECTIVITÉS / ENTREPRISES');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('TOURISME');
	INSERT INTO SecteurDActivites (libelle_secteur_d_activite) VALUES ('TRANSPORTS');


	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Je ne trouve pas mon activité dans cette liste',1);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Alimentation générale',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Bar',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Boucherie',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Boulangerie',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Cafétéria',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Charcuterie',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Chef à domicile',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Chocolaterie',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Coffee-shop',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Commerce de produits alimentaires',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Épicerie',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Patisserie',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Vente de vins et spiritueux',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Restauration rapide',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Food truck',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Glacier',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Production de produits alimentaires',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Restaurant',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Vente de fruits et légumes',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ('Vente de produits bio',2);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agent d’artistes",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en communication et médias",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Edition de livres",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Galerie d'art",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Graphisme (web, 3D)",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Label de musiqueLibrairie",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location/vente d’instruments de musique",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location/vente de matériel son, lumière et vidéo",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Négoce d’objets d’arts",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Organisation d’évènements (spectacles, concerts, évènements culturels, etc)",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Photographie",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Production de contenu digital",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Production vidéo",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Spectacle vivant",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Studio d'enregistrement",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Tatoueur",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Illustrateur",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Graphiste, designer",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Édition multimédia",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Photographe profetionnel",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Marquage, Gravure",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Photographie aérienne, sous-marine",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Studio photographique",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Dessinateur technique",3);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Comptabilité / Gestion",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en communication",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en financement public",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en gestion de patrimoine",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en IT",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en logistique",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en management / stratégie",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en marketing",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en ressources humaines",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en transformation digitale",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Courtage en assurance",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Courtage en financement immobilier",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Courtier bancaire",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Courtier en assurance",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Financement immobilier",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Service d'assurances",4);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Dépannage-Remorquage",5);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Garage",5);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location de véhicules automobiles",5);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport marchandises",5);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport routier de personnes",5);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de véhicules neufs ou d’occasion",5);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de véhicules d’occasion",5);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("VTC",5);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Architecture",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Architecture d’intérieur",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Bricolage et petits travaux",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Charpentier",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Chauffage / Climatisation",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Couvreur",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Décontamination (dératisation, etc)",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Décoration d'intérieur",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Entreprise générale de bâtiment",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Installation de fibre optique",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location de matériel",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Maçonnerie et gros oeuvre",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Maître d’oeuvre",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Menuiserie",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Montage",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Nettoyage industriel",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Paysagiste",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Peinture et vitrerie",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Plomberie",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Rénovation",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Revêtement sols et murs",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Travaux d’isolation",6);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agent commercial",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Commerce de gros de produits industriels",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Commerce électronique",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Grossiste Boissons",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Import-export",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente d’articles de chasse et de pêche",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente d’articles de sport",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de véhicules",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente matériel informatique",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente par correspondance",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de textiles (vêtements, tissus, etc.)",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de produits de beauté et bien-être",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de pièces détachées de véhicules",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente et location de matériel pour le bâtiment",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente d’articles de maroquinerie",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de chaussures",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de cigarettes électroniques",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("vente d’appareils électroniques / télécommunications",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente d’équipements électroménager",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente d’articles médicaux et paramédicaux",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de décoration végétale et florale d’intérieur",7);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Appret et tannage des cuirs",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Bourellerie",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Commerce d'accessoires de voyage",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Commerce de maroquinerie",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication d'accessoires en cuir",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication de bottes en cuir",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication de bracelets / de montre en cuir",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication de gants en cuir",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication de lacets en cuir",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Reparation de chaussures et articles en cuir",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Retaille du cuir",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Broderie sur textile",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Customisation de vetements et accessoires",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication d'accessoires de coiffure en tissu",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication de tapis",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication de feutres",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication d'articles en toutes matieres textiles",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication d'articles de corderie",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication d'articles de campement en textile",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fabrication de vetements en cuir",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Broderie a facon sur vetements",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Tissage de laine",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Tissage de coton",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("fabrication de tissus traites ou enduits",8);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agence immobilière pour le commerce, l'industrie",9);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Courtier en immobilier",9);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Diagnostics immobiliers",9);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Expert en gestion de patrimoine",9);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Expert foncier, agricole",9);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Promoteur immobilier",9);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Syndic de copropriété",9);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agence immobilière",9);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location de terrains, d'autres biens immobiliers",9);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Blogueur professionnel",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("E-Commerce",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Création / maintenance de sites internet",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Édition de logiciels",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location / gestion de bases de données",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agence web",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Application pour smartphones",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conception de sites internet",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en marketing digital",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en IT / web",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Hébergeur",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Jeux vidéosLogiciel SaaS",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Portail internet",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Programmation",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Site e-commerce",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de cigarettes électroniques",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("vente d’appareils électroniques / télécommunications",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Vente de matériel informatique",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Web designer",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conception de site web, developpement, vente de solutions informatiques ",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Search engine optimization (seo)",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Consultant",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Search engine marketing (sem) optimisation de site web",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Developpeur, conception et programmation de systemes prets a l'emploi a la demande du client",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Edition, publication en ligne (bases de donnees, repertoires, listes d'adresses)",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("E learning",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Fourniture d'acces a internet (fai)",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Game designer",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Gestion de noms de domaine",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Gestion de points d'acces wifi",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Programmeur",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Web designer",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Web agency, agence de communication multimedia",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Referencement de site",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Web ergonome",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Web master",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Programmation, adaptation de logiciel",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Programmation de logiciels systemes et reseaux, d'application logicielles",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en informatique de reseaux, deploiement, maintenance et suivi",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Consultant en referencement",10);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Institut de beauté",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Coiffeur",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Détective privé, filature, enquêtes",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Entreprise de nettoyage",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Entreprise de services postaux",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Entreprise de surveillance, sécurité privée, gardiennage",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Services de recrutement en intérim",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Services d'enquête civile",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Services d'enquête industrielle",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Services funéraires, pompes funèbres",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Services de recrutement",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Aide à domicile",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Espace de jeu",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Garde d'enfants",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Jardinage / Aménagement d’extérieur",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Soutien scolaire",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Réparation de matériel électronique",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Décoration d'intérieur",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agence web",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agence de communication",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agence de recrutement / interim",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agent commercial",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Comptabilité / Gestion",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Installation de fibre optique",11);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Agence de voyages",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Hôtel, hébergement",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseil en développement touristique",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Hôtel",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location de bateaux",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Organisation d'excursions, circuits touristiques urbains en car, bus",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Camping",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Restaurant, bar",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Guide touristique",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Services d'assistance aux touristes",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Activité de promotion du tourisme",12);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Aéroport, aérodrome",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Affréteur routier",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Conseils, services dans les transports",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Coursier ",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport ferroviaire",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location d'autocars, autobus",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location d'automobiles",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location d'automobiles avec chauffeur",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location de camions, camionnettes",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location de camions avec chauffeur",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Maintenance aéronautique",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Location de véhicules légers",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport aérien de marchandises",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport en France",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport local, régional",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport maritime, fluvial",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Taxi ",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Entretien, réparation automobile, de véhicules ",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Contrôle technique automobile",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport routier de fret de proximité ",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport routier de fret interurbains",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport aérien de passagers",13);
	INSERT INTO Activites (libelle_activite,id_secteur) VALUES ("Transport par conduites",13);


	INSERT INTO RegimesFiscaux (libelle_regime_fiscal) VALUES ('IR');
	INSERT INTO RegimesFiscaux (libelle_regime_fiscal) VALUES ('IS');

