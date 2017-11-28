<?php


function POST_secure($name)
{
    if(isset($name)){return filter_input(INPUT_POST,$name, FILTER_SANITIZE_STRING);}
    return false;
}


function form_menu_deroulant($nom_table,$nom_champ)
{
    $intranet=ouverture_BDD_Intranet_Utilisateur();

    $SQL='Select '.$nom_champ.' from '.$nom_table;

    if ($result = $intranet->query($SQL))
    {while ($row = $result->fetch_row())
    { echo "<OPTION>". $row[0];}
    }
    else
    {echo "requete fail SQL :".$SQL."<br>";}

    return;
}

function exist($data_base,$from,$champ,$valeur)
{$SQL='Select `'.$champ.'` from `'.$from.'` where `'.$champ.'`="'.$valeur.'"';

    if ($result = $data_base->query($SQL))
    {while ($row = $result->fetch_row())
    { return isset($row[0]);}
    }
    else
    {echo "requete fail SQL :".$SQL."<br>";}


    return false;
}
function test_compte_mdp($data_base,$valeur,$valeur2)
{
$SQL='SELECT ID from compte where Mail="'.$valeur.'" && mdp= "'.$valeur2.'"';


    if ($result = $data_base->query($SQL))
    {while ($row = $result->fetch_row())
    { if(isset($row[0])){return $row[0];};}
    }
    else
    {echo "requete fail SQL :".$SQL."<br>";}


    return false;
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
function select_multiple($data_base,$table,$where,$champ_sortie)
{
  
    $SQL='SELECT '.$champ_sortie.' from '.$table.' where '.$where;

    if ($result = $data_base->query($SQL))
    {while ($row = $result->fetch_row())
    { if(isset($row[0])){return $row[0];};}
    }
    else
    {echo "requete fail SQL :".$SQL."<br>";}


    echo $SQL;
    return false;

}

function update_fichier($bdd,$id_groupe,$champ,$date)
{
    $SQL='UPDATE `equipe` SET `'.$champ.'`="'.$date.'" WHERE ID='.$id_groupe;

    $result = $bdd->query ($SQL);
}

function get_type($intranet,$Mail)
{
    $type=select($intranet,"compte","Mail",$Mail,"type");
    switch ($type)
    {
        case "eleve":       return sha1("Eleve-projet-minerva");break;
        case "professeur":  return sha1("Professeur-projet-minerva");break;
        case "admin":       return sha1("ADMIN-projet-minerva");break;
        
        default:return sha1("false");break;
    }
return false;
}


function get_last_id($data_base,$table)
{
    $SQL='Select `ID` from `'.$table.'` order by `ID` DESC';
    $last=0;

    if ($result = $data_base->query($SQL))
    {while ($row = $result->fetch_row())
        { return $row[0]; }
    }


    return $last ;
}

function check_utilisateur_mdp($Mail,$mdp)
{
    $intranet=ouverture_BDD_Intranet_Utilisateur();

    if(test_compte_mdp($intranet,$Mail,sha1($mdp))!=false)//utilisateur existant avec le mdp correct
    {
        connection($intranet,$Mail);
        get_type($intranet,$Mail);

        return true;
    }
    else
    {
        deconnection();
        return false;
    }



}