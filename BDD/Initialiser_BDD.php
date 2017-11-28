<?php

function initialiser()
{   initialiser_autoroutes();
    initialiser_proprietaire();

    initialiser_troncon();

    initialiser_changement();
    initialiser_intersection();

    initialiser_villes();
}

function clear()
{$BDD=ouverture_BDD_Admin();

$BDD->query ("TRUNCATE TABLE `autoroutes`");
$BDD->query ("TRUNCATE TABLE `changement`");
$BDD->query ("TRUNCATE TABLE `intersection`");
$BDD->query ("TRUNCATE TABLE `proprietaire`");
$BDD->query ("TRUNCATE TABLE `troncon`");
$BDD->query ("TRUNCATE TABLE `villes`");

}

function initialiser_autoroutes()
{$BDD=ouverture_BDD_Admin();
    $sql="INSERT INTO `autoroutes` (`codA`, `date_debut`, `date_fin`) VALUES";
    $sql=$sql."(1, '2017-04-01', '2030-04-01'),
                (2, '2017-04-01', '2030-04-01'),
                (3, '2017-04-01', '2030-04-01'),
                (4, '2017-04-01', '2030-04-01'),
                (5, '2017-04-01', '2030-04-01'),
                (6, '2017-04-01', '2030-04-01');";

    $result=$BDD->query ($sql);
}
function initialiser_changement()//sortie ou entrer autoroute
{$BDD=ouverture_BDD_Admin();
    $sql="INSERT INTO `changement` (`COD_sortie`, `codA`, `codT`, `position`) VALUES ";
    $sql=$sql."('1', '2', '1', '1'),
               ('2', '3', '1', '1'),
               ('3', '5', '1', '1')
               ;";

    $result=$BDD->query ($sql);
}
function initialiser_intersection()
{$BDD=ouverture_BDD_Admin();
    $sql="INSERT INTO `intersection` (`codA`, `nb_troncon`, `ID_intersection`, `debut_fin`) VALUES ";
    $sql=$sql."('6', '1', '1', '1'),
               ('1', '1', '1', '0'),
               
               ('1', '1', '2', '1'),
               ('2', '1', '2', '0'),
               
               ('2', '1', '3', '1'),
               ('3', '1', '3', '0'),
               
               ('3', '1', '4', '1'),
               ('4', '1', '4', '0'),
               
               ('4', '1', '5', '1'),
               ('5', '1', '5', '0'),
               
               ('5', '1', '6', '1'),
               ('6', '1', '6', '0');";
    $result=$BDD->query ($sql);
  }
function initialiser_proprietaire()
{$BDD=ouverture_BDD_Admin();
    $sql="INSERT INTO `proprietaire` (`ID`, `nom`, `CA`, `debut_contrat`, `fin_contrat`) VALUES";
    $sql=$sql." (1, 'Pognon', 0, '2017-04-04', '2017-04-29'),
                (2, 'troll', 0, '2017-04-01', '2030-04-26');";
    $result=$BDD->query ($sql);

}
function initialiser_troncon()
{$BDD=ouverture_BDD_Admin();
    $sql="INSERT INTO `troncons` (`codA`, `CodT`, `vistesse_moyenne`, `etat`, `distance`, `cout`, `proprietaire`) VALUES ";
    $sql=$sql."(1, 1, 120, 1, 100, 0, 1),
          (2, 1, 120, 1, 100, 0, 1),
          (3, 1, 120, 1, 100, 0, 1),
          (4, 1, 120, 1, 100, 0, 1),
          (5, 1, 120, 1, 100, 0, 1),
          (6, 1, 120, 1, 100, 0, 1);";
    $result=$BDD->query ($sql);
   }
function initialiser_villes()
{$BDD=ouverture_BDD_Admin();
    $sql="INSERT INTO `villes` (`COD_sortie`, `CodA`, `CodT`, `ville`) VALUES ";
    $sql=$sql."('1', '2', '1', 'nomville1'),
               ('2', '3', '1', 'nomville2'),
               ('3', '5', '1', 'nomville3'),
               ('3', '5', '1', 'nomville3bis');";

    $result=$BDD->query ($sql);
}