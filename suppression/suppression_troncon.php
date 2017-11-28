
<?php

function POST_secure($name)
{	
	return filter_input(INPUT_POST,$name, FILTER_SANITIZE_STRING);
}

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet_autoroutes;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if (isset($_POST['submit_ajout'])) {
	if (POST_secure("codA") ) {
		$codA = htmlspecialchars(POST_secure('codA'));

		$retour = htmlspecialchars(POST_secure('codA'));

		$codA=$retour/10;
		$codT=$retour%10;


		$Suppression = $bdd->prepare('DELETE FROM troncons WHERE codA = ? AND codT = ?');
	//	$Suppression->execute(array($codA, $codT));
		$erreur = "Suppression de la ville reussie ".$codA." ".$codT;
	}

	else{
		$erreur = "Erreur: Aucune autoroute n'a ete saisie . ".!POST_secure("codA") ;
	}
}
?>




<form method="POST">
<fieldset>
	<label for="Ajout">Suppression d'un troncon :</br></br></label>
			<label for="codA">Quel troncon souhaitez-vous supprimer de la base de donnees ?</label>
			<select name="codA">

									<?php
 
										$reponse = $bdd->query('SELECT codT, codA FROM troncons');
										 
										while ($donnees = $reponse->fetch())
										{
										?>
										           <option value="<?php echo $donnees['codA']; echo $donnees['codT']; ?>"> <?php echo "le troncon ".$donnees['codT']. " de l'autoroute ". $donnees['codA']; ?></option>
										<?php
										}
										 
										?>
								</select>
</fieldset>
	<input type="submit" value="Supprimer" name="submit_ajout" id="submit_ajout" />
</form>

<?php if (isset($erreur)) {
						echo ($erreur);
					} ?>