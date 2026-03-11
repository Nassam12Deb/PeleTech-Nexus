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
        <section id="contact-form" class="bg-dark-light">
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
                                    J'accepte la <a href="confidentialite.php">politique de confidentialité</a>
                                </label>
                            </div>

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
                                        contact.pelenexus@gmail.com<br>
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
        <section id="faq">
            <div class="container">
                <h2 class="section-title">Questions fréquentes</h2>
                <p class="section-subtitle">Trouvez rapidement des réponses à vos interrogations les plus courantes.</p>

                <div class="grid grid-2" style="margin-top: 3rem;">
                    <div class="card">
                        <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-clock"></i> Combien
                            de temps prend un projet ?</h4>
                        <p style="color: var(--light-secondary);">La durée dépend du périmètre et de la complexité du
                            projet.
                            Un projet simple peut être livré en quelques semaines, tandis qu'une solution plus complète
                            nécessite plusieurs phases réparties sur plusieurs mois.

                            Un planning clair est toujours défini après l'analyse initiale.</p>
                    </div>

                    <div class="card">
                        <h4 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-euro-sign"></i>
                            Quelle est votre fourchette de prix ?</h4>
                        <p style="color: var(--light-secondary);">Les tarifs varient selon les objectifs, le périmètre
                            et les contraintes du projet.
                            Chaque mission fait l'objet d'une analyse préalable et d'un devis personnalisé.

                            L'objectif est de proposer une solution cohérente, durable et adaptée à vos enjeux.</p>
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
                            d'assurer la stabilité
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
                        <a href="https://www.facebook.com/people/PêlêTech-Nexus/61582899320642/</a>" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/peledebnassam" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.instagram.com/peledebnassam?igsh=MTIycDV5eGZ6dmR2Mw==" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
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
                        <li style="color: var(--gray-light);">Email: contact.pelenexus@gmail.com</li>
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

    <!--
        ORDRE DE CHARGEMENT DES SCRIPTS :
        1. main.js       — navigation, scroll, animations (sans formulaire)
        2. email-service.js — service d'envoi EmailJS + validation
        3. contact-form.js  — gestionnaire unique du formulaire (nouveau)
        Le <script> inline qui gérait le formulaire a été supprimé.
    -->
    <script src="js/main.js"></script>
    <script src="js/email-service.js"></script>
    <script src="js/contact-form.js"></script>
</body>

</html>