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
<ul>
<?php 
    while($rangee = mysqli_fetch_assoc($joueurs))
    {
        ?> 
        <li>
            <a href="index.php?commande=FormModifieJoueur&idJoueur=<?= $rangee["id"] ?>" > <?= $rangee["prenom"] ?> <?= $rangee["nom"] ?> </a>
        
        </li>
        <?php 
    }
?>
</ul>
<a href='index.php?commande=FormAjoutJoueur'>Ajouter un joueur</a>
<a href='index.php'>Retourner à l'accueil</a>