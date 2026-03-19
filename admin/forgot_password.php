<?php
require_once __DIR__ . '/../config.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Veuillez saisir une adresse email valide.";
    } else {
        // Rate limiting : maximum 3 demandes par heure pour cet email
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM password_resets WHERE email = ? AND created_at > NOW() - INTERVAL 1 HOUR");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();

        if ($count >= 3) {
            $error = "Trop de demandes de réinitialisation. Veuillez réessayer dans une heure.";
        } else {
            // Vérifier si l'utilisateur existe (mais on ne divulgue pas l'information)
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Message unifié (même si l'email n'existe pas)
            $message = "Si cette adresse email est associée à un compte, vous recevrez un email de réinitialisation.";

            if ($user) {
                // Génération d'un token aléatoire sécurisé
                $token = bin2hex(random_bytes(32)); // 64 caractères hexadécimaux
                $token_hash = hash('sha256', $token); // Stockage du hash
                $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

                // Insertion du token hashé
                $insert = $pdo->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
                $insert->execute([$email, $token_hash, $expires]);

                // Construction du lien de réinitialisation
                $resetLink = BASE_URL . "admin/reset_password.php?token=" . urlencode($token);
                $subject = "Réinitialisation de votre mot de passe";
                $messageBody = "Bonjour,\n\nPour réinitialiser votre mot de passe, cliquez sur le lien suivant :\n$resetLink\n\nCe lien est valable pendant 1 heure.\n\nSi vous n'avez pas demandé cette réinitialisation, ignorez cet email.";

                // Tentative d'envoi d'email
                if (!mail($email, $subject, $messageBody)) {
                    // En local, on peut logger l'erreur, mais on garde le message générique
                    error_log("Échec d'envoi d'email à $email");
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
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
        .forgot-container {
            background: var(--dark-light);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: var(--shadow-xl);
        }
        .forgot-container h1 {
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
        .message {
            color: var(--primary);
            text-align: center;
            margin-bottom: 20px;
        }
        .error {
            color: #ef4444;
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
    <div class="forgot-container">
        <h1>Mot de passe oublié</h1>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Votre adresse email" required>
            </div>
            <button type="submit" class="btn">Envoyer le lien de réinitialisation</button>
        </form>
        <a href="login.php" class="back-link">Retour à la connexion</a>
    </div>
</body>
</html>