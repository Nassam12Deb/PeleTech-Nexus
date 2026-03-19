    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <h4><?php echo htmlspecialchars($profil['nom_marque']); ?></h4>
                    <p style="color: var(--gray-light); margin-bottom: 1.5rem;">
                        <?php
                        // Utiliser la version traduite du slogan si disponible
                        $slogan = (LANG === 'en' && !empty($profil['slogan_en'])) ? $profil['slogan_en'] : $profil['slogan'];
                        echo htmlspecialchars($slogan);
                        ?>
                    </p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/people/PêlêTech-Nexus/61582899320642/" class="social-link" aria-label="Facebook">
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
                    <h4><?php echo $t['footer_navigation']; ?></h4>
                    <ul>
                        <li><a href="index.php"><?php echo $t['nav_home']; ?></a></li>
                        <li><a href="services.php"><?php echo $t['nav_services']; ?></a></li>
                        <li><a href="realisations.php"><?php echo $t['nav_realisations']; ?></a></li>
                        <li><a href="blog.php"><?php echo $t['nav_blog']; ?></a></li>
                        <li><a href="process.php"><?php echo $t['nav_process']; ?></a></li>
                        <li><a href="apropos.php"><?php echo $t['nav_about']; ?></a></li>
                        <li><a href="contact.php"><?php echo $t['nav_contact']; ?></a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4><?php echo $t['footer_legal']; ?></h4>
                    <ul>
                        <li><a href="mentions-legales.php">Mentions légales</a></li>
                        <li><a href="confidentialite.php">Politique de confidentialité</a></li>
                        <li><a href="cookies.php">Gestion des cookies</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4><?php echo $t['footer_contact']; ?></h4>
                    <ul>
                        <li style="color: var(--gray-light);"><?php echo $t['footer_email']; ?></li>
                        <li style="color: var(--gray-light);"><?php echo $t['footer_reponse']; ?></li>
                        <li><a href="contact.php"><?php echo $t['contact_form']; ?></a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p style="color: var(--gray);">
                    &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($profil['nom_marque']); ?>. <?php echo $t['footer_copyright']; ?>
                </p>
                <p style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray-light);">
                    <?php echo $t['footer_marque']; ?>
                </p>
            </div>
        </div>
    </footer>

    <!-- Boutons flottants en bas à droite -->
    <div style="position: fixed; bottom: 2rem; right: 2rem; display: flex; flex-direction: column; gap: 0.5rem; z-index: 100;">
        <!-- Bouton de changement de langue -->
        <?php
        $current_url = $_SERVER['REQUEST_URI'];
        $clean_url = preg_replace('/(\?|&)lang=[^&]*/', '', $current_url);
        $separator = (strpos($clean_url, '?') === false) ? '?' : '&';
        $url_fr = $clean_url . $separator . 'lang=fr';
        $url_en = $clean_url . $separator . 'lang=en';
        ?>
        <a href="<?php echo LANG === 'fr' ? $url_en : $url_fr; ?>" 
           style="display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border-radius: 50%; text-decoration: none; font-weight: bold; font-size: 1rem; box-shadow: var(--shadow-primary); transition: transform 0.3s;"
           onmouseover="this.style.transform='translateY(-3px)'" 
           onmouseout="this.style.transform='translateY(0)'"
           title="<?php echo LANG === 'fr' ? 'Switch to English' : 'Passer en français'; ?>">
            <?php echo LANG === 'fr' ? 'EN' : 'FR'; ?>
        </a>

        <!-- Bouton back to top -->
        <button class="back-to-top" id="backToTop" aria-label="Retour en haut" style="display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; border: none; border-radius: 50%; cursor: pointer; box-shadow: var(--shadow-primary); transition: transform 0.3s;">
            <i class="fas fa-chevron-up"></i>
        </button>
    </div>

    <script src="assets/js/main.js"></script>
    <!-- Scripts spécifiques aux pages (contact, galerie) seront inclus dans les pages concernées -->
</body>
</html>