
<br>
<a href="./index.php?Page=Acceuil">Retour Affichage globale</a>

<?php


echo "modif ville";
update_ville(1,2,1);
modifier_ville(1,2,1);


function modifier_ville($codT,$codA,$COD_sortie)
{
$bdd=ouverture_BDD_Admin();

    $nom=select_multiple($bdd,"villes","codT=".$codT." AND codA=".$codA." AND COD_sortie=".$COD_sortie,"ville") ;


    
    
    
echo '<div class="inscription">
    <table>
    <form method="POST">
			<fieldset>
                <legend><span style="text-decoration: underline">Modification d une école :</span></legend>
						
							<tr>
								<td align="right"><label for="Nom">ville :</label></td>
								<td><input type="text" name="nom" value="'.$nom.'"/></td>
							</tr>
							<tr>
								<td align="right"><label for="Mail">Code postale :</label></td>
								<td><input type="number" min="0" max="200" name="codT" value="'.$codT.'"/></td>
							</tr>
							<tr>
								<td align="right"><label for="mdp2">$codT :</label></td>
								<td><input type="number" min="0" max="200" name="codA"  value="'.$codA.'"/></td>
							</tr>
							<tr>
								<td align="right"><label for="mdp2">$COD_sortie :</label></td>
								<td><input  type="number" min="0" max="200" name="COD_sortie" value="'.$COD_sortie.'"/></td>
							</tr>
							 <tr>
                                <td><input id="bouton" type="submit" value="Mettre à jour" name="submit_ajout" /></td>
                        </tr>
							 

				</fieldset>
	    </form>
	    </table>
	    </div>';

}

function update_ville($ocodA,$oCodT,$oCOD_sortie)
{
    $bdd=ouverture_BDD_Admin();

    if(POST_secure("codA") && POST_secure("nom") && POST_secure("codT") && POST_secure("codT"))
    {
    $codA=POST_secure("codA");
    $nom=POST_secure("nom");
    $codT=POST_secure("codT");
    $COD_sortie=POST_secure("COD_sortie");

    $SQL = "UPDATE `villes` SET `COD_sortie`=".$COD_sortie.",`CodA`=".$codA.",`CodT`=".$codT.',`ville`="'.$nom.'"
            WHERE COD_sortie='.$oCOD_sortie." AND CodA=".$ocodA." AND CodT=".$oCodT;

 $SQL = "INSERT INTO `compte` (`ID`, `Mail`, `mdp`, `type`) VALUES (NULL, '".$email."', '". sha1($mdp)."', '".$type."')";

  $result = $bdd->query ($SQL);

    if (!$result)
    {die('Requête invalide Creation_Compte: ' . mysql_error());}
    else { return get_last_id($bdd,"compte");}

    }

}