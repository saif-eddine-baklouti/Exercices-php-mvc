<h1>Formulaire de modification d'une équipe</h1>
<form method="POST" action="index.php">
    Nom : <input type="text" name="nom" value="<?= $equipe["nom"]; ?>"/><br>
    Ville : <input type="text" name="ville" value="<?= $equipe["ville"]; ?>"/><br>
    Nombre de victoires : <input type="number" name="nb_victoires" value="<?= $equipe["nb_victoires"]; ?>"/><br>
    <input type="hidden" name="commande" value="ModifieEquipe"/>
    <input type="hidden" name="id" value="<?= $equipe["id"]; ?>"/>
    <input type="submit" value="Modifier"/></br>
    <a href='index.php?commande=ListeEquipes'>Retourner à la liste d'équipes </a></br>
    <a href='index.php'>Retourner à l'accueil</a></br>
</form>