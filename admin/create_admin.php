<?php
require_once __DIR__ . '/../config.php';

// MODIFIEZ CES VALEURS
$username = 'admin';
$password = 'admin123'; // À changer après première connexion
$email = 'admin@peletech-nexus.com';

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hash, $email]);
    echo "Utilisateur '$username' créé avec succès. Mot de passe : $password<br>";
    echo "Vous pouvez maintenant vous connecter à <a href='login.php'>l'interface d'administration</a>.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>