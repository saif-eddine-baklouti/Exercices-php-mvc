<h1>Liste des équipes</h1>
<table>
<?php if (mysqli_num_rows($equipes) != 0) { ?> 
        <tr>
            <th><a href='index.php?commande=triEquipe&name=nom'>Nom</a></th>
            <th><a href='index.php?commande=triEquipe&name=ville'>Ville</a></th>
            <th>Paramètre</th>
        </tr>
    <?php } 

    while($rangee = mysqli_fetch_assoc($equipes))
    {
        ?>  
        <tr>
            <td>
                <a href='index.php?commande=ListeJoueursParEquipe&idEquipe=<?= $rangee["id"] ?>'>
                <?= $rangee["nom"] ?>  
                </a>
            </td>
            <td>
                <a href='index.php?commande=ListeJoueursParEquipe&idEquipe=<?= $rangee["id"] ?>'>
                <?= $rangee["ville"] ?>  
                </a>
            </td>
            <td>
                <a href='index.php?commande=SupprimeEquipe&idEquipe=<?= $rangee["id"] ?>'>
                    Supprimer cette équipe
                </a>
                <a href='index.php?commande=FormModifieEquipe&idEquipe=<?= $rangee["id"] ?>'>
                    Modifier cette équipe
                </a>
            </td>
        </tr>
        <?php 
    }
?>
</table>
<a href='index.php'>Retourner à l'accueil</a>
<a href='index.php?commande=FormAjoutEquipe'>Ajouter une équipe</a>
<p><?php if(isset($_REQUEST["message"])) echo $_REQUEST["message"]; ?></p>