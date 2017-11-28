<?php

function ouverture_BDD_Admin()
{   $host='localhost';
    $user='root';
    $password='';
    $databaseName='projet_autoroutes';
    $data_base = new mysqli($host,$user, $password,$databaseName);
    if (mysqli_connect_errno($data_base))
    {echo 'Failed to connect to MySQL: ' . mysqli_connect_error();}

    return $data_base;
}

function ouverture_BDD_Utilisateur()
{
    $host='localhost';
    $user='root';
    $password='';
    $databaseName='projet_autoroutes';
    $data_base = new mysqli($host,$user, $password,$databaseName);
    if (mysqli_connect_errno($data_base))
    {echo 'Failed to connect to MySQL: ' . mysqli_connect_error();}

    return $data_base;
}

