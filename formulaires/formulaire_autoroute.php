<?php


try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet_autoroutes;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if (isset($_POST['submit_ajout']))
{
	if (!empty($_POST['date_debut']) AND !empty($_POST['date_fin']) ) {
		$date_debut = htmlspecialchars(POST_secure('date_debut'));
		$date_fin = htmlspecialchars(POST_secure('date_fin'));

		if ($date_debut != $date_fin)
		{
			if ($date_debut < $date_fin) {
				$verification_contract_exist = $bdd->prepare('SELECT * FROM autoroutes WHERE date_debut = ? AND date_fin = ?');
				$verification_contract_exist->execute(array($date_debut, $date_fin));
				$verification = $verification_contract_exist->rowCount();

				if ($verification == 0) {
					$insert_autoroute = $bdd->prepare('INSERT INTO autoroutes (date_debut, date_fin) VALUES(?, ?)');
					$insert_autoroute->execute(array($date_debut, $date_fin));
					$erreur = "Creation de la nouvelle autoroute reussie";
				}

				else
				{
					$erreur = "Erreur : ce contract existe deja";
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

	else{
		$erreur = "Erreur: Tous les champs doivent etre completes.";
	}
}

?>

<form method="POST">
<fieldset>
	<label for="Ajout">Ajout d'une autoroute :</br></br></label>
	<table>
		<tr>
			<td align="right"><label for="date_debut">Entrer la date de debut de contract :</label></td>
			<td><input type="date" name="date_debut"/></td>
		</tr>
		<tr>
			<td align="right"><label for="date_fin">Entrer la date de fin de contact :</label></td>
			<td><input type="date" name="date_fin"/></td>
		</tr>
	</table>
	<br/><br/>
</fieldset>
	<input type="submit" value="Ajouter" name="submit_ajout" id="submit_ajout" />
</form>