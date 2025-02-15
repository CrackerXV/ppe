<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stockage des livres</title>
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

        form {
            max-width: 600px;
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

        td {
            padding: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="text"]:focus {
            border-color: #2E6E49;
            outline: none;
            box-shadow: 0 0 5px rgba(46, 110, 73, 0.5);
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"] {
            background-color: #2E6E49;
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #245c3d;
        }

        input[type="reset"] {
            background-color: #6c757d;
            color: white;
        }

        input[type="reset"]:hover {
            background-color: #5a6268;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-container input {
            flex: 1;
            margin: 0 5px;
        }

        .hidden-input {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Stockage des livres</h2>
    <form method="post">
        <table>
            <tr>
                <td><label for="nomLivre">Nom du livre</label></td>
                <td>
                    <input type="text" id="nomLivre" name="nomLivre"
                           value="<?= ($leLivre != null) ? $leLivre['nomLivre'] : '' ?>">
                </td>
            </tr>
            <tr>
                <td><label for="exemplaireLivre">Nombre d'exemplaires</label></td>
                <td>
                    <input type="text" id="exemplaireLivre" name="exemplaireLivre"
                           value="<?= ($leLivre != null) ? $leLivre['exemplaireLivre'] : '' ?>">
                </td>
            </tr>
        </table>
        <div class="button-container">
            <input type="reset" name="Annuler" value="Annuler">
            <input type="submit" name="ValiderStockage" value="Valider">
        </div>
        <?= ($leLivre != null) ? '<input type="hidden" name="idLivre" value="' . $leLivre['idLivre'] . '">' : '' ?>
    </form>
</body>
</html>