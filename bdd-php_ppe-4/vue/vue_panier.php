<?php
error_reporting(0);

$idUser = $_SESSION['idUser'];

// Récupérer les livres en promotion
$livresPromotion = $unControleur->selectLivrePromotion();

// Récupérer les livres dans le panier
$lesCommandes = $unControleur->viewSelectTotalLivreEnAttente($idUser);

// Initialiser le montant total ajusté avec les promotions
$sommeAPayer = 0;

// Parcourir les livres dans le panier pour appliquer les promotions
foreach ($lesCommandes as $uneCommande) {
    $idLivre = $uneCommande['idLivre'];
    $prixLivre = $uneCommande['prixLivre'];
    $quantite = $uneCommande['quantiteLigneCommande'];

    // Vérifier si une promotion existe pour ce livre
    $promotion = null;
    foreach ($livresPromotion as $promo) {
        if ($promo['idLivre'] === $idLivre) {
            $promotion = $promo;
            break;
        }
    }

    if ($promotion && isset($promotion['prixPromotion'])) {
        // Appliquer le prix promotionnel
        $sommeAPayer += $promotion['prixPromotion'] * $quantite;
    } else {
        // Utiliser le prix normal
        $sommeAPayer += $prixLivre * $quantite;
    }
}

// Récupérer l'adresse de l'utilisateur
$adresseUser = $unControleur->selectAdresseUser($idUser);
$adresseUser = $adresseUser['adresseUser'];

// Récupérer la date de livraison
$dateCommande = $unControleur->selectDateLivraisonCommande($idUser);
$dateCommande = $dateCommande[0];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livres et paiement</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
        color: #333;
    }

    .main-container {
        display: flex;
        justify-content: space-between;
        margin: 20px 50px;
        gap: 20px;
    }

    .table-container {
        width: 65%;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .table-container h3 {
        color: #2E6E49;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #2E6E49;
        color: white;
        font-weight: bold;
    }

    tr:hover {
        background-color: #f9f9f9;
    }

    .table-success {
        background-color: #d4edda;
        color: #155724;
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .table-success:hover {
        background-color: #c3e6cb;
    }

    .payment-container {
        width: 35%;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .payment-container h3 {
        color: #2E6E49;
        margin-bottom: 20px;
        font-size: 1.5rem;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus {
        border-color: #2E6E49;
        outline: none;
    }

    .pay-button {
        text-align: center;
        margin-top: 20px;
    }

    .pay-button button {
        padding: 10px 20px;
        background-color: #2E6E49;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .pay-button button:hover {
        background-color: #1e4a32;
    }

    .old-price {
        text-decoration: line-through;
        color: #777;
    }

    .promo-price {
        color: #e74c3c;
        font-weight: bold;
    }

    a img {
        transition: transform 0.3s ease;
    }

    a img:hover {
        transform: scale(1.1);
    }

    /* Styles pour les boutons de filtre et de tri */
    select, input[type="text"], input[type="submit"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
        margin-right: 10px;
        transition: border-color 0.3s ease;
    }

    select:focus, input[type="text"]:focus {
        border-color: #2E6E49;
        outline: none;
    }

    input[type="submit"] {
        background-color: #2E6E49;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #1e4a32;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-container {
            flex-direction: column;
            margin: 10px;
        }

        .table-container, .payment-container {
            width: 100%;
            margin-bottom: 20px;
        }

        .payment-container {
            height: auto;
        }
    }
</style>
</head>
<body>
<div class="main-container">
    <div class="table-container">
        <h3>Liste des livres</h3>
        <form method="post">
            Filtrer par : <input type="text" name="filtre">
            <input type="submit" name="FiltrerPanier" value="Filtrer" class="table-success">
            <br><br>
            Trier par :
            <select name="tri" onchange="this.form.submit()">
                <option value="">-- Choisir --</option>
                <option value="prixMin">Prix minimum</option>
                <option value="prixMax">Prix maximum</option>
                <option value="ordreCroissant">Ordre croissant</option>
                <option value="ordreDecroissant">Ordre décroissant</option>
            </select>
        </form>
        <br>
        <table class="table">
            <thead class="table-success">
            <tr>
                <th scope="col">Récapitulatif de la commande</th>
            </tr>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col"></th>
                <th scope="col">Quantité</th>
                <th scope="col"></th>
                <th scope="col">Total Livre</th>
                <th scope="col">Opération</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $lesCommandes = $unControleur->viewSelectTotalLivreEnAttente($idUser);

            $tri = isset($_POST['tri']) ? $_POST['tri'] : '';
            $idUser = $_SESSION['idUser'];

            if ($tri == 'prixMin') {
                $lesCommandes = $unControleur->viewSelectNbMinLivreEnAttente($idUser);
            } elseif ($tri == 'prixMax') {
                $lesCommandes = $unControleur->viewSelectNbMaxLivreEnAttente($idUser);
            } elseif ($tri == 'ordreCroissant') {
                $lesCommandes = $unControleur->viewSelectNomMinLivreEnAttente($idUser);
            } elseif ($tri == 'ordreDecroissant') {
                $lesCommandes = $unControleur->viewSelectNomMaxLivreEnAttente($idUser);
            }

            if (isset($lesCommandes)) {

                foreach ($lesCommandes as $uneCommande) {
                    $promotionTrouvee = false;
                    $prixPromotion = null;

                    foreach ($livresPromotion as $promo) {
                        if ($promo['idLivre'] === $uneCommande['idLivre']) {
                            $promotionTrouvee = true;
                            $prixPromotion = $promo['prixPromotion'];
                            break;
                        }
                    }

                    if ($promotionTrouvee && isset($prixPromotion)) {
                        $totalLivre = $prixPromotion * $uneCommande['quantiteLigneCommande'];
                    } else {
                        $totalLivre = $uneCommande['prixLivre'] * $uneCommande['quantiteLigneCommande'];
                    }

                    echo "<tr>";
                    echo "<td>" . $uneCommande['nomLivre'] . "</td>";
                    echo "<td>";
                    if ($promotionTrouvee && isset($prixPromotion)) {
                        echo "<span class='old-price'>" . $uneCommande['prixLivre'] . "€</span> ";
                        echo "<span class='promo-price'>" . $prixPromotion . "€</span>";
                    } else {
                        echo $uneCommande['prixLivre'] . "€";
                    }
                    echo "</td>";
                    echo "<td> * </td>";
                    echo "<td>" . $uneCommande['quantiteLigneCommande'] . "</td>";
                    echo "<td> = </td>";
                    echo "<td>" . $totalLivre . "€</td>";
                    echo "<td>";
                    echo "<a href='index.php?page=3&action=sup&idCommande=" . $uneCommande['idCommande'] . "&idLigneCommande=" . $uneCommande['idLigneCommande'] . "'>" . "<img src='images/supprimer.png' height='30' width='30'> </a>";
                    echo "<a href='index.php?page=3&action=edit&idCommande=" . $uneCommande['idCommande'] . "&idLigneCommande=" . $uneCommande['idLigneCommande'] . "'>" . "<img src='images/editer.png' height='30' width='30'> </a>";
                    ?>
                    <form method="post">
                        <table>
                            <tr>
                                <td> Modifier la quantité :</td> <br>
                                <td> <input type="text" name="updateQuantiteLivre" style="width:30px"></td>
                            </tr>
                            <tr>
                                <td> <input type="submit" name="QuantitePanier" value="Confirmer" class="table-success"></td>
                            </tr>
                        </table>
                    </form>
                    <?php
                    echo "</td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="payment-container">
        <h3>Paiement de la commande</h3>
        <form action="index.php?page=3&action=payer" method="post">
            <div class="form-group">
                <label for="montant">Somme à payer</label>
                <input type="text" id="montant" name="montant" value="<?php
                if ($sommeAPayer > 0) {
                    echo $sommeAPayer . '€';
                    $pointAUtiliser = $sommeAPayer * 10;
                } else {
                    echo '0€';
                }
                ?>" readonly>
            </div>
            <div class="form-group">
                <label for="montant">Points à utiliser</label>
                <input type="text" id="point" name="point" value="<?php
                if ($pointAUtiliser > 0) {
                    echo $pointAUtiliser . ' points';
                    $_SESSION['pointAUtiliser'] = $pointAUtiliser;
                } else {
                    echo '0 Point';
                }
                ?>" readonly>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse de livraison</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo $adresseUser; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="date-livraison">Date de livraison</label>
                <input type="date" id="date-livraison" name="date-livraison" value="<?php echo $dateCommande; ?>" readonly>
            </div>
            <div class="pay-button">
    <?php
    echo "<a href='https://paypal.me/rylesatm?country.x=FR&locale.x=fr_FR' target='_blank' class='btn btn-success' style='margin-right: 10px;'>Payer avec Paypal</a>";
    
    echo "<input type='submit' name='PayerPoint' value='Payer avec des points' class='btn btn-success'>";
    ?>
</div>
        </form>
    </div>
</div>
</body>
</html>