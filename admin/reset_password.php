<?php
require_once __DIR__ . '/../config.php';

$error = '';
$success = '';

$token = $_GET['token'] ?? '';

if (!$token) {
    header('Location: login.php');
    exit;
}

// Hacher le token pour rechercher en base
$token_hash = hash('sha256', $token);

$stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()");
$stmt->execute([$token_hash]);
$reset = $stmt->fetch();

if (!$reset) {
    $error = "Lien de réinitialisation invalide ou expiré.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $reset) {
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Validation stricte du mot de passe
    $password_errors = [];
    if (strlen($password) < 8) {
        $password_errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $password_errors[] = "Le mot de passe doit contenir au moins une lettre majuscule.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        $password_errors[] = "Le mot de passe doit contenir au moins une lettre minuscule.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $password_errors[] = "Le mot de passe doit contenir au moins un chiffre.";
    }
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        $password_errors[] = "Le mot de passe doit contenir au moins un caractère spécial.";
    }

    if (!empty($password_errors)) {
        $error = implode('<br>', $password_errors);
    } elseif ($password !== $confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Tout est valide : mise à jour en transaction
        try {
            $pdo->beginTransaction();

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update->execute([$hash, $reset['email']]);

            // Supprimer le token utilisé
            $delete = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
            $delete->execute([$token_hash]);

            $pdo->commit();

            $success = "Mot de passe modifié avec succès. <a href='login.php'>Connectez-vous</a>";
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = "Une erreur est survenue. Veuillez réessayer.";
            error_log("Erreur reset password : " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: var(--dark);
            font-family: 'Inter', sans-serif;
        }
        .reset-container {
            background: var(--dark-light);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: var(--shadow-xl);
        }
        .reset-container h1 {
            color: var(--primary);
            margin-bottom: 30px;
            text-align: center;
            font-size: 1.8rem;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            background: var(--dark);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--light);
            font-size: 1rem;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(138, 111, 232, 0.1);
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(138, 111, 232, 0.3);
        }
        .error {
            color: #ef4444;
            text-align: center;
            margin-bottom: 20px;
        }
        .success {
            color: var(--primary);
            text-align: center;
            margin-bottom: 20px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: var(--gray-light);
            text-decoration: none;
        }
        .back-link:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>Réinitialisation du mot de passe</h1>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if ($reset && !$success): ?>
        <form method="POST">
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirmer le mot de passe" required>
            </div>
            <button type="submit" class="btn">Réinitialiser</button>
        </form>
        <?php endif; ?>
        <a href="login.php" class="back-link">Retour à la connexion</a>
    </div>
</body>
</html>