<h1>Liste des équipes</h1>
<ul>
<?php 
    while($rangee = mysqli_fetch_assoc($equipes))
    {
       ?> 
       <li>
        <a href='index.php?commande=ListeJoueursParEquipe&idEquipe=<?= $rangee["id"] ?>'>
            <?= htmlspecialchars($rangee["nom"]) ?> de <?= htmlspecialchars($rangee["ville"])?>
        </a>
        <a href='index.php?commande=SupprimeEquipe&idEquipe=<?= $rangee["id"] ?>'>
            Supprimer cette équipe
        </a>
        <a href='index.php?commande=FormModifieEquipe&idEquipe=<?= $rangee["id"] ?>'>
            Modifier cette équipe
        </a>
        </li>
       <?php 
    }
?>
</ul>
<a href='index.php'>Retourner à l'accueil</a>
<a href='index.php?commande=FormAjoutEquipe'>Ajouter une équipe</a>
<p><?php if(isset($_REQUEST["message"])) echo $_REQUEST["message"]; ?></p>