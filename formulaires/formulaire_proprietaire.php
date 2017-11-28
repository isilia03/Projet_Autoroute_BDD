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
	if (!empty($_POST['nom']) AND !empty($_POST['CA']) AND !empty($_POST['date_debut']) AND !empty($_POST['date_fin'])) {
		$nom = htmlspecialchars(POST_secure('nom'));
		$CA = htmlspecialchars(POST_secure('CA'));
		$date_debut = htmlspecialchars(POST_secure('date_debut'));
		$date_fin = htmlspecialchars(POST_secure('date_fin'));

		if ($date_debut != $date_fin) {
			if ($date_debut < $date_fin) {
				$verification_exist = $bdd->prepare('SELECT * FROM proprietaire WHERE nom = ? AND CA = ? AND debut_contrat = ? AND fin_contrat = ?');
				$verification_exist->execute(array($nom, $CA, $date_debut, $date_fin));
				$verification = $verification_exist->rowCount();

				if ($verification == 0) {
					$insert_proprietaire = $bdd->prepare('INSERT INTO proprietaire(nom, CA, debut_contrat, fin_contrat) VALUES (?, ?, ?, ?)');
					$insert_proprietaire->execute(array($nom, $CA, $date_debut, $date_fin));
					$erreur = "Creation du nouvel proprietaire reussie";
				}

				else
				{
					$erreur = "Erreur ce proprietaire existe deja !";
				}
			}

			else
			{
				$erreur = "Erreur: Veuillez resaisir les dates, la date de debut est trop grande par rapport a la date de fin.";
			}
		}

		else
		{
			$erreur = "Erreur: Veuillez resaisir les dates, elles sont identiques.";
		}
	}

	else
	{
		$erreur = "Erreur: Tous les champs doivent etre completes.";
	}
}
?>

<form method="POST">
	<label for="Ajout">Ajout d'un proprietaire :</br></br></label>
	<table>
		<tr>
			<td align="right"><label for="nom">Entrer le nom du proprietaire :</label></td>
			<td><input type="text" name="nom"/></td>
		</tr>
		<tr>
			<td align="right"><label for="CA">Entrer le chiffre d'affaire du proprietaire :</label></td>
			<td><input type="number" name="CA"/></td>
		</tr>
		<tr>
			<td align="right"><label for="date_debut">Entrer la date de debut du contract :</label></td>
			<td><input type="date" name="date_debut"/></td>
		</tr>
		<tr>
			<td align="right"><label for="date_fin">Entrer la date de fin de contract :</label></td>
			<td><input type="date" name="date_fin"/></td>
		</tr>
	</table>
	<br/><br/>

	<input type="submit" value="Ajouter" name="submit_ajout" />
</form>

<?php if (isset($erreur)) {
						echo ($erreur);
					} ?>