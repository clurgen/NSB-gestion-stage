<?php
require('Script/FonctionBdd.php');

$hote="localhost";
$bd="nsbbdd";
$util="root";
$mpas="";
$connexion = connexionMysqlBdd($hote,$bd, $util, $mpas);


if(!isset($_SESSION['membre_id']))
{

    if(isset($_POST['subconnect']))
    {
        $mailconnect = htmlspecialchars($_POST['mailconnect']);
        $passwordconnect = htmlspecialchars($_POST['passwordconnect']);

        if(!empty($mailconnect) AND !empty($passwordconnect))
        {        
            try
            {
                $requser = $connexion -> prepare("SELECT * FROM Users WHERE nom_utilisateur = ?;");
                $requser -> execute(array($mailconnect));

                $userexist = $requser -> rowCount();
            }
            catch (PDOException $e)
            {  
                //Gestion des erreurs causées par les requêtes PDO
                echo "Échec : Not Good </br>" . $e->getMessage();
            }
            if($userexist == 1)
            {
                $userinfo = $requser -> fetch();
                if(password_verify($passwordconnect, $userinfo['password']))
                {
                    $_SESSION['membre_id'] = $userinfo['id_user'];
                    $_SESSION['mail_user'] = $userinfo['nom_utilisateur'];
                    header('Location:index.php');
                }
                else
                {
                    $erreur = "Votre mail ou votre mot de passe est incorrect.";
                    $userinfo = array();
                }
            }
            else
            {
                $erreur = "Votre mail ou votre mot de passe est incorrect.";
            }
        }
        else
        {
            $erreur="Tous les champs doivent être complétés.";
        }
    }

    ?>

    <div class="contact">
        <form method="post" action="">
            <h2 class="text-center">Se connecter</h2>
            <p>
                <?php
                    if(isset($erreur)){
                        echo '<font color="red">'.$erreur.'</font></br>';
                    }
                    if(isset($_SESSION['membre_id']) AND isset($userinfo['id']) AND $userinfo['id'] == $_SESSION['membre_id']){echo $_SESSION['membre_id'];}
                ?>
            </p>
            <h5>Entrez votre email :</h5>
            <div class="form-group" style="margin-top: 1rem;">
            	<input class="form-control" type="email" name="mailconnect" placeholder="Entrez votre email" value="<?php if(isset($mailconnect)){echo $mailconnect;}?>" />
            </div></br>

            <h5>Entrez votre mot de passe :</h5>
            <div class="form-group" style="margin-top: 1rem;">
                <input class="form-control" type="password" name="passwordconnect" placeholder="Entrez votre mot de passe" />
            </div></br>

            <div class="form-group" style="display: flow-root;">
            	<button class="btn btn-primary" name="subconnect" type="submit" style="float: right;">Je me connecte</button>
            </div>
            <a href="index.php?page=inscription" style="font-size: 20px;">S'inscrire</a>
        </form>
    </div>
<?php
}
else
{
    header('Location:index.php?page=profil');
}
?>