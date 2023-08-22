<h1>Formulaire de modification d'un joueur</h1>
<form method="POST" action="index.php">
    Prenom : <input type="text" name="prenom" value="<?= $joueur["prenom"]; ?>"/><br>
    Nom : <input type="text" name="nom" value="<?= $joueur["nom"]; ?>"/><br>
    Nombre de buts : <input type="number" name="nb_buts" value="<?= $joueur["nb_buts"]; ?>"/><br>
    Nombre de passes : <input type="number" name="nb_passes" value="<?= $joueur["nb_passes"]; ?>"/><br>
    Équipe : <select name="id_equipe">
    <?php 
        while($rangee = mysqli_fetch_assoc($equipes))
        {
            if($joueur["id_equipe"] == $rangee["id"])
                echo "<option selected value='" . $joueur["id_equipe"] . "'>" . htmlspecialchars($rangee["nom"]) . " de " . htmlspecialchars($rangee["ville"]) . "</option>";
            else 
                echo "<option value='" . $rangee["id"] . "'>" . htmlspecialchars($rangee["nom"]) . " de " . htmlspecialchars($rangee["ville"]) . "</option>";
        }
    ?>
    
    <input type="hidden" name="commande" value="ModifieJoueur"/>
    <input type="hidden" name="id" value="<?= $joueur["id"]; ?>"/></br>
    <input type="submit" value="Modifier"/>
    <a href='index.php'>Retourner à l'accueil</a>
    
</form>