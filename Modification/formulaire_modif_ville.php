<?php

//$ecole_tester=POST_secure("ecole");
$ecole_tester=3;

update_ecole_admin($ecole_tester);
modifier_ecole_admin($ecole_tester);



function modifier_ecole_admin($ID)
{
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet_autoroute;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$nom_ville=select($bdd,"villes","ville",$ID,"ville");
$codA=select($bdd,"villes","ville",$ID,"codA");
$codT=select($bdd,"villes","ville",$ID,"codT");
$sortie=select($bdd,"villes","ville",$ID,"COD_sortie");

echo '<div class="inscription">
    <table>
    <form method="POST">
			<fieldset>
                <legend><span style="text-decoration: underline">Modification d une école :</span></legend>
						
							<tr>
								<td align="right"><label for="Nom">Nom de l ecole :</label></td>
								<td><input type="text" name="Nom_etablissement" value="'.$nom_ecole.'"/></td>
							</tr>
							<tr>
								<td align="right"><label for="Mail">Code postale :</label></td>
								<td><input type="number" min="10001" max="99999" name="code_Postal" value="'.$code_postale.'"/></td>
							</tr>
							<tr>
								<td align="right"><label for="mdp2">Adresse :</label></td>
								<td><input type="text" name="adresse" value="'.$adresse.'"/></td>
							</tr>
							 <tr>
                                <td><input id="bouton" type="submit" value="Mettre à jour" name="submit_ajout" /></td>
                        </tr>
							 

				</fieldset>
	    </form>
	    </table>
	    </div>';

}

function update_ecole_admin($ID)
{
    try
{
    $bdd = new PDO('mysql:host=localhost;dbname=projet_autoroute;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

function POST_secure($name)
{   
    return filter_input(INPUT_POST,$name, FILTER_SANITIZE_STRING);
}


    if(POST_secure("Nom_etablissement") && POST_secure("code_Postal") && POST_secure("adresse"))
    {
        

    $Nom_etablissement=POST_secure("Nom_etablissement");
    $code_Postal=POST_secure("code_Postal");
    $adresse=POST_secure("adresse");

    $SQL = "UPDATE `ecole` SET `Nom_etablissement`='".$Nom_etablissement."',`code_Postal`=".$code_Postal.",`adresse`='".$adresse."' WHERE ID=".$ID;

    //$SQL = "INSERT INTO `compte` (`ID`, `Mail`, `mdp`, `type`) VALUES (NULL, '".$email."', '". sha1($mdp)."', '".$type."')";

    $result = $bdd->query ($SQL);

    if (!$result)
    {die('Requête invalide Creation_Compte: ' . mysql_error());}
    else
    {
        return get_last_id($bdd,"compte");
    }

    }

}

function select($data_base,$table,$champ_filtre,$valeur,$champ_sortie)
{
    if($champ_filtre=="mdp"){return false;}

    $SQL='SELECT '.$champ_sortie.' from '.$table.' where '.$champ_filtre.'="'.$valeur.'"';
   
    if ($result = $data_base->query($SQL))
    {while ($row = $result->fetch_row())
    { if(isset($row[0])){return $row[0];};}
    }
    else
    {echo "requete fail SQL :".$SQL."<br>";}


    echo $SQL;
    return false;

}