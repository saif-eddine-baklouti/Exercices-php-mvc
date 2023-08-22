<?php 
    $prenom = "";
    $nom = "";
    $nb_buts = 0;
    $nb_passes = 0;
    $id_equipe = "";

    if(isset($_REQUEST["prenom"]))
        $prenom = htmlspecialchars($_REQUEST["prenom"]);

    if(isset($_REQUEST["nom"]))
        $nom = htmlspecialchars($_REQUEST["nom"]);

    if(isset($_REQUEST["nb_buts"]))
        $nb_buts = htmlspecialchars($_REQUEST["nb_buts"]);

    if(isset($_REQUEST["nb_passes"]))
        $nb_passes = htmlspecialchars($_REQUEST["nb_passes"]);

    if(isset($_REQUEST["id_equipe"]))
        $id_equipe = htmlspecialchars($_REQUEST["id_equipe"]);

?>
<h1>Formulaire d'ajout d'un joueur</h1>
<form method="POST" action="index.php">
    Prénom : <input type="text" name="prenom" value="<?= $prenom ?>"/><br>
    Nom : <input type="text" name="nom" value="<?= $nom ?>"/><br>
    Nombre de buts : <input type="number" name="nb_buts" value="<?= $nb_buts ?>"/><br>
    Nombre de passes : <input type="number" name="nb_passes" value="<?= $nb_passes ?>"/><br>
    Équipe : <select name="id_equipe">
    <?php 
        while($rangee = mysqli_fetch_assoc($equipes))
        {
            if($id_equipe == $rangee["id"])
                echo "<option selected value='" . $rangee["id"] . "'>" . htmlspecialchars($rangee["nom"]) . " de " . htmlspecialchars($rangee["ville"]) . "</option>";
            else 
                echo "<option value='" . $rangee["id"] . "'>" . htmlspecialchars($rangee["nom"]) . " de " . htmlspecialchars($rangee["ville"]) . "</option>";
        }
    ?>
    </select>
    <input type="hidden" name="commande" value="AjoutJoueur"/>
    <input type="submit" value="Ajouter"/></br>
    <a href='index.php?commande=ListeTousJoueurs'> Retourner à liste de tous les joueurs </a></br>
    <a href='index.php'> Retourner à l'accueil </a>
</form>
<p><?php if(isset($_REQUEST["message"])) echo $_REQUEST["message"]; ?></p>
