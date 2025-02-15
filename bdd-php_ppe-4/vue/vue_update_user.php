<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<h2> Modifier vos informations </h2>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }

    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    h3 {
        color: #555;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    td {
        padding: 10px;
    }

    label {
        font-weight: bold;
        color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"],
    input[type="number"],
    select {
        width: 100%;
        padding: 8px;
        margin: 5px 0 10px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        margin: 10px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    p {
        text-align: center;
        color: #777;
    }
</style>
</body>
</html>


<?php
if (isset($idUser)) {
    $userParticulier = $unControleur->selectParticulier($idUser);
    $userEntreprise = $unControleur->selectEntreprise($idUser);

    if ($userParticulier) {
        echo "<h3> Particulier </h3>";
        ?>
        <form method="post">
            <table>
                <tr>
                    <td><label for="emailUser">Email :</label></td>
                    <td><input type="email" class="form-control" id="emailUser" name="emailUser" required></td>
                </tr>
                <tr>
                    <td><label for="mdpUser">Mot de passe :</label></td>
                    <td><input type="password" class="form-control" id="mdpUser" name="mdpUser" required></td>
                </tr>
                <tr>
                    <td><label for="nomUser">Nom :</label></td>
                    <td><input type="text" class="form-control" id="nomUser" name="nomUser" required></td>
                </tr>
                <tr>
                    <td><label for="prenomUser">Prénom :</label></td>
                    <td><input type="text" class="form-control" id="prenomUser" name="prenomUser" required></td>
                </tr>
                <tr>
                    <td><label for="adresseUser">Adresse :</label></td>
                    <td><input type="text" class="form-control" id="adresseUser" name="adresseUser" required></td>
                </tr>
                <tr>
                    <td><label for="dateNaissanceUser">Date de naissance :</label></td>
                    <td><input type="date" class="form-control" id="dateNaissanceUser" name="dateNaissanceUser" required></td>
                </tr>
                <tr>
                    <td><label for="sexeUser">Sexe :</label></td>
                    <td><select class="form-control" id="sexeUser" name="sexeUser" required>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="UpdateParticulier" value="Mettre à jour" class="btn btn-success">
                    </td>
                </tr>
            </table>
        </form>
        <?php
    } elseif ($userEntreprise) {
        echo "<h3> Entreprise </h3>";
        ?>
        <form method="post">
            <table>
                <tr>
                    <td><label for="emailUser">Email :</label></td>
                    <td><input type="email" class="form-control" id="emailUser" name="emailUser" required></td>
                </tr>
                <tr>
                    <td><label for="mdpUser">Mot de passe :</label></td>
                    <td><input type="password" class="form-control" id="mdpUser" name="mdpUser" required></td>
                </tr>
                <tr>
                    <td><label for="siretUser">SIRET :</label></td>
                    <td><input type="text" class="form-control" id="siretUser" name="siretUser" required></td>
                </tr>
                <tr>
                    <td><label for="raisonSocialeUser">Raison sociale :</label></td>
                    <td><input type="text" class="form-control" id="raisonSocialeUser" name="raisonSocialeUser" required></td>
                </tr>
                <tr>
                    <td><label for="capitalSocialUser">Capital social :</label></td>
                    <td><input type="number" class="form-control" id="capitalSocialUser" name="capitalSocialUser" required></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="UpdateEntreprise" value="Mettre à jour" class="btn btn-success">
                    </td>
                </tr>
            </table>
        </form>
        <?php
    } else {
        echo '<p>Aucun utilisateur sélectionné.</p>';
    }
}
?>
