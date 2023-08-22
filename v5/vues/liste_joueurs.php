<?php
if(isset($equipe))
{
        $nomEquipe = $equipe["nom"];
        $villeEquipe = $equipe["ville"];
    
?>
<h1>Liste des joueurs de l'équipe <?= $nomEquipe ?> de <?= $villeEquipe ?></h1>
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
        <th>Prenom</th>
        <th>Nom</th>
        <th>Parametre</th>
    </tr>
<?php 
    while($rangee = mysqli_fetch_assoc($joueurs))
    {
        ?> 
            <tr>
                <td><?= $rangee["prenom"] ?> </td>
                <td><?= ($rangee["nom"]) ?> </td>
                <td><a href="index.php?commande=FormModifieJoueur&idJoueur=<?= htmlspecialchars($rangee["id"]) ?>"> Modifier ce joueur </a></td>
            </tr>
        <?php 
    }
?>
</table>
<a href='index.php?commande=FormAjoutJoueur'>Ajouter un joueur</a>
<a href='index.php'>Retourner à l'accueil</a>
