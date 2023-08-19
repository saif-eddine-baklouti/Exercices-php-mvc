<?php 

    /* 
        modele.php est le fichier qui représente notre modèle dans notre architecture MVC modulaire. 
        C'est donc dans ce fichier que nous retrouverons TOUTES les requêtes SQL sans AUCUNE exception. C'est aussi ici que se trouvera la CONNEXION à la base de données ET les informations de connexion relatives à celle-ci. 
    */
    //à modifier pour déployer sur Webdev
    define("SERVER", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DBNAME", "ligue");

    //exemple de version webdev
    /*define("SERVER", "localhost");
    define("USERNAME", "e1123980");
    define("PASSWORD", "lemotdepassequiestdanslefichier:my.cnf");
    define("DBNAME", "e1123980");
    */

    function connectDB()
    {
        //se connecter à la base de données
        $c = mysqli_connect(SERVER, USERNAME, PASSWORD, DBNAME);

        if(!$c)
            die("Erreur de connexion : " . mysqli_connect_error());

        //s'assurer que la connexion traite tout en UTF-8
        mysqli_query($c, "SET NAMES 'utf8'");   
        
        return $c;
    }

    //le seul appel à connectDB dont vous avez besoin, puisque vos fonctions vont utiliser cette connexion via l'utilisation du mot-clé global 
    $connexion = connectDB();

    function obtenir_equipes()
    {
        global $connexion;

        //avant de continuer on teste la requête dans PHPMYADMIN
        $requete = "SELECT id, nom, ville, nb_victoires FROM equipe";

        //exécuter la requête avec mysqli_query 
        $resultats = mysqli_query($connexion, $requete);

        return $resultats;
    }

    function obtenir_joueurs_par_equipe($id_equipe)
    {
        global $connexion;

        //avant de continuer on teste la requête dans PHPMYADMIN
        $requete = "SELECT id, prenom, nom, nb_buts, nb_passes, id_equipe FROM joueur WHERE id_equipe = " . $id_equipe;

        //exécuter la requête avec mysqli_query 
        $resultats = mysqli_query($connexion, $requete);

        return $resultats;
    }

    function obtenir_joueurs()
    {
        global $connexion;

        //avant de continuer on teste la requête dans PHPMYADMIN
        $requete = "SELECT id, prenom, nom, nb_buts, nb_passes, id_equipe FROM joueur";

        //exécuter la requête avec mysqli_query 
        $resultats = mysqli_query($connexion, $requete);

        return $resultats;
    }

    function obtenir_joueur_equipe_par_joueur_ID($id_joueur)
    {
        global $connexion;

        //avant de continuer on teste la requête dans PHPMYADMIN
        $requete = "SELECT joueur.id AS idJoueur, prenom, joueur.nom, nb_buts, nb_passes, id_equipe, equipe.nom AS nomEquipe, ville FROM joueur JOIN equipe ON id_equipe = equipe.id WHERE joueur.id = ".$id_joueur ;

        //exécuter la requête avec mysqli_query 
        $resultats = mysqli_query($connexion, $requete);

        $rangee = mysqli_fetch_assoc($resultats);

        return $rangee;
    }

    function obtenir_equipe_par_ID($id_equipe)
    {
        global $connexion;

        //avant de continuer on teste la requête dans PHPMYADMIN
        $requete = "SELECT id, nom, ville, nb_victoires FROM equipe WHERE id = " . $id_equipe;

        //exécuter la requête avec mysqli_query 
        $resultats = mysqli_query($connexion, $requete);

        $rangee = mysqli_fetch_assoc($resultats);

        return $rangee;
    }

    function insere_equipe($nom, $ville, $nb_victoires)
    {
        global $connexion;

        //1. déclarer la requête avec des ? là où il y aura des entrées de l'usager
        $requete = "INSERT INTO equipe(nom, ville, nb_victoires) VALUES(?, ?, ?)";

        //2. préparer la requête
        $reqPrep = mysqli_prepare($connexion, $requete);

        //3. est-ce que la requête préparée est valide
        if($reqPrep)
        {
            //4. faire le lien entre les paramètres (?) et les valeurs envoyées
            mysqli_stmt_bind_param($reqPrep, "ssi", $nom, $ville, $nb_victoires);

            //5. exécuter la requête préparée
            $test = mysqli_stmt_execute($reqPrep);

            if($test)
            {
                $id = mysqli_insert_id($connexion);
                return $id;
            }
            else 
                return false;
        }
        else 
            die("Erreur mysqli.");
    }

    function insere_joueur($prenom, $nom, $nb_buts, $nb_passes, $id_equipe)
    {
        global $connexion;

        //1. déclarer la requête avec des ? là où il y aura des entrées de l'usager
        $requete = "INSERT INTO joueur(prenom, nom, nb_buts, nb_passes, id_equipe) VALUES(?, ?, ?, ?, ?)";

        //2. préparer la requête
        $reqPrep = mysqli_prepare($connexion, $requete);

        //3. est-ce que la requête préparée est valide
        if($reqPrep)
        {
            //4. faire le lien entre les paramètres (?) et les valeurs envoyées
            mysqli_stmt_bind_param($reqPrep, "ssiii", $prenom, $nom, $nb_buts, $nb_passes, $id_equipe);

            //5. exécuter la requête préparée
            $test = mysqli_stmt_execute($reqPrep);

            if($test)
            {
                $id = mysqli_insert_id($connexion);
                return $id;
            }
            else 
                return false;
        }
        else 
            die("Erreur mysqli.");
    }

    function modifie_equipe($nom, $ville, $nb_victoires, $id)
    {
        global $connexion;

        //avant de continuer on teste la requête dans PHPMYADMIN
        $requete = "UPDATE equipe SET nom='$nom', ville = '$ville', nb_victoires = $nb_victoires WHERE id = $id";
        //exécuter la requête avec mysqli_query 
        $test = mysqli_query($connexion, $requete);
        
        return $test;
        
    }

    function supprime_equipe($id)
    {
        global $connexion;

        //avant de continuer on teste la requête dans PHPMYADMIN
        $requete = "DELETE FROM equipe WHERE id = " . $id;

        //exécuter la requête avec mysqli_query 
        $resultats = mysqli_query($connexion, $requete);

        return $resultats;

    }
    
    function modifie_joueur($id, $prenom, $nom, $nb_buts, $nb_passes, $id_equipe)
    {
        global $connexion;

        //avant de continuer on teste la requête dans PHPMYADMIN
        // $requete = "UPDATE joueur SET prenom=?, nom=?, nb_buts=?, nb_passes =?, id_equipe=?  WHERE ID=?";
        $requete = "UPDATE joueur SET prenom='$prenom', nom='$nom', nb_buts=$nb_buts, nb_passes =$nb_passes, id_equipe=$id_equipe  WHERE ID=$id";
        //exécuter la requête avec mysqli_query 
        $test = mysqli_query($connexion, $requete);
        
        return $test;
        
    }
?>