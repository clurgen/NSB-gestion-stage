<?php
	if(isset($_SESSION['membre_id']) AND isset($_SESSION['mail_user']))
    {
     	echo $_SESSION['membre_id']."</br>";
     	echo $_SESSION['mail_user'];
     }
?>			