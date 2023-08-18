<h1>Formulaire de modification d'une équipe</h1>
<form method="POST" action="index.php">
    Nom : <input type="text" name="nom" value="<?= $joueur["nom"]; ?>"/><br>
    Ville : <input type="text" name="ville" value="<?= $joueur["ville"]; ?>"/><br>
    Nombre de buts : <input type="number" name="nb_buts" value="<?= $joueur["nb_buts"]; ?>"/><br>
    Nombre de passes : <input type="number" name="nb_passes" value="<?= $joueur["nb_passes"]; ?>"/><br>
    <input type="hidden" name="commande" value="ModifieJoueur"/>
    <input type="hidden" name="id" value="<?= $joueur["id"]; ?>"/>
    <input type="submit" value="Modifier"/>
    <a href='index.php'>Retourner à l'accueil</a>
    <a href='index.php?commande=FormModifieJoueur&idJoueur=<?= $joueur["id"] ?>'>
                Modifier ce joueur
            </a>
</form>