<?php
require_once("controleur/controleur.class.php");
$unControleur = new Controleur();

$idUser = $_SESSION['idUser'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
            color: #0070ba;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #333;
        }

        .benefits {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #ddd;
        }

        .benefits p {
            margin: 10px 0;
            font-size: 1.1em;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0070ba;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #0070ba;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #0070ba;
        }

        .btn-primary:hover {
            background-color: #005a93;
        }

        .btn-secondary {
            background-color: #28a745;
        }

        .btn-secondary:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group input[type="submit"]:hover {
            opacity: 0.9;
        }

        .highlight {
            background-color: #e9f5ff;
            border-left: 4px solid #0070ba;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .highlight p {
            margin: 0;
            font-size: 1.1em;
            color: #0070ba;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Abonnement</h2>
    <div class="highlight">
        <?php echo "<p>Nombre de points : " . $unControleur->selectPointAbonnement($idUser)['pointAbonnement'] . "</p>" ?>
    </div>
    <div class="benefits">
        <p>L'abonnement vous donne des avantages comme :</p>
        <p>- Des livres offerts après avoir acheté des livres (chance : 1/5).</p>
        <p>- Des points de fidélité à l'achat de chaque livre qui vous permettront d'obtenir des livres gratuitement.</p>
    </div>
    <table>
        <thead>
        <tr>
            <th>Durée</th>
            <th>Prix</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1 mois</td>
            <td>10€</td>
            <td>
                <a href="https://paypal.me/rylesatm?country.x=FR&locale.x=fr_FR&amount=10" target="_blank" class="btn btn-primary">S'abonner</a>
            </td>
        </tr>
        <tr>
            <td>3 mois</td>
            <td>25€</td>
            <td>
                <a href="https://paypal.me/rylesatm?country.x=FR&locale.x=fr_FR&amount=25" target="_blank" class="btn btn-primary">S'abonner</a>
            </td>
        </tr>
        <tr>
            <td>1 an</td>
            <td>80€</td>
            <td>
                <a href="https://paypal.me/rylesatm?country.x=FR&locale.x=fr_FR&amount=80" target="_blank" class="btn btn-primary">S'abonner</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>