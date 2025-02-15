<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #2E6E49;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .table-container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2E6E49;
            color: white;
            font-size: 1.1rem;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            color: #333;
            font-size: 1rem;
        }

        td ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        td ul li {
            margin-bottom: 10px;
        }

        .stat-label {
            font-weight: bold;
            color: #2E6E49;
        }

        .stat-value {
            margin-left: 10px;
            color: #555;
        }
    </style>
</head>
<body>
    <h2>Statistiques</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nombre de commande(s) 'en attente'</th>
                    <th>Liste des meilleures ventes (du meilleur au pire)</th>
                    <th>Liste des livres en rupture de stock (- de 5 exemplaires)</th>
                    <th>Meilleurs avis (livres les mieux notés)</th>
                    <th>Nombre de livres achetés (par l'utilisateur)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $idUser = $_SESSION['idUser'];

                $vCommandesEnAttente = $unControleur->viewSelectCommandesEnAttente();
                $vMeilleuresVentes = $unControleur->viewSelectMeilleuresVentes();
                $vLivresEnStock = $unControleur->viewSelectLivresEnStock();
                $vMeilleursAvis = $unControleur->viewMeilleursAvis();
                $vNbLivreAcheteUser = $unControleur->viewNbLivreAcheteUser();

                echo "<tr>";
                echo "<td><span class='stat-label'>Commandes en attente :</span> <span class='stat-value'>" . $vCommandesEnAttente[0]['nbCommandeEnAttente'] . "</span></td>";

                echo "<td><ul>";
                for ($i = 0; $i < count($vMeilleuresVentes); $i++) {
                    echo "<li><span class='stat-label'>" . $vMeilleuresVentes[$i]['nomLivre'] . " :</span> <span class='stat-value'>" . $vMeilleuresVentes[$i]['totalVendu'] . " vendus</span></li>";
                }
                echo "</ul></td>";

                echo "<td><ul>";
                for ($i = 0; $i < count($vLivresEnStock); $i++) {
                    echo "<li><span class='stat-label'>" . $vLivresEnStock[$i]['nomLivre'] . " :</span> <span class='stat-value'>" . $vLivresEnStock[$i]['exemplaireLivre'] . " exemplaires restants</span></li>";
                }
                echo "</ul></td>";

                echo "<td><ul>";
                for ($i = 0; $i < count($vMeilleursAvis); $i++) {
                    echo "<li><span class='stat-label'>" . $vMeilleursAvis[$i]['nomLivre'] . " :</span> <span class='stat-value'>" . number_format($vMeilleursAvis[$i]['moyenneNote'], 1) . "/5</span></li>";
                }
                echo "</ul></td>";

                echo "<td><ul>";
                for ($i = 0; $i < count($vNbLivreAcheteUser); $i++) {
                    echo "<li><span class='stat-label'>" . $vNbLivreAcheteUser[$i]['emailUser'] . " :</span> <span class='stat-value'>" . $vNbLivreAcheteUser[$i]['nbLivreAchete'] . " livres achetés</span></li>";
                }
                echo "</ul></td>";

                echo "</tr>";
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>