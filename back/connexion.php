<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupère les valeurs saisies par l'utilisateur
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    
    // Vérifie si l'utilisateur existe dans la base de données
    $host = 'localhost'; // Hôte de la base de données
    $user = 'jroyet'; // Nom d'utilisateur de la base de données
    $password = 'motdepasse'; // Mot de passe de la base de données
    $database = 'jroyet'; // Nom de la base de données

    // Connexion à la base de données
    $connexion = mysqli_connect($host, $user, $password, $database);

    // Vérifie si la connexion a réussi
    if (!$connexion) {
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }

    // Requête pour récupérer l'utilisateur correspondant aux identifiants saisis
    $requete = "SELECT * FROM Etudiant WHERE email='$email' AND motDePasse=MD5('$motDePasse')";
    $resultat = mysqli_query($connexion, $requete);

    // Vérifie si l'utilisateur existe
    if (mysqli_num_rows($resultat) > 0) {
        // Redirige l'utilisateur vers la page appropriée
        header('Location: ../front/templates/found-trajet.html');
        exit();
    } else {
        // Affiche un message d'erreur
        echo "L'adresse email ou le mot de passe est incorrect.";
    }

    // Ferme la connexion à la base de données
    mysqli_close($connexion);
}
?>
