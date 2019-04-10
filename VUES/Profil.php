<?php
    require('Script/FonctionBdd.php');

    $hote="localhost";
    $bd="nsbbdd";
    $util="root";
    $mpas="";
    $connexion = connexionMysqlBdd($hote,$bd, $util, $mpas);

    if(isset($_SESSION['membre_id']))
    {
        $requete = $connexion -> prepare("select * from Users where id_user = ?");
        $requete -> execute(array($_SESSION['membre_id']));
        $resultat = $requete -> fetch();
        $Nmembre = $requete -> rowCount();

        if(isset($resultat) AND isset($Nmembre) AND $Nmembre == 1)
        {
     
            try
            {
                $requser = $connexion -> prepare("SELECT * FROM dossiers WHERE id_user = ?;");
                $idmembre = $resultat['id_user'];
                $requser -> execute(array($idmembre));
                $userexist = $requser -> rowCount();

                $resultat_dossier = $requser -> fetch();

            }
            catch (PDOException $e)
            {  
                //Gestion des erreurs causées par les requêtes PDO
                echo "Échec : Not Good </br>" . $e->getMessage();
            }
?>
            <div class="contact">
                <form method="post" action="">
                    <h2 class="text-center">Mes Dossiers</h2>
                    <?php
                    if(isset($resultat_dossier) AND $resultat_dossier != 0)
                    {
                        while($resultat_dossier)
                        {

                            try
                            {
                                $reqsociete = $connexion -> prepare("SELECT * FROM societes WHERE id_societe = ?;");
                                $idsociete = $resultat['id_societe'];
                                $requser -> execute(array($idsociete));

                                $resultat_societe = fetch();

                            }
                            catch (PDOException $e)
                            {  
                                //Gestion des erreurs causées par les requêtes PDO
                                echo "Échec : Not Good </br>" . $e->getMessage();
                            }

                            if(isset($resultat_societe)  AND $resultat_dossier != 0)
                            {
                                echo "<h5>Dossier : ".$resultat_societe['nom_societe']."</h5>";
                                echo '<div class="form-group" style="margin-top: 1rem;">';
                                echo "</div></br>";

                            }
                            $resultat_dossier = $requser -> fetch();
                        }
                    }
                    else
                    {
                        echo '<div class="form-group text-center" style="margin-top: 1rem;">';
                        echo "Vous n'avez pas de dossier</br>";
                        echo '<a href="index.php?page=menuCreationEntreprise">Créer un dossier</a>';
                        echo "</div></br>";
                    }
                    ?>     
                    
                </form>
            </div>
<?php
        }
        else
        {
            header('Location:index.php?page=seconnecter');
        }
    }
    else
    {
        header('Location:index.php?page=seconnecter');
    }
?>
