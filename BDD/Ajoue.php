<?php

/*
 *  INSERT INTO `autoroutes` (`codA`, `date_debut`, `date_fin`) VALUES (NULL, '2017-04-01', '2030-04-01'), (NULL, '2017-04-01', '2030-04-01')
 *  INSERT INTO `troncons` (`CodT`, `codA`, `vistesse_moyenne`, `etat`, `distance`, `cout`, `proprietaire`) VALUES ('', '1', '120', '1', '100', '0', '1');
 *
 */






function ajoue_proprietaire($nom,$CA,$debut_contrat,$fin_contrat)
{ $BDD=ouverture_BDD_Intranet_Admin();

    if(exist($BDD,"proprietaire","nom",$nom)){echo "nom deja pris";return;}

    $SQL="INSERT INTO `proprietaire` (`ID`, `nom`, `CA`, `debut_contrat`, `fin_contrat`) VALUES (NULL, '".$nom."', '".$CA."', '".$debut_contrat."', '".$fin_contrat."')";

    $result = $BDD->query ($SQL);

    if (!$result)
    {echo "<br>SQL : ".$SQL."<br>";
        die('<br>Requête invalide ajoue_equipe : ' . mysql_error());}
}

function ajoue_troncons()
{
    echo "ajoue_proprietaire()";
}
