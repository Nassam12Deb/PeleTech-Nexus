<?php include 'header.php';

// Récupérer les crédibilités
$credibilites = $pdo->query("SELECT * FROM blocs_contenu WHERE type = 'credibilite' ORDER BY ordre")->fetchAll();
// Récupérer les témoignages publiés
$temoignages = $pdo->query("SELECT * FROM temoignages WHERE statut = 'publie' ORDER BY ordre")->fetchAll();
// Récupérer les services (pour la preview, on prend les 4 premiers)
$services = $pdo->query("SELECT * FROM services ORDER BY ordre LIMIT 4")->fetchAll();
?>

<!-- CSS pour l'alignement des boutons et le carrousel (repris du design) -->
<style>
    /* === ALIGNEMENT FORCÉ DES BOUTONS DÉCOUVRIR === */
    #services-preview .grid {
        grid-auto-rows: 1fr;
    }

    #services-preview .card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    #services-preview .card p {
        flex-grow: 1;
        margin-bottom: 1rem;
    }

    #services-preview .card .btn {
        margin-top: auto !important;
        align-self: flex-start;
    }

    /* ===== SECTION TÉMOIGNAGES - CARROUSEL ===== */
    .carousel-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        margin-top: 2rem;
    }

    .carousel-container {
        width: 100%;
        overflow-x: auto !important;
        overflow-y: hidden;
        scroll-behavior: smooth;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .carousel-container::-webkit-scrollbar {
        display: none;
    }

    .carousel-track {
        display: flex;
        align-items: stretch;
        flex-wrap: nowrap !important;
        gap: 1.5rem;
    }

    .carousel-track .card {
        flex: 0 0 calc(33.333% - 1rem);
        min-width: 250px;
        height: 300px !important;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        background: var(--bg-dark);
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
        margin-top: 10px;
    }

    .carousel-track .card {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .carousel-track .card::-webkit-scrollbar {
        display: none;
    }

    .carousel-track .card div[style*="margin-top: auto"] {
        margin-top: auto !important;
    }

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

    @media (max-width: 992px) {
        .carousel-track .card {
            flex: 0 0 calc(50% - 0.75rem);
        }
    }

    @media (max-width: 576px) {
        .carousel-track .card {
            flex: 0 0 calc(100% - 0rem);
        }
    }
</style>

<!-- Hero Section -->
<section id="hero" class="animate-fade-in">
    <div class="container">
        <div class="grid grid-2">
            <div>
                <h1><?php echo $t['hero_title']; ?></h1>
                <p class="section-subtitle" style="text-align: left; margin-top: 1.5rem; font-size: 1.25rem;">
                    <?php echo $t['hero_subtitle']; ?>
                </p>
                <div class="flex" style="display: flex; gap: 1rem; margin-top: 2.5rem;">
                    <a href="contact.php" class="btn btn-primary btn-large"><?php echo $t['hero_btn_start']; ?></a>
                    <a href="realisations.php"
                        class="btn btn-secondary btn-large"><?php echo $t['hero_btn_projects']; ?></a>
                </div>
            </div>
            <div class="animate-float">
                <div class="card card-gradient"
                    style="height: 300px; display: flex; align-items: center; justify-content: center; border: none; position: relative;">
                    <div
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(138, 111, 232, 0.1), rgba(79, 163, 217, 0.1)); border-radius: var(--radius-xl);">
                    </div>
                    <div class="icon icon-lg icon-gradient icon-circle" style="z-index: 1;">
                        <img src="assets/img/profil.png" alt="PêlêTech Nexus"
                            style="height: 300px; width: 300px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services clés -->
<section id="services-preview" class="bg-dark-light">
    <div class="container">
        <h2 class="section-title"><?php echo $t['expertise_title']; ?></h2>
        <p class="section-subtitle"><?php echo $t['expertise_subtitle']; ?></p>

        <div class="grid grid-4">
            <?php foreach ($services as $index => $service):
                $titre = (LANG === 'en' && !empty($service['titre_en'])) ? $service['titre_en'] : $service['titre'];
                $description = (LANG === 'en' && !empty($service['description_en'])) ? $service['description_en'] : $service['description'];
                ?>
                <div class="card animate-slide-up" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                    <div class="icon icon-md icon-gradient icon-circle" style="margin-bottom: 1.5rem;">
                        <i class="fas <?php echo htmlspecialchars($service['icone']); ?>"></i>
                    </div>
                    <h3><?php echo htmlspecialchars($titre); ?></h3>
                    <p style="color: var(--light-secondary);"><?php echo htmlspecialchars($description); ?></p>
                    <a href="services.php#<?php echo $service['categorie']; ?>"
                        class="btn btn-small btn-secondary"><?php echo $t['btn_discover']; ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Preuves de crédibilité -->
<section id="credibilite" class="bg-darker">
    <div class="container">
        <h2 class="section-title"><?php echo $t['credibility_title']; ?></h2>
        <p class="section-subtitle"><?php echo $t['credibility_subtitle']; ?></p>

        <div class="grid grid-4" style="text-align: center;">
            <?php foreach ($credibilites as $cred):
                $titre = (LANG === 'en' && !empty($cred['titre_en'])) ? $cred['titre_en'] : $cred['titre'];
                $description = (LANG === 'en' && !empty($cred['description_en'])) ? $cred['description_en'] : $cred['description'];
                ?>
                <div>
                    <h3 class="text-gradient-secondary" style="font-size: 1.75rem; margin-bottom: 0.75rem;">
                        <?php echo htmlspecialchars($titre); ?>
                    </h3>
                    <p style="color: var(--light-secondary);"><?php echo htmlspecialchars($description); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Section Témoignages - Carrousel -->
<section id="temoignages" class="bg-dark-light">
    <div class="container" style="position: relative;">
        <h2 class="section-title"><?php echo $t['testimonials_title']; ?></h2>
        <p class="section-subtitle"><?php echo $t['testimonials_subtitle']; ?></p>

        <div class="carousel-wrapper">
            <button class="carousel-arrow left-arrow hidden" aria-label="Témoignages précédents">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="carousel-container">
                <div class="carousel-track">
                    <?php foreach ($temoignages as $temoignage):
                        $auteur = (LANG === 'en' && !empty($temoignage['auteur_en'])) ? $temoignage['auteur_en'] : $temoignage['auteur'];
                        $fonction = (LANG === 'en' && !empty($temoignage['fonction_en'])) ? $temoignage['fonction_en'] : $temoignage['fonction'];
                        $texte = (LANG === 'en' && !empty($temoignage['texte_en'])) ? $temoignage['texte_en'] : $temoignage['texte'];
                        ?>
                        <div class="card" style="display: flex; flex-direction: column; height: 100%;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                                <?php if (!empty($temoignage['photo'])): ?>
                                    <img src="<?php echo BASE_URL . $temoignage['photo']; ?>"
                                        alt="<?php echo htmlspecialchars($auteur); ?>"
                                        style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                                <?php else: ?>
                                    <div class="icon icon-md icon-gradient icon-circle">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <h4 style="margin: 0; color: var(--light);"><?php echo htmlspecialchars($auteur); ?>
                                    </h4>
                                    <p style="margin: 0; color: var(--primary);"><?php echo htmlspecialchars($fonction); ?>
                                    </p>
                                </div>
                            </div>
                            <p style="color: var(--light-secondary); font-style: italic;">
                                "<?php echo htmlspecialchars($texte); ?>"</p>
                            <div style="display: flex; gap: 0.4rem; color: var(--primary); margin-top: auto;">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $temoignage['note'] ? '' : 'fa-regular'; ?>"
                                        style="<?php echo $i <= $temoignage['note'] ? '' : 'opacity:0.3;'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button class="carousel-arrow right-arrow" aria-label="Témoignages suivants">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
    <!-- Lien pour ajouter un témoignage -->
    <div style="text-align: center; margin-top: 2rem;">
        <a href="ajouter-temoignage.php" class="btn btn-secondary btn-small">
            <i class="fas fa-pen"></i> <?php echo $t['add_testimonial']; ?>
        </a>
    </div>
</section>

<!-- CTA final -->
<section id="cta-final" class="bg-darker">
    <div class="container">
        <div class="card card-gradient"
            style="text-align: center; padding: 4rem 2rem; border: 1px solid rgba(138, 111, 232, 0.3);">
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: var(--light);"><?php echo $t['cta_title']; ?></h2>
            <p class="section-subtitle" style="margin-bottom: 2.5rem; color: var(--light-secondary);">
                <?php echo $t['cta_subtitle']; ?>
            </p>
            <a href="contact.php" class="btn btn-primary btn-large"><?php echo $t['cta_btn']; ?></a>
        </div>
    </div>
</section>

<!-- Script du carrousel (identique au design) -->
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

            leftArrow.classList.toggle('hidden', scrollLeft <= 5);

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
                leftArrow.classList.add('hidden');
                rightArrow.classList.remove('hidden');
            }

            container.addEventListener('scroll', updateArrows);
            window.addEventListener('resize', function () {
                if (track.children.length <= getVisibleCards()) {
                    leftArrow.classList.add('hidden');
                    rightArrow.classList.add('hidden');
                } else {
                    updateArrows();
                }
            });

            leftArrow.addEventListener('click', function () { scroll('left'); });
            rightArrow.addEventListener('click', function () { scroll('right'); });
        }

        init();
    });
</script>

<?php include 'footer.php'; ?>