<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>Projet BDD</title>
	</head>

    <?php
    include "BDD/Ouverture_BDD.php";
    include "BDD/Affichage.php";
    include "BDD/Ajoue.php";
    include "programme/developpement.php";
    include "BDD/Initialiser_BDD.php";
    include "BDD/Divers.php";

    ?>
    
    
    
	<body>
		<div id="bloc_page">
            <header>
                <div id="titre_principal">     	
                    <div id="gps">
                        <img src="image/gps.png" alt="gps" width="100" height="100"/>
                        <h1>Projet BDD Autoroute</h1>    
                    </div>
                </div>
                
                <nav>
                    <ul>
                        <li ><a href="index.php?Page=ajoue_ville">Ajout ville</a></li>
                        <li ><a href="index.php?Page=ajoue_autoroute">Ajout autoroute</a></li>
                        <li ><a href="index.php?Page=ajoue_proprietaire">Ajout proprietaire</a></li>
                        <li ><a href="index.php?Page=ajoue_troncon">Ajout troncon</a></li>
                    </ul>
                    <ul>
                        <li ><a href="index.php?Page=modification_ville">Modification ville</a></li>
                        <li ><a href="index.php?Page=modification_autoroute">Modification autoroute</a></li>
                        <li ><a href="index.php?Page=modification_proprietaire">Modification proprietaire</a></li>
                        <li ><a href="index.php?Page=modification_troncon">Modification troncon</a></li>
                    </ul>
                    <ul>
                        <li ><a href="index.php?Page=suppression_ville">Suppression ville</a></li>
                        <li ><a href="index.php?Page=suppression_autoroute">Suppression autoroute</a></li>
                        <li ><a href="index.php?Page=suppression_proprietaire">Suppression proprietaire</a></li>
                        <li ><a href="index.php?Page=suppression_troncon">Suppression troncon</a></li>
                    </ul>


                    <ul>

                        <li ><a href="index.php?Page=itineraire">Calcul de l'itinéraire le plus court</a></li>
                    </ul>
                </nav>
            </header>
            
			<div id ="délimitation">
                     <img src="image/delimitation.png" alt="delimitation des parties">
            </div>

