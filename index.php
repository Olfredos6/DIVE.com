<?php
session_start();
$_SESSION['user']='';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>D i v e . c o m|A c c u e i l</title>
<link href="design.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#F8F8F8">
<table width="700" align="center">
  <tr>
    <td>
    <img src="dive.jpg" width="699" height="85"  align="center" />
    </td>
  </tr>
</table>
<table width="700" align="center">
  <tr>   
  <td width="510" >
  <p align="justify">
Bienvenue sur DiVE. Ceci est une  plate-forme de partage d'informations en temps réels à travers le monde a toute personne inscrite sur le site. Partager donc toutes événements qui ont lieu dans votre quartier, votre ville, votre pays, votre continent, bref, toutes les infos du milieu qui vous entoure à fin de tenir le monde au courant de tout ce qui se passe au travers le monde..
  </p>
  </td>
    <td width="1"><table width="190" bgcolor="#CCCCCC">
        <tr>
    <td>
<?php 
//PHP vars d'avertissement
$echoIncorrect='';  
//PHP de connection
//Apres click sur le boutton Ok, on se connecte a la BD et on verifie les infos
if(isset($_POST['coRequest'])){
	//On pecho les values des 2 champs
	$coPseudo=$_POST['userPseudo'];
	$coPass=$_POST['userKeyWord'];
	
	//On verifie qu'ils ne sont pas vides
	if($coPseudo=='' || $coPass==''){$echoIncorrect="( Pseudo ou Mot de passe Incrorrecte, veuillez reessayer s.v.p )";}
	//Sinon, on se connecte a la BD pour verifier
	else{
		$conectionBd = new PDO('mysql:host=127.0.0.1;dbname=divebase','root','');
		$req=$conectionBd->prepare('select userPwd from userTableList where userPseudo = ?');
		$req->execute(array($coPseudo));
		$rr=$req->fetch();
		//echo $rr['userPwd'];
		if($rr['userPwd']==$coPass){
			header("Location:membre.php");
			$req->closeCursor();
			$_SESSION['user']=$coPseudo;
		}
		else{$echoIncorrect="( Pseudo ou Mot de passe Incrorrecte, veuillez reessayer s.v.p )";}
		}
	}
echo '<form action="index.php" method="post">
    	<span>'.$echoIncorrect.'</span>
		<p>Pseudo<br />
        <input type="text" name="userPseudo" maxlength="" /><br/>
        Mot de Passe<br />
  		<input type="password" name="userKeyWord" maxlenght="16" />
  		<input type="submit" value="Ok" name="coRequest" /><br />';
 ?>
  		<a href="">Mot de Passe Oublié</a><br />
        <a href="">Inviter des amis</a></p>
    </form><p></p>
    </td>
  </tr>
</table>
</td>

  </tr>
</table>
<table width="697" align="center">
  <tr>
    <td width="498">

    </td>
    <td width="187" bgcolor='#EEEEEE'>   
           
<?php 
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

//Les vars d'echeque d'isncription
$echoNom="";
$echoPrenom="";
$echoPseudo="";
$echoPass="";
$echoVerifPass="";
$echoMail="";
$echoCond="";
//Les vars du formulaire
$nom="";
$prenom="";
$pseudo="";	
$pwd="";
$copwd="";
$pays="";
$ville="";
$commune="";
$mail="";	

if(isset($_POST['condbox']) && isset($_POST['valider'])){
	
	$nom=$_POST['name'];
	$prenom=$_POST['prenom'];
	$pseudo=$_POST['pseudo'];
	$pwd=$_POST['pwd'];
	$copwd=$_POST['copwd'];
	$pays=$_POST['pays'];
	$ville=$_POST['ville'];
	$commune=$_POST['commune'];
	$mail=$_POST['mail'];
	@$luCond=$_POST['condbox'];
	//Verification de la validitE du formulaire

	if($nom==''){$echoNom="Veuillez entré un nom correct";}
	if($prenom==''){$echoPrenom="Veuillez entré un Prenom correct";}
	if($pseudo==''){$echoPseudo="Veuillew entré un Pseudo correct";}
	if($pwd==''){$echoPass="Veuillez entré un mot de passe correct";}
	if($pwd!=$copwd){$echoVerifPass="Ne correspond pas à votre mot de passe";}
	if($mail=='@' or $mail==''){$echoMail="L'adrees e-mail n'est pas valide";}
	if(!$luCond){$echoCond="Vous devez prendre connaissance des conditions d'utilisations et cocher cette case";}

if($echoNom=="" && $echoPrenom=="" && $echoPseudo=="" && $echoPass=="" && $echoVerifPass=="" && $echoMail==""&& $echoCond==""){
		//Si toutes ces betes variables sont nuls, on se connecte a la base et hop!!!
				
				$conectionBd = new PDO('mysql:host=127.0.0.1;dbname=divebase','root','');
				$req = $conectionBd->prepare('INSERT INTO userTableList(userNom,userPrenom,userPseudo,userPwd,userPays,userVille,userCommune,userMail) VALUES (:userNom,:userPrenom,:userPseudo,:userPwd,:userPays,:userVille,:userCommune,:userMail)');
				$req->execute(array(
				'userNom' => $nom,
				'userPrenom' =>$prenom,
				'userPseudo' =>$pseudo,
				'userPwd' =>$pwd,
				'userPays' =>$pays,
				'userVille' =>$ville,
				'userCommune' =>$commune,
				'userMail' =>$mail
				));
				this.header("Location:membre.php");
	}//fin du Else 
}//fin du ifGrand

if(!isset($_POST['condbox']) && isset($_POST['valider'])){
	$echoCond="Vous devez prendre connaissance des conditions d'utilisations et cocher cette case";
	
	$nom=$_POST['name'];
	$prenom=$_POST['prenom'];
	$pseudo=$_POST['pseudo'];
	$pwd=$_POST['pwd'];
	$copwd=$_POST['copwd'];
	$pays=$_POST['pays'];
	$ville=$_POST['ville'];
	$commune=$_POST['commune'];
	$mail=$_POST['mail'];
	@$luCond=$_POST['condbox'];
	//Verification de la validitE du formulaire

	if($nom==''){$echoNom="Veuillez entré un nom correct";}
	if($prenom==''){$echoPrenom="Veuillez entré un Prenom correct";}
	if($pseudo==''){$echoPseudo="Veuillew entré un Pseudo correct";}
	if($pwd==''){$echoPass="Veuillez entré un mot de passe correct";}
	if($pwd!=$copwd){$echoVerifPass="Ne correspond pas à votre mot de passe";}
	if($mail=='@' or $mail==''){$echoMail="L'adrees e-mail n'est pas valide";}
	if(!$luCond){$echoCond="Vous devez prendre connaissance des conditions d'utilisations et cocher cette case";}	
	}

/*Formulaire*/
	echo '
        <form name="registration" action="index.php" method="post">
    		<p><b><u> Inscription rapide et gratuite</u></b><br/>
    		Nom (50 caract.)<br /><input type="text" name="name"><br /><span>'.$echoNom.'</span>
    		Prenom (50 caract.)<br /><input type="text" name="prenom" maxlength="" /><br /><span>'.$echoPrenom.'</span>
    		Pseudo du compte (30 caract.)<br /><input type="text" name="pseudo" maxlength="" width="" /><br /><span>'.$echoPseudo.'</span>
    		Mot de passe (25 caract.)<br /><input type="text" name="pwd" maxlength="" width="" /><br /><span>'.$echoPass.'</span>
    		Confirmez le mot de passe <br /><input type="text" name="copwd" maxlength="" width="" /><br/><span>'.$echoVerifPass.'</span>
    		<br />
    		Adresse e-mail <br /><input type="text" name="mail" value="@"/><br /><span>'.$echoMail.'</span>
    		<br />Pays<br /><input type="text" name="pays"  /><br />
    		Ville <br /><input type="text" name="ville"  /><br />
    		Commune(ou equivalent)<br /><input type="text" name="commune" /><br /><span>'.$echoCond.'</span>
			<input type="checkbox" name="condbox" />J\'ai lus et acceptes les<a herf="conditions.html"> conditions </a>d\'utilisations.<br /><br />
    		<input type="submit" value="Valider" name="valider" /><input type="reset" value="Effacer"/>
     		</p>
	</form>
	'; 
/*Fin Formulaire*/	
	?>
    </td>
  </tr>
</table>
<br />
<!--Nombres de membres inscrits-->
<?php 
$conectionBd = new PDO('mysql:host=127.0.0.1;dbname=divebase','root','');
//$req=$conectionBd->query('select id from usertablelist where userPwd="magema"');
$req=$conectionBd->query('select max(id) as nombre from usertablelist');
$rr=$req->fetch();
echo '<p align="center" style="color:green">Aujourd\'hui, déjà '.$rr['nombre'].' membres</p>';
$req->closeCursor();
?>
<p align="center"> TASIZ & Co. © Copyright 2013 - BALUKIDI NEHEMIE</p>
<!-- Fin -->
</body>
</html>