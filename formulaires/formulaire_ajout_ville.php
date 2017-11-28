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
	if(!empty($_POST['codA']) AND !empty($_POST['nom']) AND !empty($_POST['coT']))
	{
		$codA = htmlspecialchars(POST_secure('codA'));
		$nom = htmlspecialchars(POST_secure('nom'));
		$codT = htmlspecialchars(POST_secure('codT'));
		$COD_sortie = 1;

		$verification = $bdd->prepare('SELECT * FROM villes WHERE CodA = ? AND ville = ? AND CodT = ? ');
		$verification->execute(array($codA, $nom, $codT));
		$verif = $verification->rowCount();

		if ($verif == 0) {
			$insert = $bdd->prepare('INSERT INTO villes(ville, CodA, CodT, COD_sortie) VALUES(?, ?, ?, ?)');
			$insert->execute(array($nom, $codA, $codT, $COD_sortie));

			$erreur = "Creation de la nouvelle ville terminee";
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
		<label for="nom">Entrer le nom de la ville :</label>
			<input type="text" name="nom"/><br><br>
		
		<label for="codA">Quelle autoroute appartient cette ville ? </label>
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
								</select><br><br>

		<label for="codT">Quelle troncon appartient cette ville ? </label>
								<select name="coT">

									<?php
 
										$reponse = $bdd->query('SELECT codT FROM troncons');
										 
										while ($donnees = $reponse->fetch())
										{
										?>
										           <option value="<?php echo $donnees['codT']; ?>"> <?php echo $donnees['codT']; ?></option>
										<?php
										}
										 
										?>
								</select>
	</table>
	<br/><br/>

	<input type="submit" value="Ajouter" name="submit_ajout" />
</form>

<?php if (isset($erreur)) {
						echo ($erreur);
					} ?>