<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests unitaires des fonctions du modèle</title>
</head>
<body>
    <h1>Test de obtenir_equipes()</h1>
<?php 
    require_once("modele.php");

    $equipes = obtenir_equipes();
    var_dump($equipes);
?>    
<h1>Test de obtenir_joueurs()</h1>
<?php 
    require_once("modele.php");

    $joueurs = obtenir_joueurs();
    var_dump($joueurs);
?>    
<h1>Test de obtenir_joueurs_par_equipe($id_equipe)</h1>
<?php 
    $joueurs = obtenir_joueurs_par_equipe(1);
    var_dump($joueurs);
?>    
<h1>Test de obtenir_equipe_par_ID($id_equipe)</h1>
<?php 
    $equipe = obtenir_equipe_par_ID(1);
    var_dump($equipe);
?>    
<h1>Test de insere_equipe($nom, $ville, $nb_victoires)</h1>
<?php 
    $idEquipe = insere_equipe("Vipères", "Hochelaga", 12);
    var_dump($idEquipe);
?>   
<h1>Test de insere_joueur($nom, $ville, $nb_victoires)</h1>
<?php 
    $idJoueur = insere_joueur("Guillaume", "Harvey", 5, 10, $idEquipe);
    var_dump($idJoueur);
?> 
<h1>Test de modifie_equipe($nom, $ville, $nb_victoires, $id)</h1>
<?php 
    $test = modifie_equipe("testNom", "testVille", 10, $idEquipe);
    var_dump($test);
?>   
<h1>Test de supprime_equipe($id)</h1>
<?php 

    $test = supprime_equipe($idEquipe);
    var_dump($test);
?>    
</body>
</html>

