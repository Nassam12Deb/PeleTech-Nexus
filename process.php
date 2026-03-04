<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Process | PêlêTech Nexus</title>
    <meta name="description" content="Découvrez notre méthodologie de travail structurée en 5 étapes pour garantir des résultats prévisibles et de qualité.">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/svg+xml" href="assets/logo.svg">
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
                <li><a href="process.php" class="nav-link active">Processus</a></li>
                <li><a href="apropos.php" class="nav-link">À propos</a></li>
                <li><a href="contact.php" class="nav-link cta-nav">Démarrer un projet</a></li>
            </ul>
        </div>
    </nav>

    <div class="scroll-progress" id="scrollProgress"></div>
    <a href="#main-content" class="skip-link">Aller au contenu principal</a>

    <main id="main-content">
        <!-- Hero Process -->
        <section id="process-hero" class="animate-fade-in">
            <div class="container">
                <h1 class="section-title">Méthodologie éprouvée</h1>
                <p class="section-subtitle">Un process structuré en 5 étapes pour des résultats prévisibles, de qualité et livrés dans les délais.</p>
            </div>
        </section>

        <!-- Timeline / Étapes -->
        <section id="process-timeline">
            <div class="container">
                <div class="grid grid-5" style="gap: 1.5rem; margin-bottom: 4rem;">
                    <div class="card" style="text-align: center; padding: 1.5rem;">
                        <div class="badge badge-secondary" style="margin-bottom: 1rem; font-size: 0.7rem; padding: 0.5rem 0.75rem;">Étape 1</div>
                        <h4 style="color: var(--light); margin-bottom: 0.5rem;">Analyse</h4>
                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Compréhension approfondie</p>
                    </div>
                    
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <div style="width: 30px; height: 2px; background: linear-gradient(135deg, var(--primary), var(--secondary));"></div>
                    </div>
                    
                    <div class="card" style="text-align: center; padding: 1.5rem;">
                        <div class="badge badge-secondary" style="margin-bottom: 1rem; font-size: 0.7rem; padding: 0.5rem 0.75rem;">Étape 2</div>
                        <h4 style="color: var(--light); margin-bottom: 0.5rem;">Conception</h4>
                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Architecture & spécifications</p>
                    </div>
                    
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <div style="width: 30px; height: 2px; background: linear-gradient(135deg, var(--primary), var(--secondary));"></div>
                    </div>
                    
                    <div class="card" style="text-align: center; padding: 1.5rem;">
                        <div class="badge badge-secondary" style="margin-bottom: 1rem; font-size: 0.7rem; padding: 0.5rem 0.75rem;">Étape 3</div>
                        <h4 style="color: var(--light); margin-bottom: 0.5rem;">Développement</h4>
                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Implémentation & tests</p>
                    </div>
                    
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <div style="width: 30px; height: 2px; background: linear-gradient(135deg, var(--primary), var(--secondary));"></div>
                    </div>
                    
                    <div class="card" style="text-align: center; padding: 1.5rem;">
                        <div class="badge badge-secondary" style="margin-bottom: 1rem; font-size: 0.7rem; padding: 0.5rem 0.75rem;">Étape 4</div>
                        <h4 style="color: var(--light); margin-bottom: 0.5rem;">Validation</h4>
                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Tests & ajustements</p>
                    </div>
                    
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <div style="width: 30px; height: 2px; background: linear-gradient(135deg, var(--primary), var(--secondary));"></div>
                    </div>
                    
                    <div class="card" style="text-align: center; padding: 1.5rem;">
                        <div class="badge badge-secondary" style="margin-bottom: 1rem; font-size: 0.7rem; padding: 0.5rem 0.75rem;">Étape 5</div>
                        <h4 style="color: var(--light); margin-bottom: 0.5rem;">Livraison</h4>
                        <p style="color: var(--light-secondary); font-size: 0.9rem;">Déploiement & support</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Étape 1 -->
        <section id="etape-1" class="bg-dark-light">
            <div class="container">
                <div class="grid grid-2">
                    <div>
                        <div class="badge badge-secondary" style="margin-bottom: 1rem;">Étape 1</div>
                        <h2 style="color: var(--light); margin-bottom: 1rem;">Analyse et cadrage</h2>
                        <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                            Nous prenons le temps de comprendre en profondeur vos besoins, objectifs, contraintes et contexte métier.
                        </p>
                        
                        <div style="background: rgba(138, 111, 232, 0.1); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 1.5rem;">
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Livrables</h4>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 0.5rem; padding-left: 1.2rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--light-secondary);">Cahier des charges détaillé</span>
                                </li>
                                <li style="margin-bottom: 0.5rem; padding-left: 1.2rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--light-secondary);">Spécifications fonctionnelles</span>
                                </li>
                                <li style="padding-left: 1.2rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--light-secondary);">Planning et estimation budgétaire</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Durée estimée</h4>
                            <p style="color: var(--light-secondary);">
                                <span style="color: var(--light); font-weight: 600;">1 à 2 semaines</span> selon la complexité du projet
                            </p>
                        </div>
                    </div>
                    
                    <div class="card card-gradient">
                        <div style="padding: 2rem; text-align: center;">
                            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3 style="color: var(--light); margin-bottom: 1rem;">Notre approche</h3>
                            <ul style="list-style: none; padding: 0; text-align: left;">
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">1</span>
                                    <span style="color: var(--light-secondary);">Entretien découverte approfondi</span>
                                </li>
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">2</span>
                                    <span style="color: var(--light-secondary);">Analyse des besoins utilisateurs</span>
                                </li>
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">3</span>
                                    <span style="color: var(--light-secondary);">Étude de faisabilité technique</span>
                                </li>
                                <li style="padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">4</span>
                                    <span style="color: var(--light-secondary);">Proposition détaillée et validation</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Étape 2 -->
        <section id="etape-2">
            <div class="container">
                <div class="grid grid-2">
                    <div class="card card-gradient">
                        <div style="padding: 2rem; text-align: center;">
                            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                <i class="fas fa-ruler-combined"></i>
                            </div>
                            <h3 style="color: var(--light); margin-bottom: 1rem;">Architecture détaillée</h3>
                            <p style="color: var(--light-secondary);">
                                Nous définissons l'architecture technique, les choix technologiques et les spécifications détaillées.
                            </p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="badge badge-secondary" style="margin-bottom: 1rem;">Étape 2</div>
                        <h2 style="color: var(--light); margin-bottom: 1rem;">Conception et architecture</h2>
                        <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                            Transformation des besoins en spécifications techniques détaillées et en architecture solide.
                        </p>
                        
                        <div style="margin-bottom: 2rem;">
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Activités principales</h4>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                    <span style="color: var(--light-secondary);">Design UI/UX et wireframes</span>
                                </li>
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                    <span style="color: var(--light-secondary);">Architecture technique détaillée</span>
                                </li>
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                    <span style="color: var(--light-secondary);">Définition des APIs et bases de données</span>
                                </li>
                                <li style="padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                    <span style="color: var(--light-secondary);">Prototypage et validation</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Durée estimée</h4>
                            <p style="color: var(--light-secondary);">
                                <span style="color: var(--light); font-weight: 600;">2 à 3 semaines</span> pour une conception robuste
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Étape 3 -->
        <section id="etape-3" class="bg-dark-light">
            <div class="container">
                <div class="grid grid-2">
                    <div>
                        <div class="badge badge-secondary" style="margin-bottom: 1rem;">Étape 3</div>
                        <h2 style="color: var(--light); margin-bottom: 1rem;">Développement et tests</h2>
                        <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                            Implémentation rigoureuse avec tests continus et revues de code pour garantir la qualité.
                        </p>
                        
                        <div style="margin-bottom: 2rem;">
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Méthodologie de développement</h4>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--light-secondary);">Développement en sprints de 2 semaines</span>
                                </li>
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--light-secondary);">Tests automatisés (unitaires, intégration)</span>
                                </li>
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--light-secondary);">Revues de code systématiques</span>
                                </li>
                                <li style="padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">•</span>
                                    <span style="color: var(--light-secondary);">Déploiements progressifs</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Communication</h4>
                            <p style="color: var(--light-secondary);">
                                <span style="color: var(--light); font-weight: 600;">Points d'avancement hebdomadaires</span> pour vous tenir informé en temps réel.
                            </p>
                        </div>
                    </div>
                    
                    <div class="card card-gradient">
                        <div style="padding: 2rem; text-align: center;">
                            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h3 style="color: var(--light); margin-bottom: 1rem;">Cycle de développement</h3>
                            <div style="display: flex; justify-content: space-around; margin-top: 1.5rem;">
                                <div style="text-align: center;">
                                    <div style="width: 60px; height: 60px; background: rgba(138, 111, 232, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem;">
                                        <span style="color: var(--primary); font-weight: bold;">Plan</span>
                                    </div>
                                    <p style="color: var(--light-secondary); font-size: 0.9rem;">Planification</p>
                                </div>
                                <div style="text-align: center;">
                                    <div style="width: 60px; height: 60px; background: rgba(138, 111, 232, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem;">
                                        <span style="color: var(--primary); font-weight: bold;">Dev</span>
                                    </div>
                                    <p style="color: var(--light-secondary); font-size: 0.9rem;">Développement</p>
                                </div>
                                <div style="text-align: center;">
                                    <div style="width: 60px; height: 60px; background: rgba(138, 111, 232, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem;">
                                        <span style="color: var(--primary); font-weight: bold;">Test</span>
                                    </div>
                                    <p style="color: var(--light-secondary); font-size: 0.9rem;">Tests</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Étape 4 -->
        <section id="etape-4">
            <div class="container">
                <div class="grid grid-2">
                    <div class="card card-gradient">
                        <div style="padding: 2rem; text-align: center;">
                            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 style="color: var(--light); margin-bottom: 1rem;">Tests exhaustifs</h3>
                            <p style="color: var(--light-secondary);">
                                Nous testons chaque fonctionnalité sous tous les angles pour garantir qualité et fiabilité.
                            </p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="badge badge-secondary" style="margin-bottom: 1rem;">Étape 4</div>
                        <h2 style="color: var(--light); margin-bottom: 1rem;">Validation et ajustements</h2>
                        <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                            Phase de tests intensifs et ajustements pour garantir que le produit correspond parfaitement à vos attentes.
                        </p>
                        
                        <div style="margin-bottom: 2rem;">
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Types de tests effectués</h4>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                                <span class="badge badge-secondary">Tests fonctionnels</span>
                                <span class="badge badge-secondary">Tests de performance</span>
                                <span class="badge badge-secondary">Tests de sécurité</span>
                                <span class="badge badge-secondary">Tests utilisateur</span>
                                <span class="badge badge-secondary">Tests cross-browser</span>
                                <span class="badge badge-secondary">Tests mobile</span>
                            </div>
                        </div>
                        
                        <div>
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Process de validation</h4>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">1</span>
                                    <span style="color: var(--light-secondary);">Tests internes exhaustifs</span>
                                </li>
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">2</span>
                                    <span style="color: var(--light-secondary);">Validation client sur environnement de test</span>
                                </li>
                                <li style="padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">3</span>
                                    <span style="color: var(--light-secondary);">Ajustements et corrections</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Étape 5 -->
        <section id="etape-5" class="bg-dark-light">
            <div class="container">
                <div class="grid grid-2">
                    <div>
                        <div class="badge badge-secondary" style="margin-bottom: 1rem;">Étape 5</div>
                        <h2 style="color: var(--light); margin-bottom: 1rem;">Livraison et accompagnement</h2>
                        <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                            Déploiement en production, formation et support pour garantir une transition sans accroc.
                        </p>
                        
                        <div style="background: rgba(138, 111, 232, 0.1); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 1.5rem;">
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Livrables finaux</h4>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                    <span style="color: var(--light-secondary);">Code source commenté et documenté</span>
                                </li>
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                    <span style="color: var(--light-secondary);">Documentation technique et utilisateur</span>
                                </li>
                                <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                    <span style="color: var(--light-secondary);">Accès aux environnements et credentials</span>
                                </li>
                                <li style="padding-left: 1.5rem; position: relative;">
                                    <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                    <span style="color: var(--light-secondary);">Rapport de livraison complet</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h4 style="color: var(--primary); margin-bottom: 0.75rem;">Support post-livraison</h4>
                            <p style="color: var(--light-secondary);">
                                <span style="color: var(--light); font-weight: 600;">3 mois de support inclus</span> pour toute question ou ajustement mineur.
                            </p>
                        </div>
                    </div>
                    
                    <div class="card card-gradient">
                        <div style="padding: 2rem; text-align: center;">
                            <div class="icon icon-lg icon-gradient icon-circle" style="margin: 0 auto 1.5rem;">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h3 style="color: var(--light); margin-bottom: 1rem;">Suivi et maintenance</h3>
                            <div style="background: rgba(11, 16, 32, 0.5); padding: 1.5rem; border-radius: var(--radius-lg); margin-top: 1.5rem;">
                                <h4 style="color: var(--primary); margin-bottom: 0.5rem;">Options de maintenance</h4>
                                <ul style="list-style: none; padding: 0; margin: 0; text-align: left;">
                                    <li style="margin-bottom: 0.5rem; padding-left: 1.2rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--secondary);">•</span>
                                        <span style="color: var(--light-secondary);">Support technique</span>
                                    </li>
                                    <li style="margin-bottom: 0.5rem; padding-left: 1.2rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--secondary);">•</span>
                                        <span style="color: var(--light-secondary);">Mises à jour de sécurité</span>
                                    </li>
                                    <li style="padding-left: 1.2rem; position: relative;">
                                        <span style="position: absolute; left: 0; color: var(--secondary);">•</span>
                                        <span style="color: var(--light-secondary);">Évolutions fonctionnelles</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section id="process-cta" style="background: linear-gradient(135deg, rgba(138, 111, 232, 0.1), rgba(79, 163, 217, 0.1));">
            <div class="container">
                <div class="grid grid-2">
                    <div class="card" style="background: rgba(11, 16, 32, 0.8); padding: 3rem;">
                        <h2 style="color: var(--light); margin-bottom: 1rem;">Transparence totale</h2>
                        <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                            À chaque étape, vous savez exactement où en est votre projet, avec des points d'avancement réguliers et un accès direct à l'équipe.
                        </p>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                <span style="color: var(--light-secondary);">Tableau de bord en temps réel</span>
                            </li>
                            <li style="margin-bottom: 0.75rem; padding-left: 1.5rem; position: relative;">
                                <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                <span style="color: var(--light-secondary);">Rapports hebdomadaires détaillés</span>
                            </li>
                            <li style="padding-left: 1.5rem; position: relative;">
                                <span style="position: absolute; left: 0; color: var(--primary);">✓</span>
                                <span style="color: var(--light-secondary);">Communication directe avec l'équipe</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="card card-gradient" style="text-align: center; padding: 3rem; display: flex; flex-direction: column; justify-content: center;">
                        <h2 style="color: var(--light); margin-bottom: 1rem;">Prêt à démarrer ?</h2>
                        <p style="color: var(--light-secondary); margin-bottom: 2rem;">
                            Discutons de votre projet et établissons ensemble un planning réaliste et transparent.
                        </p>
                        <a href="contact.php" class="btn btn-primary btn-large">Planifier un appel découverte</a>
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
                    <p style="color: var(--gray-light); margin-bottom: 1.5rem;">Silence structuré. Code incarné. Le sens, sous la surface.</p>
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
                <p style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray-light);">Marque fondée et pilotée par Pêlê Deb NASSAM</p>
            </div>
        </div>
    </footer>

    <button class="back-to-top" id="backToTop" aria-label="Retour en haut">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="js/main.js"></script>
</body>
</html>