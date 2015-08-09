<?php
session_start();
//php de deconnection while y a pas d'user
if($_SESSION['user']==''){header('Location:index.php');}
$conectionBd = new PDO("mysql:host=127.0.0.1;dbname=divebase","root","");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>D i v e . c o m|A c c u e i l_Membre</title>
<link href="design.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#F8F8F8">
<table width="700" align="center">
  <tr>
    <td>
    <img src="dive.jpg" width="699" height="85"  align="center"/>
    </td>
  </tr>
</table>
<table width="700" align="center">
  <tr>
    <td>
    <?php
	//SCRIPT DE Bienvenue et DECONNEXION(aaaaahhhhh OS6 j'suis trop fort, ma tete est un PC qui programme 
    echo '<form method="get" action="membre.php"><p align="right">Bienvenue, vous êtes connecté en tant que '.$_SESSION['user'].'
		<input type="submit" name="deconect" value="se deconnecter" />
		</p></form>';//fin de l'echo
	if(isset($_GET['deconect'])){
		session_destroy();
		header('Location:index.php');
		}
	?>
    </td>
  </tr>
</table>
<table width="700" align="center">
  <tr>
    <td bgcolor="#CCCCCC"><p align="center">Publiez dès maintenant une info pour tout le monde, une info interessante.</p></td>
  </tr>
  <tr>
    <td>
 <form name="publication" action="" method="">
 <table width="715" bgcolor="#CCCCCC" >
  <tr>
    <td width="158">   
    Donnez un titre à votre info
    </td>
    <td width="545"><input type="text" name="titre" maxlength="45" /></td>
  </tr>
  <tr>
    <td>Dîtes ce qui s'y passe</td>
    <td><textarea name="description" rows="3"></textarea></td>
  </tr>
    </table>    

    <table width="715" bgcolor="#CCCCCC">
      <tr>
        <td width="345" >Inclure une image ou une video
        <input type="file" name="file">
        </td>
        <td width="358" >Publiez en tant qu'<b>anonyme</b>?
          <select name="auteur">
        <option value="Oui">Oui</option>
        <option value="Non">Non</option>
        </select>    <input type="submit" value="Publier" name="publier" />
    <input type="reset" value="Effacer" /></td>
      </tr>
    </table>
 </form>
    </td>
  </tr>
</table>
<form action="membre.php" method="post">
<table width="445" align="center" cellspacing="5">
  <tr>
    <td width="91" bgcolor="#999999" ><input type="submit" name="ttnews" value="Toutes les infos" /></td>
    <td width="113" bgcolor="#999999"><input type="submit" name="menews" value="Infos me concernant" /></td>
    <td width="89" bgcolor="#999999"><input type="submit" name="monews" value="Les plus suivies" /></td>
    <td width="92" bgcolor="#999999"><input type="submit" name="punews" value="Mes publications" /></td>
  </tr>
</table>
<table align="center">
	<tr>
    <td>
      <input type="text" name='recherche' maxlength="70" value="Trouver une infos" style="color: #CCC" />
      <input type="submit" value="Chercher" name="btFind" />
    </td>
    </tr>
    </table>
</form>

<table width="700" align="center">
  <tr>
    <td>
        <table>
        	<tr>
            	<td>
        <p align="left">
        <?php 
		//Ames sensibles, s'abstenir.
		//Ici est le script d'affichage des news sur commande de l'use
		//Commencont par afficher toutes les news(au chargement de la page et quand on click sur le btn toutes les news)
		$req=$conectionBd->query('select max(id) as idmax from usernewslist');
		$rr=$req->fetch();
		$i=$rr['idmax'];
		$a=$i;
while($a!=27){
		//On pecho la valeur de l'id max des news		
		$auteur='';$title='';$text='';$stars='';$fichier='';$dp='';
		$req2=$conectionBd->prepare('select * from usernewslist where id =?');
		@$req2->execute(array($a));
		$rr2=$req2->fetch();	
		/*
		$conectionBd = new PDO('mysql:host=127.0.0.1;dbname=divebase','root','');
		$req=$conectionBd->prepare('select userPwd from userTableList where userPseudo = ?');
		$req->execute(array($coPseudo));
		$rr=$req->fetch();
		*/
		//On attribue les valeurs a chaques variables du tableau
		$auteur=$rr2['newsAuteur'];
		$title=$rr2['titre'];
		$text=$rr2['news'];
		$stars=$rr2['etoiles'];
		$fichier=$rr2['newsFile'];
		$dp=$rr2['datePublication'];
		//On affiche
		echo'
<table width="700" cellspacing="5" bgcolor="#FFFFFF">
  <tr>
    <td>'.$title.'</td>
  </tr>
  <tr>
    <td>
	<table width="700" cellspacing="5">
      <tr>
        <td width="70" >'.$fichier.'</td>
        <td width="630">'.$auteur.'le'.$dp.'<br/>'.$text.'</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>'.$stars.' +++++++++++++++++++++ Les liens</td>
  </tr>
</table><br/>';//fin de l'echo du tableau news
//On soustraitai de 1 pour continuer la boucle
 $a=$a-1;
}//Fin du while
		?>
        </p>
        		</td>
       		</tr>
        </table>
    </td>
  </tr>
</table>

<p align="center"> TASIZ & Co. © Copyright 2013 - BALUKIDI NEHEMIE</p>

<!-- Fin -->


</body>
</html>