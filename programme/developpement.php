<?php
//array_merge()


function afficher_tableau_2dim($tableau)
{
echo "<table>";
    foreach($tableau as $ligne)
    { echo "<tr>";
        foreach($ligne as $case)
        {  echo "<td>".$case."</td>";
        }
        echo "</tr>";
    }
echo "<table>";

}


function villes_accesible_autoroute($BDD,$autoroute)
{
    $autoroutes=autoroute_accesible_autoroute($BDD,$autoroute);


    echo "<br><h1>etape 3</h1><br>";
    foreach ($autoroutes as $value)
    {
        $SQL = "SELECT ville FROM `villes` where codA=".$value;
        $result = $BDD->query($SQL);
        while ($row = $result->fetch_row())
        {foreach($row as $value)
            {$villes[]=$value;
            echo "<br>ville assecible :".$value;
            
            }
        }
    }
    
    if(isset($villes)) {return $villes;}
}

function autoroute_accesible_autoroute($BDD,$autoroute)
{
//on cherche toute les intersection de l'autoroute tester
    echo "<br><h1>etape 1</h1><br>";
     $SQL = "SELECT ID_intersection FROM `intersection` where codA=".$autoroute;
    $result = $BDD->query($SQL);
    while ($row = $result->fetch_row())
    {foreach($row as $value)
        {$ID_intersection[]=$value;
            echo "ID_intersection : ".$value."<br>";
        }
    }
//on lie a la table toutes les autoroutes qui appartiennent au intersection de l'autoroutes tester


    echo "<br><h1>etape 2</h1><br>";

    foreach($ID_intersection as $tester )
    { $SQL = "SELECT codA FROM `intersection` where ID_intersection=".$tester;
        $result = $BDD->query($SQL);
        while ($row = $result->fetch_row())
        {foreach($row as $value)
            {$autoroutes_brut[]=$value;}
        }
    }

//suppression des doublons
    $autoroutes[]=$autoroute;
    foreach($autoroutes_brut as $value)
    {$test=false;
        foreach($autoroutes as $value2)
        {if($value==$value2)
            {$test=true;}
        }
    if($test==false){$autoroutes[]=$value;}
    }


    foreach($autoroutes as $value)
    {echo "autoroutes : ".$value."<br>";}




return $autoroutes;
}


function toutes_autoroute_accesible_autoroute($BDD,$autoroute)
{
    //je liste les autoroutes du reseaux
    $SQL = "SELECT codA FROM `autoroutes` ";
    $result = $BDD->query($SQL);
    while ($row = $result->fetch_row())
        {foreach($row as $value)
            { $list_autoroute[]=$value;}
        }
//---------------------------------------------------------------------






    $autoroute1[]=$autoroute;
    $toutes_autoroute[]=$autoroute1;

   for($i=0;$i<5;$i++) {
       foreach ($toutes_autoroute as $autoroutelist) {
           foreach ($autoroutelist as $autoroutelist2) {
               ECHO " test " . $autoroutelist2;
               $autoroute1[] = autoroute_accesible_autoroute($BDD, $autoroutelist2);
               //najouter que les autoroutes present dans $list_autoroute
               //retirer de $list_autoroute les nouvelles autoroutes ajouter
               echo "arreter de code ici toutes_autoroute_accesible_autoroute";
           }
           $toutes_autoroute[] = $autoroute1;
           unset($autoroute1);
       }
   }
    $i=1;
    foreach ($toutes_autoroute as $autoroutelist)
    { echo "<br>".$i;
        foreach ($autoroutelist as $autoroutelist2)
            {foreach ($autoroutelist2 as $autoroutelist3)
                {
                    echo " ".$autoroutelist3;

                }

            
        }
    }
}

function obtenir_chemin($BDD,$ville_depart,$ville_arriver)
{
    //rechercher en cb autoroute on arrive a B en partant de A
    //regarder en detail comment passer de A a B = faire la liste dans l'ordre des autoroutes
    //regarder les intersections utiliser

    //$chemin[]=  //liste de troncons traverser

}