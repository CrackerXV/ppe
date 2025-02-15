<?php
session_start();
error_reporting(0);
require_once("controleur/controleur.class.php");

$unControleur = new Controleur();

$result = $unControleur->selectAdminPrincipal($_SESSION['idUser']);
$isAdmin = $result[0][0];

// Vérifier si l'utilisateur est connecté
$isLoggedIn = isset($_SESSION['emailUser']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>PPE Book'In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Liens CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        h1 {
            font-size: 3rem;
            color: #2E6E49;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .relief-box {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #f9f9f9;
            margin-top: 20px;
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Style pour la barre de navigation */
        .main-nav {
            display: flex;
            justify-content: center;
            background-color: #f0f0f0;
            padding: 10px;
            margin-bottom: 20px;
        }

        .main-nav .nav-item {
            margin: 0 15px;
            text-decoration: none;
            color: #2E6E49;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .main-nav .nav-item:hover {
            color: #1e4a32;
        }

        .main-nav .admin {
            color: #dc3545;
        }

        .main-nav .admin:hover {
            color: #c82333;
        }
    </style>
</head>
<body>

<center>
    <h1>Book'In</h1>
    <div class="relief-box">
        <img src="images/logo.png" height="100" width="100" alt="Logo Book'In">
        <?php
        if (isset($isAdmin) && $isAdmin == 1) {
            echo "<p><strong>Mode Admin</strong></p>";
        }
        if (!$isLoggedIn) {
            require_once("vue/vue_inscription.php");
            require_once("vue/vue_connexion.php");
        }
        ?>
    </div>
</center>

<!-- Barre de navigation -->
<?php
if ($isLoggedIn) {
    echo '<nav class="main-nav">
        <a href="index.php?page=1" class="nav-item">Accueil</a>
        <a href="index.php?page=2" class="nav-item">Catalogue</a>';

    if (empty($isAdmin) || $isAdmin == 0) {
        echo '<a href="index.php?page=3" class="nav-item">Panier</a>';
        echo '<a href="index.php?page=4" class="nav-item">Commandes</a>';
        echo '<a href="index.php?page=5" class="nav-item">Abonnement</a>';
        echo '<a href="index.php?page=6" class="nav-item">Profil</a>';
    }

    if (isset($isAdmin) && $isAdmin == 1) {
        echo '<a href="index.php?page=7" class="nav-item admin">Promotions</a>';
        echo '<a href="index.php?page=8" class="nav-item admin">Stock</a>';
        echo '<a href="index.php?page=9" class="nav-item admin">Statistiques</a>';
    }

    echo '<a href="index.php?page=10" class="nav-item">Déconnexion</a>
    </nav>';
}
?>

<!-- Contenu principal -->
<main>
    <?php
    if (isset($_POST['Connexion'])) {
        $emailUser = $_POST['emailUser'];
        $mdpUser = $_POST['mdpUser'];

        $unUser = $unControleur->verifConnexion($emailUser, $mdpUser);
        if ($unUser) {
            $_SESSION['idUser'] = $unUser['idUser'];
            $_SESSION['emailUser'] = $_POST['emailUser'];
            $_SESSION['mdpUser'] = $_POST['mdpUser'];
            $_SESSION['roleUser'] = $unUser['roleUser'];

            header("Location: index.php?page=1");
        } else {
            echo "<br> <p class='error'>Vérifiez les identifiants.</p>";
        }
    }

    if (isset($_POST['InscriptionParticulier'])) {
        $emailUser = $_POST['emailUser'];
        $mdpUser = $_POST['mdpUser'];
        $nomUser = $_POST['nomUser'];
        $prenomUser = $_POST['prenomUser'];
        $adresseUser = $_POST['adresseUser'];
        $dateNaissanceUser = $_POST['dateNaissanceUser'];
        $sexeUser = $_POST['sexeUser'];

        $unControleur->triggerInsertParticulier($emailUser, $mdpUser, $nomUser, $prenomUser, $adresseUser, $dateNaissanceUser, $sexeUser);
    }

    if (isset($_POST['InscriptionEntreprise'])) {
        $emailUser = $_POST['emailUser'];
        $mdpUser = $_POST['mdpUser'];
        $siretUser = $_POST['siretUser'];
        $raisonSocialeUser = $_POST['raisonSocialeUser'];
        $capitalSocialUser = $_POST['capitalSocialUser'];

        $unControleur->triggerInsertEntreprise($emailUser, $mdpUser, $siretUser, $raisonSocialeUser, $capitalSocialUser);
    }

    if ($isLoggedIn) {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        switch ($page) {
            case 1: require_once("controleur/home.php"); break;
            case 2: require_once("controleur/c_livres.php"); break;
            case 3: require_once("controleur/c_panier.php"); break;
            case 4: require_once("controleur/c_commande.php"); break;
            case 5: require_once("controleur/c_abonnement.php"); break;
            case 6: require_once("controleur/c_utilisateur.php"); break;
            case 7: require_once("controleur/c_promotion.php"); break;
            case 8: require_once("controleur/c_stockage.php"); break;
            case 9: require_once("controleur/c_statistique.php"); break;
            case 10:
                session_destroy();
                unset($_SESSION['emailUser']);
                header("Location: index.php");
                break;
            default: require_once("controleur/home.php"); break;
        }
    } else {
        // Afficher uniquement les formulaires de connexion et d'inscription
        require_once("vue/vue_connexion.php");
        require_once("vue/vue_inscription.php");
    }
    ?>
</main>

<!-- Pied de page -->
<footer>
    <br>
    <center>
        <p>&copy; 2025 Book'In. Tous droits réservés.</p>
    </center>
</footer>

<!-- Liens JavaScript -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>