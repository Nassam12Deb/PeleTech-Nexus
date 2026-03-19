<?php
session_start();

// Constantes
define('SITE_NAME', 'PêlêTech Nexus');
define('BASE_URL', 'http://localhost/peletech-nexus/'); // À adapter
define('UPLOAD_DIR', __DIR__ . '/assets/img/uploads/');
define('UPLOAD_URL', BASE_URL . 'assets/img/uploads/');

// Connexion BDD
$host = 'localhost';
$dbname = 'peletech_nexus';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// ===== SYSTÈME DE LANGUE =====
if (isset($_GET['lang']) && in_array($_GET['lang'], ['fr', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
    // Redirection pour enlever le paramètre de l'URL (optionnel mais recommandé)
    $clean_url = strtok($_SERVER['REQUEST_URI'], '?');
    header('Location: ' . $clean_url);
    exit;
}
$lang = $_SESSION['lang'] ?? 'fr';
define('LANG', $lang);

$langFile = __DIR__ . '/lang/' . $lang . '.php';
if (file_exists($langFile)) {
    $t = require $langFile;
} else {
    die("Fichier de langue introuvable");
}

// Fonctions d'authentification
function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

// Fonction pour générer un slug
function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    return $text ?: 'article';
}
?>