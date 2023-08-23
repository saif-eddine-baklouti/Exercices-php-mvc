<?php
if(isset($equipe))
{
        $nomEquipe = $equipe["nom"];
        $villeEquipe = $equipe["ville"];
    
?>
<h1> Liste des joueurs de l'équipe <?= $nomEquipe ?> de <?= $villeEquipe ?></h1>
<?php
}
else 
{
?>
<h1>Liste de tous les joueurs</h1>
<?php 
}
?>
<table>
    <tr>
    <th><a href='index.php?commande=triJoueur&name=prenom'>Prénom</a></th>
        <th><a href='index.php?commande=triJoueur&name=nom'>Nom</a></th>
        <th>Paramètre</th>
    </tr>
<?php 
    while($rangee = mysqli_fetch_assoc($joueurTrier))
    {
        ?> 
            <tr>
                <td><?= $rangee["prenom"] ?> </td>
                <td><?= $rangee["nom"] ?> </td>
                <td><a href="index.php?commande=FormModifieJoueur&idJoueur=<?= htmlspecialchars($rangee["id"]) ?>"> Modifier ce joueur </a></td>
                <td><a href='index.php?commande=SupprimeJoueur&id=<?= $rangee["id"] ?>&id_equipe=<?= $rangee["id_equipe"] ?>'> Supprimer ce joueur </a></td>
            </tr>
        <?php 
    }
?>
</table>
<a href='index.php?commande=FormAjoutJoueur'>Ajouter un joueur</a></br>
<a href='index.php'>Retourner à l'accueil</a></br>
<a href='index.php?commande=ListeEquipes'>Retourner à la liste d'équipes </a></br>
<p><?php if(isset($_REQUEST["message"])) echo $_REQUEST["message"]; ?></p>