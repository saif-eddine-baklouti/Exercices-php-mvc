<?php 
    /* 

        index.php est le CONTRÔLEUR de notre application de type MVC modulaire.

        TOUTES les requêtes de notre application, sans AUCUNE exception, que ce soit via un lien ou un formulaire devront passer par CE FICHIER. Tous les liens et les formulaires auront donc comme destination index.php, suivi des paramètres dans la query string (après le ?)

    */

    //réception du paramètre commande, qui peut arriver soit en GET, soit en POST
    if(isset($_REQUEST["commande"]))
    {
        $commande = $_REQUEST["commande"];
    }
    else 
    {
        //si j'arrive ici sans paramètre commande, il devrait y avoir une commande par défaut
        $commande = "Accueil";
    }

    //inclusion des fonctions du modèle
    require_once("modele.php");

    //coeur du contrôleur - structure décisionnelle
    switch($commande)
    {
        case "Accueil":
            $titre = "Accueil";
            require_once("vues/header.php");
            require("vues/accueil.html");
            require_once("vues/footer.php");
            break;
        case "ListeEquipes":
            $titre = "Liste des équipes dans la ligue";
            $equipes = obtenir_equipes();
            require_once("vues/header.php");
            require("vues/liste_equipes.php");
            require_once("vues/footer.php");
            break;
        case "ListeJoueursParEquipe":
            if(!isset($_REQUEST["idEquipe"]))
            {
                header("Location: index.php");
                die();
            }

            $titre = "Liste des joueurs dans cette équipe";

            //pour bien faire les choses, on a besoin ici de deux requêtes vers le modèle
            //une pour obtenir les joueurs qui jouent pour l'équipe dont on a reçu l'ID en paramètres
            $joueurs = obtenir_joueurs_par_equipe($_REQUEST["idEquipe"]);
            //l'autre pour obtenir le nom et la ville de l'équipe dont on a reçu l'ID en paramètres
            $equipe = obtenir_equipe_par_ID($_REQUEST["idEquipe"]);

            if($equipe)
            {
                require_once("vues/header.php");
                require("vues/liste_joueurs.php");
                require_once("vues/footer.php");
            }
            else 
                header("Location: index.php?commande=ListeEquipes");
            break; 
        case "ListeTousJoueurs":
            $titre = "Liste de tous les joueurs";

            //pour bien faire les choses, on a besoin ici de deux requêtes vers le modèle
            //une pour obtenir les joueurs qui jouent pour l'équipe dont on a reçu l'ID en paramètres
            $joueurs = obtenir_joueurs();

                require_once("vues/header.php");
                require("vues/liste_joueurs.php");
                require_once("vues/footer.php");
            
            break; 
        case "FormAjoutEquipe":
            $titre = "Formulaire d'ajout d'une équipe";
            require_once("vues/header.php");
            require("vues/form_ajout_equipe.html");
            require_once("vues/footer.php");
            break;
        case "AjoutEquipe":
            //valider le contenu des inputs
            if(isset($_REQUEST["nom"], $_REQUEST["ville"], $_REQUEST["nb_victoires"]))
            {
                if(valide_equipe($_REQUEST["nom"], $_REQUEST["ville"], $_REQUEST["nb_victoires"]))
                {
                    //insérer
                    $test = insere_equipe($_REQUEST["nom"], $_REQUEST["ville"], $_REQUEST["nb_victoires"]);
                    if($test !== false)
                    {
                        //l'ajout a fonctionné
                        header("Location: index.php?commande=ListeEquipes");
                        die();

                    }
                    else 
                    {
                        echo "Erreur MySQL - ici c'est un bug";
                        die();
                    }
                }
                else 
                {
                    //le formulaire a été mal rempli
                    header("Location: index.php?commande=FormAjoutEquipe");
                    die();
                }
            }
            else
            {
                //on arrive pas du formulaire
                header("Location: index.php");
                die();
            }
            break;
        case "SupprimeEquipe":
            if(!isset($_REQUEST["idEquipe"]) || !is_numeric($_REQUEST["idEquipe"]))
            {
                header("Location: index.php");
                die();
            }
            
            $test = supprime_equipe($_REQUEST["idEquipe"]);
            if($test)
            {
                header("Location: index.php?commande=ListeEquipes&message=Suppression réussie.");
                die();
            }
            else 
            {
                //si il y a un bug
                header("Location: index.php?commande=ListeEquipes&message=Échec de la suppression.");
                die();
            }

        case "FormModifieEquipe":
            if(!isset($_REQUEST["idEquipe"]) || !is_numeric($_REQUEST["idEquipe"]))
            {
                header("Location: index.php");
                die();
            }

            $titre = "Formulaire de modification d'une équipe";
            $equipe = obtenir_equipe_par_ID($_REQUEST["idEquipe"]);

            //est-ce que l'équipe possédant cet ID existe
            if($equipe != false)
            {
                require_once("vues/header.php");
                require("vues/form_modifie_equipe.php");
                require_once("vues/footer.php");
            }
            else 
            {
                header("Location: index.php");
                die();
            } 
            break;
        case "ModifieEquipe":
            //valider le contenu des inputs
            if(isset($_REQUEST["nom"], $_REQUEST["ville"], $_REQUEST["nb_victoires"], $_REQUEST["id"]) && is_numeric($_REQUEST["id"]))
            {
                if(valide_equipe($_REQUEST["nom"], $_REQUEST["ville"], $_REQUEST["nb_victoires"]))
                {
                    $test = modifie_equipe($_REQUEST["nom"], $_REQUEST["ville"], $_REQUEST["nb_victoires"], $_REQUEST["id"]);
                    if($test)
                        header("Location: index.php?commande=ListeEquipes&message=Modification réussie.");
                    else
                        header("Location: index.php?commande=ListeEquipes&message=Échec de la modification.");
                }
                else
                {
                    //formulaire mal rempli
                    header("Location: index.php?commande=FormModifEquipe&idEquipe=" . $_REQUEST["id"]);
                }
            }
            else 
            {
                header("Location: index.php");
                die();
            } 
            break;
        case "FormAjoutJoueur":
            $titre = "Formulaire d'ajout d'un joueur";
            require_once("vues/header.php");
            $equipes = obtenir_equipes();
            require("vues/form_ajout_joueur.php");
            require_once("vues/footer.php");
            break;
        case "AjoutJoueur":
            //valider le contenu des inputs
            if(isset($_REQUEST["prenom"], $_REQUEST["nom"], $_REQUEST["nb_buts"], $_REQUEST["nb_passes"], $_REQUEST["id_equipe"]))
            {
                if(valide_joueur($_REQUEST["prenom"], $_REQUEST["nom"], $_REQUEST["nb_buts"], $_REQUEST["nb_passes"], $_REQUEST["id_equipe"]))
                {
                    //insérer
                    $test = insere_joueur($_REQUEST["prenom"], $_REQUEST["nom"], $_REQUEST["nb_buts"], $_REQUEST["nb_passes"], $_REQUEST["id_equipe"]);
                    if($test !== false)
                    {
                        //l'ajout a fonctionné
                        header("Location: index.php?commande=ListeTousJoueurs");
                        die();

                    }
                    else 
                    {
                        echo "Erreur MySQL - ici c'est un bug";
                        die();
                    }
                }
                else 
                {
                    //le formulaire a été mal rempli
                    header("Location: index.php?commande=FormAjoutJoueur&prenom=" . $_REQUEST["prenom"] . "&nom=" . $_REQUEST["nom"] . "&nb_buts=" . $_REQUEST["nb_buts"] . "&nb_passes=" . $_REQUEST["nb_passes"] . "&id_equipe=" . $_REQUEST["id_equipe"] . "&message=Formulaire mal rempli.");
                    die();
                }
            }
            else
            {
                //on arrive pas du formulaire
                header("Location: index.php");
                die();
            }
            break;
        case "FormModifieJoueur":
            if(!isset($_REQUEST["idJoueur"]) || !is_numeric($_REQUEST["idJoueur"]))
            {
                header("Location: index.php");
                die();
            }
            
            $titre = "Formulaire de modification d'une équipe";
            $joueur = obtenir_joueur_par_ID($_REQUEST["idJoueur"]);
                
            //est-ce que l'équipe possédant cet ID existe
            if($joueur != false)
            {
                require_once("vues/header.php");
                require("vues/form_modifie_joueur.php");
                require_once("vues/footer.php");
            }
            else 
            {
                header("Location: index.php");
                die();
            } 
            break;
        default: 
            $titre = "Erreur 404";
            //erreur 404, commande introuvable
            require_once("vues/header.php");
            require("vues/404.html");
            require_once("vues/footer.php");
            break;
    }

    function valide_equipe($nom, $ville, $nb_victoires)
    {
        $valide = true; 

        $nom = trim($_REQUEST["nom"]);
        $ville = trim($_REQUEST["ville"]);
        $nb_victoires = $_REQUEST["nb_victoires"];

        if($nom == "" || $ville == "" || !is_numeric($nb_victoires))
        {
            $valide = false;
        }

        return $valide;
    }

    function valide_joueur($prenom, $nom, $nb_buts, $nb_passes, $id_equipe)
    {
        $valide = true; 

        $nom = trim($_REQUEST["nom"]);
        $prenom = trim($_REQUEST["prenom"]);
        $nb_buts = $_REQUEST["nb_buts"];
        $nb_passes = $_REQUEST["nb_passes"];
        $id_equipe = $_REQUEST["id_equipe"];


        if($nom == "" || $prenom == "" || !is_numeric($nb_buts) || !is_numeric($nb_passes) || !is_numeric($id_equipe))
        {
            $valide = false;
        }

        return $valide;
    }
?>