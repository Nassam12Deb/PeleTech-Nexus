<?php
require_once __DIR__ . '/../config.php';

if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — PêlêTech Nexus Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ============= VARIABLES (du projet) ============= */
        :root {
            --primary: #8A6FE8;
            --primary-dark: #6A5ACD;
            --primary-light: #A28CF8;
            --secondary: #4FA3D9;
            --secondary-dark: #4B79C6;
            --accent: #5B3FBF;
            --dark: #0B1020;
            --darker: #070B18;
            --dark-light: #12172A;
            --light: #EADFCF;
            --light-secondary: #D4C9B9;
            --gray-light: #A0A8C0;
            --gray: #7A839B;
            --border: rgba(138, 111, 232, 0.2);
            --border-light: rgba(138, 111, 232, 0.1);
            --error: #ef4444;
            --shadow-xl: 0 20px 25px -5px rgba(11, 16, 32, 0.6);
            --shadow-primary: 0 10px 30px rgba(138, 111, 232, 0.25);
            --radius-lg: 1rem;
            --radius-xl: 1.25rem;
            --radius-2xl: 1.5rem;
            --radius-full: 9999px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', -apple-system, sans-serif;
            background: var(--darker);
            color: var(--light-secondary);
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ============= BACKGROUND ANIMÉ ============= */
        .bg-scene {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        /* Grille perspective */
        .bg-grid {
            position: absolute;
            inset: -50%;
            background-image:
                linear-gradient(rgba(138, 111, 232, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(138, 111, 232, 0.06) 1px, transparent 1px);
            background-size: 60px 60px;
            transform: perspective(600px) rotateX(30deg) scale(2.5);
            transform-origin: center bottom;
            animation: gridDrift 20s linear infinite;
        }

        @keyframes gridDrift {
            0%   { background-position: 0 0; }
            100% { background-position: 0 60px; }
        }

        /* Orbes lumineux */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0;
            animation: orbPulse var(--dur, 8s) ease-in-out infinite var(--delay, 0s);
        }

        .orb-1 {
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(138, 111, 232, 0.35), transparent 70%);
            top: -200px; left: -150px;
            --dur: 10s; --delay: 0s;
        }
        .orb-2 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(79, 163, 217, 0.25), transparent 70%);
            bottom: -150px; right: -100px;
            --dur: 12s; --delay: -4s;
        }
        .orb-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(91, 63, 191, 0.3), transparent 70%);
            top: 50%; left: 60%;
            --dur: 9s; --delay: -2s;
        }

        @keyframes orbPulse {
            0%, 100% { opacity: 0.6; transform: scale(1) translate(0, 0); }
            33%       { opacity: 1;   transform: scale(1.1) translate(20px, -20px); }
            66%       { opacity: 0.7; transform: scale(0.95) translate(-10px, 15px); }
        }

        /* Particules flottantes */
        .particles {
            position: absolute;
            inset: 0;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: var(--primary);
            opacity: 0;
            animation: particleFloat var(--dur) ease-in-out infinite var(--delay);
        }

        @keyframes particleFloat {
            0%   { opacity: 0; transform: translateY(0) scale(0); }
            20%  { opacity: 0.6; transform: translateY(-30px) scale(1); }
            80%  { opacity: 0.3; transform: translateY(-120px) scale(0.7); }
            100% { opacity: 0; transform: translateY(-160px) scale(0); }
        }

        /* ============= LAYOUT ============= */
        .page-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 460px;
            padding: 1.5rem;
            animation: pageEnter 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes pageEnter {
            from { opacity: 0; transform: translateY(30px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ============= CARD ============= */
        .login-card {
            background: rgba(18, 23, 42, 0.75);
            backdrop-filter: blur(24px) saturate(160%);
            -webkit-backdrop-filter: blur(24px) saturate(160%);
            border: 1px solid rgba(138, 111, 232, 0.25);
            border-radius: var(--radius-2xl);
            padding: 2.5rem 2.75rem;
            box-shadow:
                0 0 0 1px rgba(138, 111, 232, 0.08),
                0 32px 64px rgba(7, 11, 24, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.07);
            position: relative;
            overflow: hidden;
        }

        /* Ligne décorative en haut */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 10%; right: 10%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary), var(--secondary), transparent);
            opacity: 0.8;
        }

        /* Coin décoratif */
        .login-card::after {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(138, 111, 232, 0.12), transparent 65%);
            pointer-events: none;
        }

        /* ============= HEADER ============= */
        .card-header {
            text-align: center;
            margin-bottom: 2.25rem;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px; height: 64px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 18px;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 24px rgba(138, 111, 232, 0.4);
            position: relative;
            animation: logoFloat 4s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% { transform: translateY(0); box-shadow: 0 8px 24px rgba(138, 111, 232, 0.4); }
            50%       { transform: translateY(-5px); box-shadow: 0 16px 32px rgba(138, 111, 232, 0.55); }
        }

        .brand-logo i {
            font-size: 1.75rem;
            color: white;
        }

        .brand-logo .logo-dot {
            position: absolute;
            top: -3px; right: -3px;
            width: 12px; height: 12px;
            background: #10b981;
            border-radius: 50%;
            border: 2px solid var(--darker);
            animation: statusPing 2s ease-in-out infinite;
        }

        @keyframes statusPing {
            0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.5); }
            50%       { transform: scale(1.1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        }

        .card-header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.65rem;
            font-weight: 700;
            letter-spacing: -0.03em;
            background: linear-gradient(135deg, var(--light) 30%, var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
            margin-bottom: 0.4rem;
        }

        .card-header p {
            color: var(--gray);
            font-size: 0.875rem;
            font-weight: 400;
            letter-spacing: 0.01em;
            margin: 0;
        }

        /* ============= BADGE SÉCURITÉ ============= */
        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(16, 185, 129, 0.08);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: var(--radius-full);
            padding: 0.3rem 0.8rem;
            font-size: 0.72rem;
            color: #10b981;
            font-weight: 500;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            margin-top: 0.75rem;
        }

        .security-badge i { font-size: 0.65rem; }

        /* ============= FORMULAIRE ============= */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--gray-light);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 0.875rem;
            transition: var(--transition);
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            background: rgba(7, 11, 24, 0.6);
            border: 1px solid rgba(138, 111, 232, 0.2);
            border-radius: var(--radius-lg);
            color: var(--light);
            font-size: 0.95rem;
            font-family: 'DM Sans', sans-serif;
            transition: var(--transition);
            letter-spacing: 0.01em;
        }

        .form-control::placeholder {
            color: var(--gray);
            font-style: italic;
            font-weight: 300;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(7, 11, 24, 0.8);
            box-shadow: 0 0 0 4px rgba(138, 111, 232, 0.12), 0 2px 8px rgba(0,0,0,0.3);
        }

        .form-control:focus + .input-icon,
        .input-wrapper:focus-within .input-icon {
            color: var(--primary);
        }

        /* L'icône est avant dans le DOM mais positionnée en absolu → on la gère avec :focus-within */
        .input-wrapper:focus-within .input-icon {
            color: var(--primary);
        }

        /* Bouton afficher/masquer mot de passe */
        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: var(--transition);
            font-size: 0.875rem;
            line-height: 1;
        }

        .toggle-password:hover { color: var(--primary-light); }

        /* Champ password avec bouton toggle */
        .form-control.has-toggle {
            padding-right: 3rem;
        }

        /* ============= ERREUR ============= */
        .alert-error {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.25);
            border-left: 3px solid var(--error);
            border-radius: var(--radius-lg);
            padding: 0.875rem 1rem;
            color: #fca5a5;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            animation: shakeIn 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
        }

        @keyframes shakeIn {
            0%  { opacity: 0; transform: translateX(-10px); }
            30% { transform: translateX(8px); }
            60% { transform: translateX(-5px); }
            80% { transform: translateX(3px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        .alert-error i { color: var(--error); font-size: 0.9rem; flex-shrink: 0; }

        /* ============= BOUTON CONNEXION ============= */
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            border-radius: var(--radius-full);
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 16px rgba(138, 111, 232, 0.35);
            margin-top: 0.5rem;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--primary-light), var(--secondary));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-login::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
            transform: skewX(-20deg);
            transition: left 0.6s ease;
        }

        .btn-login:hover::after { left: 150%; }
        .btn-login:hover::before { opacity: 1; }
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(138, 111, 232, 0.5);
        }
        .btn-login:active { transform: translateY(-1px); }

        .btn-login span { position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; gap: 0.6rem; }

        /* ============= LOADING STATE ============= */
        .btn-login.loading .btn-text { display: none; }
        .btn-login.loading .btn-loader { display: flex !important; }
        .btn-loader {
            display: none;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            z-index: 1;
        }
        .btn-loader .dot {
            width: 7px; height: 7px;
            background: white;
            border-radius: 50%;
            animation: dotBounce 0.6s ease-in-out infinite alternate;
        }
        .btn-loader .dot:nth-child(2) { animation-delay: 0.2s; }
        .btn-loader .dot:nth-child(3) { animation-delay: 0.4s; }

        @keyframes dotBounce {
            from { transform: translateY(0); opacity: 0.5; }
            to   { transform: translateY(-6px); opacity: 1; }
        }

        /* ============= FOOTER CARD ============= */
        .card-footer {
            margin-top: 1.75rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(138, 111, 232, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .forgot-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--gray);
            font-size: 0.82rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-link:hover { color: var(--primary-light); }
        .forgot-link i { font-size: 0.75rem; }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--gray);
            font-size: 0.82rem;
            text-decoration: none;
            transition: var(--transition);
        }
        .back-link:hover { color: var(--light-secondary); transform: translateX(-3px); }
        .back-link i { font-size: 0.75rem; }

        /* ============= SEPARATEUR ============= */
        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.5rem 0 1.25rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(138, 111, 232, 0.2));
        }
        .divider::after {
            background: linear-gradient(270deg, transparent, rgba(138, 111, 232, 0.2));
        }

        .divider span {
            color: var(--gray);
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* ============= COPYRIGHT ============= */
        .page-copyright {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(160, 168, 192, 0.4);
            font-size: 0.72rem;
            letter-spacing: 0.03em;
        }

        .page-copyright span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 600;
        }

        /* ============= RESPONSIVE ============= */
        @media (max-width: 480px) {
            .page-wrapper { padding: 1rem; }
            .login-card { padding: 2rem 1.75rem; }
            .card-header h1 { font-size: 1.4rem; }
        }

        /* ============= RÉDUCTION MOUVEMENT ============= */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>

    <!-- Scène de fond -->
    <div class="bg-scene" aria-hidden="true">
        <div class="bg-grid"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="particles" id="particles"></div>
    </div>

    <!-- Contenu principal -->
    <main class="page-wrapper">
        <div class="login-card">

            <!-- En-tête -->
            <header class="card-header">
                <div class="brand-logo">
                    <i class="fa-solid fa-terminal"></i>
                    <span class="logo-dot"></span>
                </div>
                <h1>Espace Administrateur</h1>
                <p>PêlêTech Nexus — Panneau de contrôle</p>
                <div class="security-badge">
                    <i class="fa-solid fa-lock"></i>
                    Connexion sécurisée SSL
                </div>
            </header>

            <!-- Message d'erreur -->
            <?php if (isset($error)): ?>
                <div class="alert-error" role="alert">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <!-- Formulaire -->
            <form method="POST" id="loginForm" novalidate>

                <div class="form-group">
                    <label class="form-label" for="username">Identifiant</label>
                    <div class="input-wrapper">
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-control"
                            placeholder="votre_identifiant"
                            autocomplete="username"
                            required
                            value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                        >
                        <i class="fa-regular fa-user input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control has-toggle"
                            placeholder="••••••••••••"
                            autocomplete="current-password"
                            required
                        >
                        <i class="fa-solid fa-key input-icon"></i>
                        <button type="button" class="toggle-password" aria-label="Afficher/masquer le mot de passe" id="togglePwd">
                            <i class="fa-regular fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="submitBtn">
                    <span class="btn-text">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Se connecter
                    </span>
                    <span class="btn-loader" aria-hidden="true">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </span>
                </button>

            </form>

            <!-- Footer carte -->
            <footer class="card-footer">
                <a href="../index.php" class="back-link">
                    <i class="fa-solid fa-arrow-left"></i>
                    Retour au site
                </a>
                <a href="forgot_password.php" class="forgot-link">
                    <i class="fa-solid fa-key"></i>
                    Mot de passe oublié ?
                </a>
            </footer>
        </div>

        <!-- Copyright -->
        <p class="page-copyright">
            © <?php echo date('Y'); ?> <span>PêlêTech Nexus</span> · Tous droits réservés
        </p>
    </main>

    <script>
        // ======= Particules flottantes =======
        (function() {
            const container = document.getElementById('particles');
            if (!container) return;
            const colors = ['#8A6FE8', '#4FA3D9', '#A28CF8', '#5B3FBF'];
            const count = 22;

            for (let i = 0; i < count; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                const size = Math.random() * 4 + 2;
                const x = Math.random() * 100;
                const bottom = Math.random() * 40;
                const dur = (Math.random() * 6 + 5) + 's';
                const delay = -(Math.random() * 8) + 's';
                p.style.cssText = `
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}%;
                    bottom: ${bottom}%;
                    background: ${colors[Math.floor(Math.random() * colors.length)]};
                    --dur: ${dur};
                    --delay: ${delay};
                `;
                container.appendChild(p);
            }
        })();

        // ======= Toggle mot de passe =======
        const toggleBtn = document.getElementById('togglePwd');
        const pwdField  = document.getElementById('password');
        const eyeIcon   = document.getElementById('eyeIcon');

        toggleBtn.addEventListener('click', () => {
            const isHidden = pwdField.type === 'password';
            pwdField.type  = isHidden ? 'text' : 'password';
            eyeIcon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });

        // ======= Loading state sur submit =======
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('submitBtn');
            // Validation basique
            const username = document.getElementById('username').value.trim();
            const password = pwdField.value.trim();
            if (!username || !password) return;

            // Délai visuel pour le feedback
            setTimeout(() => btn.classList.add('loading'), 10);
        });

        // ======= Animation d'entrée des champs (stagger) =======
        const groups = document.querySelectorAll('.form-group, .btn-login, .card-footer');
        groups.forEach((el, i) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(16px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            setTimeout(() => {
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 350 + i * 90);
        });
    </script>
</body>
</html>