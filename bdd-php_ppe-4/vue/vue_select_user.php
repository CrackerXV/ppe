<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de l'utilisateur</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
        color: #333;
    }

    .container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2E6E49;
        font-size: 2rem;
    }

    h3 {
        color: #2E6E49;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }

    .user-info {
        margin-bottom: 20px;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: background-color 0.3s ease;
    }

    .user-info:hover {
        background-color: #e9ecef;
    }

    .user-info label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    .user-info span {
        display: block;
        margin-bottom: 10px;
        color: #333;
        font-size: 1rem;
    }

    .user-info span::before {
        content: "• ";
        color: #2E6E49;
    }

    .no-user {
        text-align: center;
        color: #777;
        font-size: 1.2rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        h2 {
            font-size: 1.8rem;
        }

        h3 {
            font-size: 1.3rem;
        }

        .user-info {
            padding: 10px;
        }

        .user-info span {
            font-size: 0.9rem;
        }
    }
</style>
</head>

<body>
<div class="container">
    <h2>Informations de l'utilisateur</h2>
    <?php
    if (isset($idUser)) {
        $userParticulier = $unControleur->selectParticulier($idUser);
        $userEntreprise = $unControleur->selectEntreprise($idUser);

        if ($userParticulier) {
            echo "<h3> Particulier </h3>";
            echo '<div class="user-info"><label>Email :</label><span>' . $userParticulier[0][1] . '</span></div>';
            echo '<div class="user-info"><label>Mot de passe :</label><span>' . $userParticulier[0][2] . '</span></div>';
            echo '<div class="user-info"><label>Nom :</label><span>' . $userParticulier[0][3] . '</span></div>';
            echo '<div class="user-info"><label>Prénom :</label><span>' . $userParticulier[0][4] . '</span></div>';
            echo '<div class="user-info"><label>Adresse :</label><span>' . $userParticulier[0][5] . '</span></div>';
            echo '<div class="user-info"><label>Date de naissance :</label><span>' . $userParticulier[0][6] . '</span></div>';
            echo '<div class="user-info"><label>Sexe :</label><span>' . $userParticulier[0][7] . '</span></div>';
        } else if ($userEntreprise) {
            echo "<h3> Entreprise </h3>";
            echo '<div class="user-info"><label>Email :</label><span>' . $userEntreprise[0][1] . '</span></div>';
            echo '<div class="user-info"><label>Mot de passe :</label><span>' . $userEntreprise[0][2] . '</span></div>';
            echo '<div class="user-info"><label>SIRET :</label><span>' . $userEntreprise[0][3] . '</span></div>';
            echo '<div class="user-info"><label>Raison sociale :</label><span>' . $userEntreprise[0][4] . '</span></div>';
            echo '<div class="user-info"><label>Capital social :</label><span>' . $userEntreprise[0][5] . '</span></div>';
        } else {
            echo '<p>Aucun utilisateur sélectionné.</p>';
        }
    }
    ?>
</div>
</body>
</html>
