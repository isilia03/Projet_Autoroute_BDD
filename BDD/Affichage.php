<?php

function affichage_BDD()
{$data_base=ouverture_BDD_Utilisateur();
    echo "test correcct";
    ?>
    <script >
        function ouverture($champ) {
            autoroutes.style.display ="none";
            changement.style.display    ="none";
            intersection.style.display        ="none";
            proprietaire.style.display        ="none";
            troncons.style.display         ="none";
            villes.style.display         ="none";
            document.getElementById($champ).style.display        ="block";
        }

    </script>

    <h3>
        <span onclick='ouverture("autoroutes");'><a>autoroutes</a></span>
        <span onclick='ouverture("changement");'><a>changement</a></span>
        <span onclick='ouverture("intersection");'><a>intersection</a></span>
        <span onclick='ouverture("proprietaire");'><a>proprietaire</a></span>
        <span onclick='ouverture("troncons");'><a>troncons</a></span>
        <span onclick='ouverture("villes");'><a>villes</a></span>
    </h3>

    <div style='display: none;' ID='autoroutes'>
        <h1>autoroutes</h1>
        <?php   Afficher_BDD_brut($data_base,"autoroutes");?>
    </div>


    <div style='display: none;' ID='changement'>
        <h1>changement</h1>
        <?php    Afficher_BDD_brut($data_base,"changement"); ?>
    </div>

    <div style='display: none;' ID='intersection'>
        <h1>intersection</h1>
        <?php        Afficher_BDD_brut($data_base,"intersection"); ?>
    </div>

    <div style='display: none;' ID='proprietaire'>
        <h1>proprietaire</h1>
        <?php     Afficher_BDD_brut($data_base,"proprietaire");  ?>
    </div>

    <div style='display: none;' ID='troncons'>
        <h1>troncons</h1>
        <?php  Afficher_BDD_brut($data_base,"troncons");  ?>
    </div>

    <div style='display: none;' ID='villes'>
        <h1>villes</h1>
        <?php   Afficher_BDD_brut($data_base,"villes"); ?>
    </div>

    <?php

}


function affichage_BDD_complete()
{
    $data_base=ouverture_BDD_Utilisateur();
    Afficher_BDD_brut($data_base,"autoroutes");
    Afficher_BDD_brut($data_base,"changement");
    Afficher_BDD_brut($data_base,"intersection");
    Afficher_BDD_brut($data_base,"proprietaire");
    Afficher_BDD_brut($data_base,"troncons");
    Afficher_BDD_brut($data_base,"villes");
}




function Afficher_BDD_brut($data_base,$table)
{
    $SQL = "SELECT * FROM `".$table."`";
    echo "<br><h3>".$table."</h3>";
    echo "<table style='border: solid'>";


    afficher_titre($data_base,$table);
    $result = $data_base->query($SQL);
    $cmp=0;
    while ($row = $result->fetch_row())
    {$cmp++;
        $i=true;echo "<tr>";
        foreach($row as $value)
        {
            echo "<td>".$value."</td>";

        }echo "</tr>";
    }
    echo '</table><br>';
}


function Afficher_BDD_filtrer($bdd,$table,$champ_filtre,$valeur)
{
    
    $SQL = "SELECT * FROM `".$table."` where ".$champ_filtre."=".$valeur;
    echo "<br>Afficher_BDD_brut : ".$table."<br>";
    echo "<table>";
    $result = $bdd->query($SQL);
    $cmp=0;

    while ($row = $result->fetch_row())
    {$cmp++;
        echo "<tr>";
        foreach($row as $value)
        {echo "<td>".$value."</td>";}
        echo "</tr>";
    }
    echo '</table>';
}

function Show_Field_Name($data_base,$data_name,$rank)
{
    $SQL = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$data_name."'";
    $i=0;
    if ($result = $data_base->query($SQL))
    {while ($row = $result->fetch_row())
    {foreach($row as $value)
    {if($i==$rank)
    {return $value;}
        $i++;
    }
    }
    }
    return "blank";
}

function afficher_titre($data_base,$data_name)
{
    $SQL = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$data_name."'";

    if ($result = $data_base->query($SQL))
    {echo "<tr>" ;
        while ($row = $result->fetch_row())
        {
            foreach ($row as $value) { echo "<td><h4>" . $value . "</h4></td>";}
        } echo "</tr>" ;
    }


    echo "</tr>";
}
