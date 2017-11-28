<?php



try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet_autoroutes;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if (isset($_POST['submit_ajout'])) {
	if(!empty($_POST['codA']) AND !empty($_POST['vitesse']) AND !empty($_POST['etat']) AND !empty($_POST['distance']))
	{
		$codA = htmlspecialchars(POST_secure('codA'));
		$vitesse = htmlspecialchars(POST_secure('vitesse'));
		$etat = htmlspecialchars(POST_secure('etat'));
		$distance = htmlspecialchars(POST_secure('distance'));
		$cout = htmlspecialchars(POST_secure('cout'));

		$verification = $bdd->prepare('SELECT * FROM troncons WHERE codA = ? AND vitesse_moyenne = ? AND etat = ? AND distance = ? AND cout = ?');
		$verification->execute(array($codA, $vitesse, $etat, $distance, $cout));
		$verification_exist = $verification->rowCount();

		if ($verification_exist == 0) {
			$insert = $bdd->prepare('INSERT INTO troncons (codA, vitesse_moyenne, etat, distance, cout) VALUES(?, ?, ?, ? , ?)');
			$insert->execute(array($codA, $vitesse, $etat, $distance, $cout));
			$erreur = "Creation du nouvel proprietaire reussie";
		}

		else
		{
			$erreur = "Erreur : Ce troncon existe deja !";
		}

		
	}

	else{
		$erreur = "Erreur: Tous les champs doivent etre completes.";
	}
}

?>
<form method="POST">
	<label for="Ajout">Ajout d'un troncon :</br></br></label>
	<table>
		<label for="codA">Quelle autoroute appartient ce troncon ? </label>
								<select name="codA">

									<?php
 
										$reponse = $bdd->query('SELECT codA FROM autoroutes');
										 
										while ($donnees = $reponse->fetch())
										{
										?>
										           <option value="<?php echo $donnees['codA']; ?>"> <?php echo $donnees['codA']; ?></option>
										<?php
										}
										 
										?>
								</select>
		<tr>
			<td align="right"><label for="vitesse">Entrer la vitesse moyenne du troncon :</label></td>
			<td><input type="number" step="any" name="vitesse"/></td>
		</tr>
		<tr>
			<td align="right"><label for="etat">Dans quel etat se trouve actuellement le troncon (1 : bon, 2 : accidente, 3 : en travaux, 4 : ferme):</label></td>
			<td><input type="number" name="etat"/></td>
		</tr>
		<tr>
			<td align="right"><label for="distance">Entrer sa distance :</label></td>
			<td><input type="number" step="any" name="distance"/></td>
		</tr>
		<tr>
			<td align="right"><label for="cout">Entrer le cout du peage qui se trouve sur ce troncon sinon entrer 0 s'il n'y en a pas :</label></td>
			<td><input type="number" step="any" name="cout"/></td>
		</tr>
	</table>
	<br/><br/>

	<input type="submit" value="Ajouter" name="submit_ajout" />
</form>

<?php if (isset($erreur)) {
						echo ($erreur);
					} ?>