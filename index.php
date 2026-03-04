<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PêlêTech Nexus | Développement web, UI/UX et applications frontend</title>
    <meta name="description"
        content="PêlêTech Nexus conçoit des sites web modernes, des interfaces UI/UX et des applications frontend pensées pour la performance, la clarté et l’évolution.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="assets/logo.svg">

    <style>
        /* === ALIGNEMENT FORCÉ DES BOUTONS DÉCOUVRIR === */
        #services-preview .grid {
            grid-auto-rows: 1fr;
        }

        #services-preview .card {
            display: flex;
            flex-direction: column;O
            height: 100%;
        }

        #services-preview .card p {
            flex-grow: 1;
            margin-bottom: 1rem;
            /* optionnel : espace avant le bouton */
        }

        #services-preview .card .btn {
            margin-top: auto !important;
            /* écrase le style inline */
            align-self: flex-start;
        }

        /* ===== SECTION TÉMOIGNAGES - CARROUSEL ===== */

        /* Conteneur général du carrousel */
        .carousel-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            margin-top: 2rem;
        }

        /* Zone de défilement */
        .carousel-container {
            width: 100%;
            overflow-x: auto !important;
            overflow-y: hidden;
            scroll-behavior: smooth;
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE/Edge */
        }

        .carousel-container::-webkit-scrollbar {
            display: none;
            /* Chrome/Safari */
        }

        /* Piste du carrousel (les cartes sont en ligne) */
        .carousel-track {
            display: flex;
            align-items: stretch;
            /* Égalise la hauteur des cartes */
            flex-wrap: nowrap !important;
            gap: 1.5rem;
        }

        /* ----- CARTES DU CARROUSEL (hauteur fixe) ----- */
        .carousel-track .card {
            flex: 0 0 calc(33.333% - 1rem);
            /* 3 cartes visibles */
            min-width: 250px;
            height: 300px !important;
            /* Hauteur fixe (ajustable) */
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            /* Scroll si texte trop long */

            /* Héritage du design de base (défini dans style.css) */
            background: var(--bg-dark);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            margin-top: 10px;
        }

        /* Masquer la scrollbar tout en gardant le défilement */
        .carousel-track .card {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .carousel-track .card::-webkit-scrollbar {
            display: none;
        }

        /* Étoiles : toujours en bas */
        .carousel-track .card div[style*="margin-top: auto"] {
            margin-top: auto !important;
            /* Assure le collage en bas */
        }

        /* ----- FLÈCHES DE NAVIGATION ----- */
        .carousel-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, opacity 0.3s;
            z-index: 10;
        }

        .carousel-arrow:hover {
            background: var(--primary-dark);
        }

        .carousel-arrow i {
            font-size: 1.2rem;
        }

        .left-arrow {
            left: -20px;
        }

        .right-arrow {
            right: -20px;
        }

        .hidden {
            display: none !important;
        }

        /* ----- RESPONSIVE ----- */
        @media (max-width: 992px) {
            .carousel-track .card {
                flex: 0 0 calc(50% - 0.75rem);
                /* 2 cartes visibles */
            }
        }

        @media (max-width: 576px) {
            .carousel-track .card {
                flex: 0 0 calc(100% - 0rem);
                /* 1 carte visible */
            }
        }
    </style>
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
                <li><a href="index.php" class="nav-link active">Accueil</a></li>
                <li><a href="services.php" class="nav-link">Services</a></li>
                <li><a href="realisations.php" class="nav-link">Réalisations</a></li>
                <li><a href="process.php" class="nav-link">Processus</a></li>
                <li><a href="apropos.php" class="nav-link">À propos</a></li>
                <li><a href="contact.php" class="nav-link cta-nav">Démarrer un projet</a></li>
            </ul>
        </div>
    </nav>

    <!-- Barre de progression -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Skip link pour accessibilité -->
    <a href="#main-content" class="skip-link">Aller au contenu principal</a>

    <!-- Hero Section -->
    <section id="hero" class="animate-fade-in">
        <div class="container">
            <div class="grid grid-2">
                <div>
                    <h1>Votre partenaire pour des solutions digitales impactantes</h1>
                    <p class="section-subtitle" style="text-align: left; margin-top: 1.5rem; font-size: 1.25rem;">
                        Nous concevons des solutions digitales claires, modernes et orientées utilisateur.
                        Du site web à l’interface mobile, chaque projet est pensé pour être utile,
                        compréhensible et durable.
                    </p>
                    <div class="flex" style="display: flex; gap: 1rem; margin-top: 2.5rem;">
                        <a href="contact.php" class="btn btn-primary btn-large">Démarrer un projet</a>
                        <a href="realisations.php" class="btn btn-secondary btn-large">Voir nos réalisations</a>
                    </div>
                </div>
                <div class="animate-float">
                    <div class="card card-gradient"
                        style="height: 300px; display: flex; align-items: center; justify-content: center; border: none; position: relative;">
                        <div
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(138, 111, 232, 0.1), rgba(79, 163, 217, 0.1)); border-radius: var(--radius-xl);">
                        </div>
                        <div class="icon icon-lg icon-gradient icon-circle" style="z-index: 1;">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services clés -->
    <section id="services-preview" class="bg-dark-light">
        <div class="container">
            <h2 class="section-title">Notre expertise digitale</h2>
            <p class="section-subtitle">Nous transformons vos idées en expériences digitales performantes et
                esthétiques.</p>

            <div class="grid grid-4">
                <div class="card animate-slide-up">
                    <div class="icon icon-md icon-gradient icon-circle" style="margin-bottom: 1.5rem;">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Sites Web Modernes</h3>
                    <p style="color: var(--light-secondary);">Création de sites web modernes, rapides et responsives,
                        pensés pour valoriser votre image et rassurer vos visiteurs.
                    </p>
                    <a href="services.php#web" class="btn btn-small btn-secondary" style="margin-top: 1rem;">Découvrir
                        →</a>
                </div>

                <div class="card animate-slide-up" style="animation-delay: 0.1s;">
                    <div class="icon icon-md icon-gradient icon-circle" style="margin-bottom: 1.5rem;">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3>UI/UX Design</h3>
                    <p style="color: var(--light-secondary);">Design d’interfaces intuitives centrées sur l’utilisateur,
                        pour améliorer la compréhension, la navigation et l’engagement.</p>
                    <a href="services.php#design" class="btn btn-small btn-secondary"
                        style="margin-top: 1rem;">Découvrir →</a>
                </div>

                <div class="card animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="icon icon-md icon-gradient icon-circle" style="margin-bottom: 1.5rem;">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Applications Mobile</h3>
                    <p style="color: var(--light-secondary);">Développement frontend d’applications Android avec des
                        interfaces
                        fluides, cohérentes et adaptées aux usages réels.
                    </p>
                    <a href="services.php#mobile" class="btn btn-small btn-secondary"
                        style="margin-top: 1rem;">Découvrir →</a>
                </div>

                <div class="card animate-slide-up" style="animation-delay: 0.3s;">
                    <div class="icon icon-md icon-gradient icon-circle" style="margin-bottom: 1.5rem;">
                        <i class="fas fa-file-image"></i>
                    </div>
                    <h3>Supports Visuels</h3>
                    <p style="color: var(--light-secondary);">Création de supports visuels clairs et percutants,
                        alignés avec votre identité et vos objectifs de communication.
                    </p>
                    <a href="services.php#visuels" class="btn btn-small btn-secondary"
                        style="margin-top: 1rem;">Découvrir →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Preuves de crédibilité -->
    <section id="credibilite" class="bg-darker">
        <div class="container">
            <h2 class="section-title">Une approche fondée sur la rigueur et la constance
            </h2>
            <p class="section-subtitle">Des projets menés avec méthode, clarté et engagement
            </p>

            <div class="grid grid-4" style="text-align: center;">
                <div>
                    <h3 class="text-gradient-secondary" style="font-size: 1.75rem; margin-bottom: 0.75rem;">Projets
                        réalisés
                    </h3>
                    <p style="color: var(--light-secondary); ">Projets personnels et professionnels menés de bout en
                        bout,
                        du cadrage initial à la mise en ligne ou à la livraison finale.</p>
                </div>
                <div>
                    <h3 class="text-gradient-secondary" style="font-size: 1.75rem; margin-bottom: 0.75rem;">Approche
                        orientée qualité</h3>
                    <p style="color: var(--light-secondary);">Chaque décision est guidée par l'expérience utilisateur,
                        la lisibilité des interfaces et la cohérence technique globale.</p>
                </div>
                <div>
                    <h3 class="text-gradient-secondary" style="font-size: 1.75rem; margin-bottom: 0.75rem;">Pratique
                        continue</h3>
                    <p style="color: var(--light-secondary);">Amélioration continue des compétences techniques et de
                        conception
                        à travers la veille, l'expérimentation et les retours terrain.</p>
                </div>
                <div>
                    <h3 class="text-gradient-secondary" style="font-size: 1.75rem; margin-bottom: 0.75rem;">Engagement
                        et
                        fiabilité</h3>
                    <p style="color: var(--light-secondary);">Chaque projet est suivi avec sérieux, transparence
                        et respect strict des délais annoncés.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Témoignages - Carrousel (design original conservé) -->
    <section id="temoignages" class="bg-dark-light">
        <div class="container" style="position: relative;">
            <h2 class="section-title">Ils nous font confiance</h2>
            <p class="section-subtitle">Découvrez ce que nos clients disent de notre collaboration.</p>

            <!-- Carrousel wrapper -->
            <div class="carousel-wrapper">
                <!-- Flèche gauche (cachée au départ) -->
                <button class="carousel-arrow left-arrow hidden" aria-label="Témoignages précédents">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <!-- Conteneur du défilement -->
                <div class="carousel-container">
                    <div class="carousel-track">

                        <!-- Carte 1 (icône) -->
                        <div class="card" style="display: flex; flex-direction: column; height: 100%;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                                <div class="icon icon-md icon-gradient icon-circle">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div>
                                    <h4 style="margin: 0; color: var(--light);">Jean Dupont</h4>
                                    <p style="margin: 0; color: var(--primary);">CEO, Entreprise X</p>
                                </div>
                            </div>
                            <p style="color: var(--light-secondary); font-style: italic;">
                                "PêlêTech Nexus a su comprendre nos besoins et livrer une solution performante dans les
                                délais. Un partenariat de confiance."
                            </p>
                            <!-- Étoiles avec margin-top: auto (poussées en bas) -->
                            <div style="display: flex; gap: 0.4rem; color: var(--primary); margin-top: auto;">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>

                        <!-- Carte 2 (photo) -->
                        <div class="card" style="display: flex; flex-direction: column; height: 100%;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                                <img src="assets/logo.png" alt="Photo de Jean Dupont"
                                    style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                                <div>
                                    <h4 style="margin: 0; color: var(--light);">Jean Dupont</h4>
                                    <p style="margin: 0; color: var(--primary);">CEO, Entreprise X</p>
                                </div>
                            </div>
                            <p style="color: var(--light-secondary); font-style: italic;">
                                "PêlêTech Nexus a su comprendre nos besoins et livrer une solution performante dans les
                                délais. Un partenariat de confiance."
                            </p>
                            <div style="display: flex; gap: 0.4rem; color: var(--primary); margin-top: auto;">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>

                        <!-- Carte 3 (icône) -->
                        <div class="card" style="display: flex; flex-direction: column; height: 100%;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                                <div class="icon icon-md icon-gradient icon-circle">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div>
                                    <h4 style="margin: 0; color: var(--light);">Marie Curie</h4>
                                    <p style="margin: 0; color: var(--primary);">CTO, Startup Y</p>
                                </div>
                            </div>
                            <p style="color: var(--light-secondary); font-style: italic;">
                                "Une collaboration fluide et efficace. PêlêTech Nexus a su nous accompagner avec
                                expertise et réactivité."
                            </p>
                            <div style="display: flex; gap: 0.4rem; color: var(--primary); margin-top: auto;">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>

                        <!-- Carte 4 (exemple) -->
                        <div class="card" style="display: flex; flex-direction: column; height: 100%;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                                <div class="icon icon-md icon-gradient icon-circle">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div>
                                    <h4 style="margin: 0; color: var(--light);">Albert Einstein</h4>
                                    <p style="margin: 0; color: var(--primary);">Scientifique, Lab Z</p>
                                </div>
                            </div>
                            <p style="color: var(--light-secondary); font-style: italic;">
                                "Une équipe à l'écoute, des solutions innovantes. Je recommande vivement."
                            </p>
                            <div style="display: flex; gap: 0.4rem; color: var(--primary); margin-top: auto;">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                        </div>
                        <!-- Ajoutez autant de cartes que nécessaire -->
                    </div>
                </div>

                <!-- Flèche droite -->
                <button class="carousel-arrow right-arrow" aria-label="Témoignages suivants">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- CTA final -->
    <section id="cta-final" class="bg-darker">
        <!--  style="background: linear-gradient(135deg, rgba(138, 111, 232, 0.1), rgba(79, 163, 217, 0.1));" -->
        <div class="container">
            <div class="card card-gradient"
                style="text-align: center; padding: 4rem 2rem; border: 1px solid rgba(138, 111, 232, 0.3);">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--light);">Prêt à concrétiser votre projet
                    ?</h2>
                <p class="section-subtitle" style="margin-bottom: 2.5rem; color: var(--light-secondary);">Discutons de
                    vos besoins et objectifs pour vous proposer une solution sur mesure.</p>
                <a href="contact.php" class="btn btn-primary btn-large">Discutons de votre projet</a>
            </div>
        </div>
    </section>

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
                        <li style="color: var(--gray-light);">Email: contact@peletech-nexus.com</li>
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

    <!-- Back to top -->
    <button class="back-to-top" id="backToTop" aria-label="Retour en haut">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- JavaScript -->
    <script src="js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.querySelector('.carousel-container');
            const track = document.querySelector('.carousel-track');
            const leftArrow = document.querySelector('.left-arrow');
            const rightArrow = document.querySelector('.right-arrow');

            if (!container || !track || !leftArrow || !rightArrow) return;

            function getVisibleCards() {
                if (window.innerWidth <= 576) return 1;
                if (window.innerWidth <= 992) return 2;
                return 3;
            }

            function updateArrows() {
                const scrollLeft = container.scrollLeft;
                const scrollWidth = container.scrollWidth;
                const clientWidth = container.clientWidth;
                const visibleCards = getVisibleCards();
                const totalCards = track.children.length;

                // Afficher/masquer flèche gauche
                leftArrow.classList.toggle('hidden', scrollLeft <= 5);

                // Afficher flèche droite si contenu masqué ET plus de cartes que visible
                const atEnd = scrollLeft + clientWidth >= scrollWidth - 5;
                const hasHidden = totalCards > visibleCards;
                rightArrow.classList.toggle('hidden', atEnd || !hasHidden);
            }

            function scroll(direction) {
                const card = track.querySelector('.card');
                if (!card) return;

                const cardWidth = card.offsetWidth;
                const gap = parseFloat(window.getComputedStyle(track).columnGap) || 0;
                const scrollAmount = cardWidth + gap;

                if (direction === 'left') {
                    container.scrollLeft -= scrollAmount;
                } else {
                    container.scrollLeft += scrollAmount;
                }
            }

            function init() {
                const totalCards = track.children.length;
                const visibleCards = getVisibleCards();

                if (totalCards <= visibleCards) {
                    leftArrow.classList.add('hidden');
                    rightArrow.classList.add('hidden');
                } else {
                    leftArrow.classList.add('hidden'); // départ tout à gauche
                    rightArrow.classList.remove('hidden');
                }

                container.addEventListener('scroll', updateArrows);
                window.addEventListener('resize', function () {
                    // Réinitialise l'affichage des flèches selon nouvelle largeur
                    if (track.children.length <= getVisibleCards()) {
                        leftArrow.classList.add('hidden');
                        rightArrow.classList.add('hidden');
                    } else {
                        updateArrows(); // conserve l'état du défilement
                    }
                });

                leftArrow.addEventListener('click', function () { scroll('left'); });
                rightArrow.addEventListener('click', function () { scroll('right'); });
            }

            init();
        });
    </script>
</body>

</html>