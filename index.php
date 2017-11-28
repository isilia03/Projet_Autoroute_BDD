<?php


include "structure/test_haut.php";

?>
    <a href="./index.php?Page=Acceuil">Retour Affichage globale</a>
<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   

if(isset($_GET["Page"]))
{
    switch ($_GET["Page"])
    {
        case "ajoue_ville":include "formulaires/formulaire_ajout_ville.php";break;
        case "ajoue_autoroute":include "formulaires/formulaire_autoroute.php";break;
        case "ajoue_proprietaire":include "formulaires/formulaire_proprietaire.php";break;
        case "ajoue_troncon":include "formulaires/formulaire_troncon.php";break;

        case "modification_ville":include "Modification/ville.php";break;
        case "modification_autoroute":include "Modification/ville.php";break;
        case "modification_proprietaire":include "Modification/ville.php";break;
        case "modification_troncon":include "Modification/ville.php";break;

        case "itineraire":break;




        default:

   affichage_BDD();
    echo "<br><br>----------------------------<br><br>";

    $BDD=ouverture_BDD_Admin();
    $autoroute=1;


    initialiser();
    //autoroute_accesible_autoroute($BDD,$autoroute);
    //villes_accesible_autoroute($BDD,$autoroute);

    toutes_autoroute_accesible_autoroute($BDD,$autoroute);





            break;
    }
}
else{
    affichage_BDD();
}






include "structure/test_bas.php";