<?php

/**
 * Reproduisez les tables présentes dans le fichier image ( via workbench ou phpmyadmin )
 * Ajoutez des donées dans chaque table en vous assurant d'ajouter au moins 1 fois un utilisateur identique dans deux tables.
 * Utilisez UNION pour récupérer les usernames de chaque table, affichez le résultat à l'aide d'un print_r ou d'une boucle.
 * Utilisez UNION ALL pour afficher toutes les données y compris les doublons, affichez le résultat  à l'aide d'une boucle ou d'un print_r.
 * PS: Si vous utilisez un print_r, alors utilisez la balise <pre> pour un résultat plus propre.
 */

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'exo_205';

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $request = $bdd->prepare("
        SELECT username FROM user 
        UNION
        SELECT username FROM admin
        UNION
        SELECT username FROM client
");

    $request->execute();

    echo '<pre>';
    print_r($request->fetchAll());
    echo "</pre> <br><br>";

    $request = $bdd->prepare("
        SELECT username FROM user 
        UNION ALL
        SELECT username FROM admin
        UNION ALL
        SELECT username FROM client
");

    $request->execute();

    echo '<pre>';
    print_r($request->fetchAll());
    echo "</pre>";

} catch (PDOException $exception) {
    echo $exception->getMessage();
}