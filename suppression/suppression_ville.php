
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
	if (!empty($_POST['nom'])) {
		$nom = htmlspecialchars(POST_secure('nom'));
		$Suppression = $bdd->prepare('DELETE FROM villes WHERE ville = ?');
		$Suppression->execute(array($nom));
		$erreur = "Suppression de la ville reussie";
	}

	else{
		$erreur = "Erreur: Aucune ville n'a ete saisie.";
	}
}
?>




<form method="POST">
<fieldset>
	<label for="Ajout">Suppression d'une ville :</br></br></label>
			<label for="nom">Quelle ville souhaitez-vous supprimer de la base de donnees ?</label>
			<select name="nom">

									<?php
 
										$reponse = $bdd->query('SELECT ville FROM villes');
										 
										while ($donnees = $reponse->fetch())
										{
										?>
										           <option value="<?php echo $donnees['ville']; ?>"> <?php echo $donnees['ville']; ?></option>
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
