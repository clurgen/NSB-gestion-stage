<?php
require('Script/FonctionBdd.php');

$hote="localhost";
$bd="nsbbdd";
$util="root";
$mpas="";
$connexion = connexionMysqlBdd($hote,$bd, $util, $mpas);



if(!isset($_SESSION['membre_id']))
{

    if(isset($_POST['valide']))
    {
        $mail1 = htmlspecialchars($_POST['email1']);
        $mail2 = htmlspecialchars($_POST['email2']);
        
        $passwd1 = htmlspecialchars($_POST['password1']);
        $passwd2 = htmlspecialchars($_POST['password2']);

        if(!empty($_POST['email1']) AND !empty($_POST['email2']) AND !empty($_POST['password1']) AND !empty($_POST['password2']))
        {
            $maillength = strlen($mail1);

            if($maillength <= 255)
            {
                if($mail1==$mail2)
                {
                if(TRUE /*TRUE :Pour tester les mails en @127.0.0.1! filter_var($mail1, FILTER_VALIDATE_EMAIL) OR preg_match('/^[a-zA-Z0-9_.@-]$/', $mail1)*/)
                {
                    try {
                            //Requête
                        $reqmail = $connexion -> prepare("select * from Users where nom_utilisateur = ?;");
                        $reqmail->execute(array(  $mail1,
                        ));
                        $mailexist = $reqmail -> rowCount();

                    } catch (PDOException $e) {
                            //Afficher l'erreur
                        echo "Échec : Not Good </br>" . $e->getMessage();
                    }  
                    if($mailexist == 0){
                        if($passwd1==$passwd2 AND $passwd1 != null AND $mail1 != null)
                        {

                            $hash = password_hash($_POST['password1'], PASSWORD_BCRYPT);

                            try {
                                    //Requête
                                $insertMbr = $connexion -> prepare("INSERT INTO Users (nom_utilisateur, password, confirmation_token) 
                                    VALUES (?, ?, ?);");

                                $token = str_random(60);

                                $insertMbr->execute(array(  $mail1,
                                    $hash,
                                    $token
                                ));

                                $_SESSION['membre_id'] = $connexion->lastInsertId();
                                $_SESSION['mail_user'] = $mail1;

                            } catch (PDOException $e) { 
                                    //Afficher l'erreur
                                echo "Échec : Not Good </br>" . $e->getMessage();
                            }                            
                            if(isset($_SESSION['membre_id']) AND !empty($_SESSION['mail_user']) AND isset($_SESSION['mail_user']) AND $_SESSION['membre_id'] != 0)
                            {


                                $message = 'Pour valider votre compte, merci de cliquer sur se lien : http://localhost/php/index.php?page=confirme&ampid='.$_SESSION["membre_id"].'&amptoken='.$token;
                                var_dump(mail($_SESSION['mail_user'], 'Confirmation de vottre compte', $message));

                                    /*
                                    require ('PHPMailer/src/PHPMailer.php');
                                    require ('PHPMailer/src/SMTP.php');

                                    $mail = new PHPMailer\PHPMailer\PHPMailer();
                                    $mail->IsSMTP(); // enable SMTP
                                    $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                                    $mail->SMTPAuth = true; // authentication enabled
                                    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                                    $mail->Host = "smtp.yopmail.com";
                                    $mail->Port = 465; // or 587
                                    $mail->IsHTML(true);
                                    $mail->Username = "user1";
                                    $mail->Password = "";
                                    $mail->SetFrom("user1@yopmail.com");
                                    
                                    $mail->Subject = "Testing PHP Mailer with localhost";
                                    $mail->Body = "Hi,<br /><br />This system is working perfectly.";

                                    $mail->AddAddress("user2@yopmail.com");

                                    if(!$mail->Send())
                                    {
                                        echo "Message was not sent <br />PHP Mailer Error: " . $mail->ErrorInfo;
                                    }
                                    else
                                    {
                                        echo "Message has been sent";

                                    }
                                    */

                                    logged_only();

                                    exit('
                                        <div class="contact">
                                        <form method="post" action="">
                                        Votre compte a était créé. Pour pouvoir vous connecter confirmez votre compte.</br>
                                        <a href="index.php?page=profil">
                                        Me connecter
                                        </a>
                                        </form>
                                        </div>
                                        <footer>
                                        <div class="footer-dark">
                                        <div class="container">
                                        <div class="row">
                                        <div class="col-sm-6 col-md-3 item">
                                        <h3>Services</h3>
                                        <ul>
                                        <li><a href="index.php?page=menuCreationEntreprise">Création d`Entreprise</a></li>
                                        <li><a href="index.php?page=menuDomiciliation">Domiciliation</a></li>
                                        <li><a href="index.php?page=menuLocation">Location</a></li>
                                        <li><a href="#">Autres</a></li>
                                        </ul>
                                        </div>
                                        <div class="col-sm-6 col-md-3 item">
                                        <h3>A propos</h3>
                                        <ul>
                                        <li><a href="#">Qui sommes nous ?</a></li>
                                        <li><a href="index.php?page=partenaires">Nos partenaires</a></li>
                                        <li><a href="#">Équipe</a></li>
                                        <li><a href="#">Conditions générales</a></li>
                                        <li><a href="#">Mentions légales</a></li>
                                        <li><a href="index.php?page=Contact">Contactez nous</a></li>
                                        </ul>
                                        </div>
                                        <div class="col-md-6 item text">
                                        <h3>Company Name</h3>
                                        <p>Praesent sed lobortis mi. Suspendisse vel placerat ligula. Vivamus ac sem lacus. Ut vehicula rhoncus elementum. Etiam quis tristique lectus. Aliquam in arcu eget velit pulvinar dictum vel in justo.</p>
                                        </div>

                                        <div class="col item social">
                                        <a href="#"class="fa fa-facebook"></a>
                                        <a href="#" class="fa fa-twitter"></a>
                                        <a href="#" class="fa fa-snapchat"></a>
                                        <a href="#" class="fa fa-instagram"></a>
                                        </div>
                                        <p class="copyright">Company Name © 2019</p>
                                        </div>
                                        </div>
                                        </footer><!-- fin de pied -->
                                        </body>
                                        </html>

                                        ');

                                }
                                else
                                {
                                    $erreur = "Vous n'avez pas pu être inscrit à cause d'une erreur de notre côté.";

                                    logged_only();
                                }
                            }
                            else
                            {
                                $erreur="Vos mots de passes ne correspondent pas.";
                            }
                        }
                        else
                        {
                            $erreur = "Adresse mail déjà utilisée pour un autre compte.";
                        }
                    }
                    else
                    {
                        $erreur="Votre Mail n'est pas valide.";
                    }
                }
                else
                {
                    $erreur = "Vos adresses mail ne correspondent pas.";
                }
            }
            else
            {
                $erreur = " Votre mail est trop long.";
            }

        }
        else
        {
            $erreur = " Tous les champs doivent être complétés.";
        }
    }
    ?>

    <div class="contact">
        <form method="post" action="">
            <h2 class="text-center">S'inscrire</h2>
            <p>
                <?php
                if(isset($erreur)){
                    echo '<font color="red">'.$erreur.'</font>';
                }
                ?>
            </p>
            <h5>Mail :</h5>
            <div class="form-group" style="margin-top: 1rem;">
                <input class="form-control" type="email" name="email1" placeholder="Entrez votre email" value="<?php if(isset($mail1)){echo $mail1;}?>" />
            </div></br>

            <h5>Confirmation du mail :</h5>
            <div class="form-group" style="margin-top: 1rem;">
                <input class="form-control" type="email" name="email2" placeholder="Confirmez votre email" value="<?php if(isset($mail2)){echo $mail2;}?>" />
            </div></br>

            <h5>Mot de passe :</h5>
            <div class="form-group" style="margin-top: 1rem;">
                <input class="form-control" type="password" name="password1" placeholder="Entrez votre mot de passe" />
            </div></br>

            <h5>Confirmation du mot de passe :</h5>
            <div class="form-group" style="margin-top: 1rem;">
                <input class="form-control" type="password" name="password2" placeholder="Confirmez votre mot de passe" />
            </div></br>

            <div class="form-group" style="display: flow-root;">
            	<button class="btn btn-primary" name="valide" type="submit" style="float: right;">Je valide</button>
            </div>
        </form>
    </div>


    <?php
}
else
{
    header('Location:index.php?page=profil');
}
?>