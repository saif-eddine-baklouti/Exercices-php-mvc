
<?php 
    while($rangee = mysqli_fetch_assoc($resultatsRecherche))
    {
        ?> 
        <li>
            <?= $rangee["prenom"] ?> <?= ($rangee["nom"]) ?> 
            <a href="index.php?commande=FormModifieJoueur&idJoueur=<?= htmlspecialchars($rangee["id"]) ?>"> Modifier ce joueur </a>
        </li>
        <?php 
    }
?>
</ul>
<!-- <a href='index.php?commande=FormAjoutJoueur'>Ajouter un joueur</a> -->
<a href='index.php'>Retourner à l'accueil</a>
