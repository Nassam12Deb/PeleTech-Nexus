<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | PêlêTech Nexus</title>
    <meta name="description"
        content="Contactez PêlêTech Nexus pour discuter de votre projet numérique. Réponse garantie sous 24 heures.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="assets/logo.svg">
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">PêlêTech Nexus</a>

            <button class="menu-toggle" id="menuToggle" aria-label="Menu">
                <span class="icon"><i class="fas fa-bars"></i></span>
            </button>

            <ul class="nav-menu" id="navMenu">
                <li><a href="index.php" class="nav-link">Accueil</a></li>
                <li><a href="services.php" class="nav-link">Services</a></li>
                <li><a href="realisations.php" class="nav-link">Réalisations</a></li>
                <li><a href="process.php" class="nav-link">Processus</a></li>
                <li><a href="apropos.php" class="nav-link">À propos</a></li>
                <li><a href="contact.php" class="nav-link active cta-nav">Démarrer un projet</a></li>
            </ul>
        </div>
    </nav>

    <div class="scroll-progress" id="scrollProgress"></div>
    <a href="#main-content" class="skip-link">Aller au contenu principal</a>

    <main id="main-content">
        <!-- Hero Contact -->
        <section id="contact-hero" class="animate-fade-in">
            <div class="container">
                <h1 class="section-title">Parlons de votre projet</h1>
                <p class="section-subtitle">Une idée ? Un besoin spécifique ? Discutons-en pour créer la solution
                    numérique qui correspond parfaitement à vos objectifs.</p>
            </div>
        </section>

        <!-- Formulaire de contact -->
        <!-- Formulaire de contact -->
        <section id="contact-form">
            <div class="container">
                <div class="grid grid-2">
                    <div>
                        <h2 style="margin-bottom: 0.5rem; color: var(--light);">Contactez-nous</h2>
                        <p style="color: var(--gray-light); margin-bottom: 2rem;">Réponse garantie sous 24 heures
                            ouvrables</p>

                        <form id="contactForm" class="animate-slide-up">
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <span style="color: var(--primary);">•</span>
                                    Nom complet
                                </label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <span style="color: var(--primary);">•</span>
                                    Email professionnel
                                </label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="vous@entreprise.com" required>
                            </div>

                            <div class="form-group">
                                <label for="company" class="form-label">
                                    <span style="color: var(--secondary);">•</span>
                                    Entreprise
                                </label>
                                <input type="text" id="company" name="company" class="form-control"
                                    placeholder="Votre entreprise">
                            </div>

                            <div class="form-group">
                                <label for="service" class="form-label">
                                    <span style="color: var(--primary);">•</span>
                                    Service concerné
                                </label>
                                <select id="service" name="service" class="form-control" required>
                                    <option value="" disabled selected>Sélectionnez un service</option>
                                    <option value="web">Développement Web</option>
                                    <option value="mobile">Applications Mobile</option>
                                    <option value="design">UI/UX Design</option>
                                    <option value="accompagnement">Accompagnement Digital</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message" class="form-label">
                                    <span style="color: var(--primary);">•</span>
                                    Détails du projet
                                </label>
                                <textarea id="message" name="message" class="form-control"
                                    placeholder="Décrivez votre projet, vos objectifs et vos contraintes..." rows="6"
                                    required></textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label"
                                    style="font-weight: normal; font-size: 0.9rem; color: var(--light-secondary);">
                                    <input type="checkbox" id="privacy" name="privacy" required
                                        style="margin-right: 0.5rem; accent-color: var(--primary);">
                                    J'accepte la politique de confidentialité
                                </label>
                            </div>

                            <input type="hidden" id="date" name="date">
                            <input type="hidden" id="page" name="page" value="Contact - PêlêTech Nexus">
                            <input type="hidden" id="user_agent" name="user_agent">
                            <input type="hidden" id="referrer" name="referrer">

                            <button type="submit" class="btn btn-primary btn-full" id="submitBtn">
                                <span id="submitText">Envoyer la demande</span>
                                <div id="submitSpinner" class="spinner"
                                    style="display: none; width: 20px; height: 20px;"></div>
                            </button>

                            <div id="formMessage"
                                style="display: none; margin-top: 1rem; padding: 1rem; border-radius: var(--radius-md);">
                            </div>
                        </form>
                    </div>

                    <div class="card card-gradient">
                        <div style="padding: 2rem;">
                            <h3 style="margin-bottom: 1.5rem; color: var(--light);">Informations complémentaires</h3>

                            <div
                                style="margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(138, 111, 232, 0.2);">
                                <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Délais de réponse</h4>
                                <p style="color: var(--light-secondary);">Nous nous engageons à vous répondre sous <span
                                        style="color: var(--light); font-weight: 600;">24 heures ouvrables</span>.</p>
                            </div>

                            <div
                                style="margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(138, 111, 232, 0.2);">
                                <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Premier contact</h4>
                                <p style="color: var(--light-secondary);">La première consultation (30 min) est <span
                                        style="color: var(--light); font-weight: 600;">gratuite et sans
                                        engagement</span>.</p>
                            </div>

                            <div
                                style="margin-bottom: 2rem; padding-bottom: 1.5rem; border-bottom: 1px solid rgba(138, 111, 232, 0.2);">
                                <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Contact alternatif</h4>
                                <p style="color: var(--light-secondary);">Pour une réponse plus rapide :</p>
                                <div
                                    style="background: rgba(138, 111, 232, 0.1); padding: 1rem; border-radius: var(--radius-md); margin-top: 0.75rem;">
                                    <p style="color: var(--light); margin: 0;">
                                        <span style="color: var(--primary); font-weight: 600;"><i
                                                class="fas fa-envelope"></i> Email :</span>
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3e5d51504a5f5d4a7e4e5b525b4a5b5d5613505b464b4d105d5153">[email&#160;protected]</a><br>
                                        <span style="color: var(--secondary); font-weight: 600;"><i
                                                class="fab fa-whatsapp"></i> WhatsApp :</span> +229 01 57 47 57 50
                                    </p>
                                </div>
                            </div>

                            <div
                                style="background: rgba(138, 111, 232, 0.1); padding: 1.5rem; border-radius: var(--radius-lg);">
                                <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Ce qu'il faut préparer</h4>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <li style="margin-bottom: 0.5rem; padding-left: 1.2rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Vos objectifs principaux</span>
                                    </li>
                                    <li style="margin-bottom: 0.5rem; padding-left: 1.2rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Votre budget approximatif</span>
                                    </li>
                                    <li style="padding-left: 1.2rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                        <span style="color: var(--light-secondary);">Vos délais souhaités</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section id="faq" class="bg-dark-light">
            <div class="container">
                <h2 class="section-title">Questions fréquentes</h2>
                <p class="section-subtitle">Trouvez rapidement des réponses à vos interrogations les plus courantes.</p>

                <div class="grid grid-2" style="margin-top: 3rem;">
                    <div class="card">
                        <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-clock"></i> Combien
                            de temps prend un projet ?</h4>
                        <p style="color: var(--light-secondary);">La durée dépend du périmètre et de la complexité du
                            projet.
                            Un projet simple peut être livré en quelques semaines, tandis qu’une solution plus complète
                            nécessite plusieurs phases réparties sur plusieurs mois.

                            Un planning clair est toujours défini après l’analyse initiale.</p>
                    </div>

                    <div class="card">
                        <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-euro-sign"></i>
                            Quelle est votre fourchette de prix ?</h4>
                        <p style="color: var(--light-secondary);">Les tarifs varient selon les objectifs, le périmètre
                            et les contraintes du projet.
                            Chaque mission fait l’objet d’une analyse préalable et d’un devis personnalisé.

                            L’objectif est de proposer une solution cohérente, durable et adaptée à vos enjeux.</p>
                    </div>

                    <div class="card">
                        <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-globe"></i>
                            Travaillez-vous avec des entreprises internationales ?</h4>
                        <p style="color: var(--light-secondary);">PêlêTech Nexus est basé au Bénin et collabore à
                            distance avec des partenaires et organisations à l'international, notamment aux États-Unis.
                            Nous intervenons sur des missions ciblées telles que la maintenance, les tests, les mises à
                            jour de sites web et la conception de supports de communication, dans un cadre structuré et
                            professionnel.</p>
                    </div>

                    <div class="card">
                        <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-headset"></i>
                            Proposez-vous un support après la livraison ?</h4>
                        <p style="color: var(--light-secondary);">Un accompagnement est prévu après la livraison afin
                            d’assurer la stabilité
                            et la bonne prise en main du projet.

                            Selon les besoins, des options de support et de maintenance peuvent être proposées.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <h4>PêlêTech Nexus</h4>
                    <p style="color: var(--gray-light); margin-bottom: 1.5rem;">Silence structuré. Code incarné. Le
                        sens, sous la surface.</p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=2290165203660" class="social-link"
                            aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="realisations.php">Réalisations</a></li>
                        <li><a href="process.php">Processus</a></li>
                        <li><a href="apropos.php">À propos</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Légal</h4>
                    <ul>
                        <li><a href="mentions-legales.php">Mentions légales</a></li>
                        <li><a href="confidentialite.php">Politique de confidentialité</a></li>
                        <li><a href="cookies.php">Gestion des cookies</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul>
                        <li style="color: var(--gray-light);">Email: <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="9efdf1f0eafffdeadeeefbf2fbeafbfdf6b3f0fbe6ebedb0fdf1f3">[email&#160;protected]</a></li>
                        <li style="color: var(--gray-light);">Réponse sous 24h</li>
                        <li><a href="contact.php">Formulaire de contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p style="color: var(--gray);">&copy; 2026 PêlêTech Nexus. Tous droits réservés.</p>
                <p style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray-light);">Marque fondée et pilotée
                    par Pêlê Deb NASSAM</p>
            </div>
        </div>
    </footer>

    <button class="back-to-top" id="backToTop" aria-label="Retour en haut">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/main.js"></script>
    <script>
        // Gestion améliorée du formulaire de contact
        document.addEventListener('DOMContentLoaded', function () {
            const contactForm = document.getElementById('contactForm');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');

            // Initialiser les champs cachés
            const dateField = document.getElementById('date');
            const userAgentField = document.getElementById('user_agent');
            const referrerField = document.getElementById('referrer');

            if (dateField) dateField.value = new Date().toISOString();
            if (userAgentField) userAgentField.value = navigator.userAgent;
            if (referrerField) referrerField.value = document.referrer || 'Direct';

            if (contactForm) {
                contactForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    let isValid = true;
                    const requiredFields = contactForm.querySelectorAll('[required]');

                    // Réinitialiser les styles d'erreur
                    requiredFields.forEach(field => {
                        field.style.borderColor = '';
                        const errorMsg = field.nextElementSibling;
                        if (errorMsg && errorMsg.classList.contains('error-message')) {
                            errorMsg.remove();
                        }
                    });

                    // Validation
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            field.style.borderColor = 'var(--error)';
                            showError(field, 'Ce champ est obligatoire');
                            isValid = false;
                        }

                        // Validation email spécifique
                        if (field.type === 'email' && field.value) {
                            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailRegex.test(field.value)) {
                                field.style.borderColor = 'var(--error)';
                                showError(field, 'Veuillez entrer une adresse email valide');
                                isValid = false;
                            }
                        }
                    });

                    if (isValid) {
                        // Simulation d'envoi
                        submitText.style.display = 'none';
                        submitSpinner.style.display = 'block';

                        setTimeout(() => {
                            // Message de succès stylisé
                            const successMessage = document.createElement('div');
                            successMessage.style.cssText = `
                                background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.2));
                                border: 1px solid rgba(16, 185, 129, 0.3);
                                border-radius: var(--radius-lg);
                                padding: 1.5rem;
                                margin-top: 1.5rem;
                                color: var(--light);
                                text-align: center;
                            `;
                            successMessage.innerHTML = `
                                <h4 style="color: var(--success); margin-bottom: 0.5rem;"><i class="fas fa-check-circle"></i> Message envoyé avec succès !</h4>
                                <p style="color: var(--light-secondary);">Merci pour votre message. Nous vous répondrons dans les 24h.</p>
                            `;

                            contactForm.parentNode.insertBefore(successMessage, contactForm.nextSibling);
                            contactForm.reset();

                            // Restaurer le bouton
                            submitText.style.display = 'inline';
                            submitSpinner.style.display = 'none';

                            // Supprimer le message après 5 secondes
                            setTimeout(() => {
                                successMessage.style.opacity = '0';
                                successMessage.style.transition = 'opacity 0.5s ease';
                                setTimeout(() => successMessage.remove(), 500);
                            }, 5000);
                        }, 1500);
                    }
                });
            }

            function showError(field, message) {
                const errorMsg = document.createElement('div');
                errorMsg.className = 'error-message';
                errorMsg.style.cssText = `
                    color: var(--error);
 