<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des cookies | PêlêTech Nexus</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">PêlêTech Nexus</a>
            <a href="index.php" class="btn btn-small btn-secondary"><i class="fas fa-arrow-left"></i> Retour au site</a>
        </div>
    </nav>

    <main class="container" style="padding: 4rem 2rem;">
        <h1 style="color: var(--light); margin-bottom: 1.5rem;"><i class="fas fa-cookie-bite"></i> Gestion des cookies</h1>
        
        <div class="card" style="margin-top: 2rem;">
            <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                <i class="fas fa-calendar-alt"></i> Dernière mise à jour : [Date]
            </p>
            
            <h2 style="color: var(--light); margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);"><i class="fas fa-info-circle"></i> Qu'est-ce qu'un cookie ?</h2>
            <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                Un cookie est un petit fichier texte stocké sur votre appareil lorsque vous visitez un site web. Il permet au site de mémoriser vos actions et préférences pendant un certain temps.
            </p>
            
            <h2 style="color: var(--light); margin-top: 2rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);"><i class="fas fa-cookie"></i> Les cookies que nous utilisons</h2>
            
            <div style="margin-bottom: 2rem;">
                <h3 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-shield-alt"></i> Cookies essentiels</h3>
                <p style="color: var(--light-secondary); margin-bottom: 0.5rem;">
                    Ces cookies sont nécessaires au fonctionnement du site. Ils ne peuvent pas être désactivés.
                </p>
                <div class="card" style="background: rgba(138, 111, 232, 0.05); padding: 1rem; border-left: 4px solid var(--primary);">
                    <p style="color: var(--light-secondary); margin: 0;">
                        <strong style="color: var(--light);"><i class="fas fa-user-circle"></i> Session cookies :</strong> Maintenir votre connexion pendant la navigation
                    </p>
                </div>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <h3 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-chart-line"></i> Cookies analytiques</h3>
                <p style="color: var(--light-secondary); margin-bottom: 0.5rem;">
                    Ces cookies nous aident à comprendre comment les visiteurs interagissent avec notre site.
                </p>
                <div class="card" style="background: rgba(138, 111, 232, 0.05); padding: 1rem; border-left: 4px solid var(--secondary);">
                    <p style="color: var(--light-secondary); margin: 0;">
                        <strong style="color: var(--light);"><i class="fab fa-google"></i> Google Analytics :</strong> Analyse du trafic et des comportements utilisateurs (anonymisé)
                    </p>
                </div>
            </div>
            
            <div style="margin-bottom: 2rem;">
                <h3 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-cogs"></i> Cookies de préférences</h3>
                <p style="color: var(--light-secondary); margin-bottom: 0.5rem;">
                    Ces cookies mémorisent vos choix pour améliorer votre expérience.
                </p>
                <div class="card" style="background: rgba(138, 111, 232, 0.05); padding: 1rem; border-left: 4px solid var(--accent);">
                    <p style="color: var(--light-secondary); margin: 0;">
                        <strong style="color: var(--light);"><i class="fas fa-language"></i> Préférences de langue :</strong> Mémorisation de votre langue préférée
                    </p>
                </div>
            </div>
            
            <h2 style="color: var(--light); margin-top: 2rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);"><i class="fas fa-sliders-h"></i> Gérer vos préférences</h2>
            
            <div class="card" style="background: rgba(18, 23, 42, 0.8); padding: 2rem; margin-bottom: 2rem;">
                <h3 style="color: var(--light); margin-bottom: 1rem;">Paramètres des cookies</h3>
                
                <div style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <div>
                            <h4 style="color: var(--light); margin: 0;"><i class="fas fa-shield-alt"></i> Cookies essentiels</h4>
                            <p style="color: var(--light-secondary); margin: 0; font-size: 0.9rem;">Toujours actifs</p>
                        </div>
                        <div style="width: 50px; height: 25px; background: var(--primary); border-radius: var(--radius-full); display: flex; align-items: center; padding: 0 3px;">
                            <div style="width: 20px; height: 20px; background: var(--light); border-radius: 50%; margin-left: auto;"></div>
                        </div>
                    </div>
                </div>
                
                <div style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--border);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <div>
                            <h4 style="color: var(--light); margin: 0;"><i class="fas fa-chart-line"></i> Cookies analytiques</h4>
                            <p style="color: var(--light-secondary); margin: 0; font-size: 0.9rem;">Améliorer notre site</p>
                        </div>
                        <div style="position: relative;">
                            <input type="checkbox" id="analyticsCookies" checked style="display: none;">
                            <label for="analyticsCookies" style="cursor: pointer;">
                                <div style="width: 50px; height: 25px; background: var(--secondary); border-radius: var(--radius-full); display: flex; align-items: center; padding: 0 3px;">
                                    <div style="width: 20px; height: 20px; background: var(--light); border-radius: 50%; margin-left: auto;"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <div>
                            <h4 style="color: var(--light); margin: 0;"><i class="fas fa-cogs"></i> Cookies de préférences</h4>
                            <p style="color: var(--light-secondary); margin: 0; font-size: 0.9rem;">Personnaliser votre expérience</p>
                        </div>
                        <div style="position: relative;">
                            <input type="checkbox" id="preferenceCookies" checked style="display: none;">
                            <label for="preferenceCookies" style="cursor: pointer;">
                                <div style="width: 50px; height: 25px; background: var(--accent); border-radius: var(--radius-full); display: flex; align-items: center; padding: 0 3px;">
                                    <div style="width: 20px; height: 20px; background: var(--light); border-radius: 50%; margin-left: auto;"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                    <button id="savePreferences" class="btn btn-primary btn-small"><i class="fas fa-save"></i> Enregistrer mes préférences</button>
                    <button id="acceptAll" class="btn btn-secondary btn-small"><i class="fas fa-check-circle"></i> Tout accepter</button>
                    <button id="rejectAll" class="btn btn-secondary btn-small"><i class="fas fa-times-circle"></i> Tout refuser</button>
                </div>
            </div>
            
            <h2 style="color: var(--light); margin-top: 2rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);"><i class="fas fa-clock"></i> Durée de conservation</h2>
            <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                Les cookies de session sont supprimés à la fermeture du navigateur. Les cookies persistants sont conservés entre 1 mois et 2 ans maximum.
            </p>
            
            <h2 style="color: var(--light); margin-top: 2rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 2px solid var(--primary);"><i class="fas fa-gavel"></i> Vos droits</h2>
            <p style="color: var(--light-secondary); margin-bottom: 1.5rem;">
                Vous avez le droit de :
            </p>
            <ul style="color: var(--light-secondary); margin-bottom: 1.5rem; padding-left: 1.5rem;">
                <li style="margin-bottom: 0.5rem;"><i class="fas fa-eye"></i> Accéder à vos données personnelles</li>
                <li style="margin-bottom: 0.5rem;"><i class="fas fa-edit"></i> Rectifier les informations inexactes</li>
                <li style="margin-bottom: 0.5rem;"><i class="fas fa-trash-alt"></i> Supprimer vos données</li>
                <li style="margin-bottom: 0.5rem;"><i class="fas fa-ban"></i> Vous opposer au traitement</li>
                <li><i class="fas fa-filter"></i> Limiter l'utilisation de vos données</li>
            </ul>
            
            <div class="card" style="background: rgba(138, 111, 232, 0.1); padding: 1.5rem; border-radius: var(--radius-lg); margin-top: 2rem;">
                <h3 style="color: var(--primary); margin-bottom: 0.75rem;"><i class="fas fa-envelope"></i> Pour exercer vos droits</h3>
                <p style="color: var(--light-secondary); margin: 0;">
                    Contactez-nous à : <strong style="color: var(--light);">legal@peletech-nexus.com</strong><br>
                    Nous répondrons dans un délai maximum de 30 jours.
                </p>
            </div>
            
            <p style="margin-top: 2rem; color: var(--gray-light); font-size: 0.9rem;">
                <i class="fas fa-exclamation-circle"></i> Cette politique peut être mise à jour périodiquement. Nous vous recommandons de la consulter régulièrement.
            </p>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-bottom">
                <p style="color: var(--gray);"><i class="far fa-copyright"></i> 2026 PêlêTech Nexus. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Gestion des préférences cookies
        document.addEventListener('DOMContentLoaded', function() {
            const saveBtn = document.getElementById('savePreferences');
            const acceptAllBtn = document.getElementById('acceptAll');
            const rejectAllBtn = document.getElementById('rejectAll');
            const analyticsCheckbox = document.getElementById('analyticsCookies');
            const preferenceCheckbox = document.getElementById('preferenceCookies');
            
            // Charger les préférences existantes
            function loadPreferences() {
                const preferences = JSON.parse(localStorage.getItem('cookiePreferences') || '{}');
                
                if (preferences.analytics !== undefined) {
                    analyticsCheckbox.checked = preferences.analytics;
                    updateSwitch(analyticsCheckbox);
                }
                
                if (preferences.preferences !== undefined) {
                    preferenceCheckbox.checked = preferences.preferences;
                    updateSwitch(preferenceCheckbox);
                }
            }
            
            // Mettre à jour l'apparence du switch
            function updateSwitch(checkbox) {
                const label = checkbox.nextElementSibling;
                const switchDiv = label.querySelector('div');
                const circle = switchDiv.querySelector('div');
                
                if (checkbox.checked) {
                    switchDiv.style.backgroundColor = checkbox.id === 'analyticsCookies' ? 'var(--secondary)' : 'var(--accent)';
                    circle.style.marginLeft = 'auto';
                } else {
                    switchDiv.style.backgroundColor = 'var(--gray-dark)';
                    circle.style.marginLeft = '0';
                }
            }
            
            // Sauvegarder les préférences
            saveBtn.addEventListener('click', function() {
                const preferences = {
                    analytics: analyticsCheckbox.checked,
                    preferences: preferenceCheckbox.checked
                };
                
                localStorage.setItem('cookiePreferences', JSON.stringify(preferences));
                
                // Afficher un message de confirmation
                const message = document.createElement('div');
                message.style.cssText = `
                    position: fixed;
                    top: 100px;
                    right: 20px;
                    background: var(--success);
                    color: var(--light);
                    padding: 1rem 1.5rem;
                    border-radius: var(--radius-lg);
                    z-index: 10000;
                    box-shadow: var(--shadow-lg);
                `;
                message.innerHTML = '<i class="fas fa-check-circle"></i> Préférences enregistrées avec succès';
                document.body.appendChild(message);
                
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => message.remove(), 500);
                }, 3000);
            });
            
            // Tout accepter
            acceptAllBtn.addEventListener('click', function() {
                analyticsCheckbox.checked = true;
                preferenceCheckbox.checked = true;
                updateSwitch(analyticsCheckbox);
                updateSwitch(preferenceCheckbox);
                
                const preferences = {
                    analytics: true,
                    preferences: true
                };
                
                localStorage.setItem('cookiePreferences', JSON.stringify(preferences));
                
                const message = document.createElement('div');
                message.style.cssText = `
                    position: fixed;
                    top: 100px;
                    right: 20px;
                    background: var(--success);
                    color: var(--light);
                    padding: 1rem 1.5rem;
                    border-radius: var(--radius-lg);
                    z-index: 10000;
                    box-shadow: var(--shadow-lg);
                `;
                message.innerHTML = '<i class="fas fa-check-circle"></i> Tous les cookies ont été acceptés';
                document.body.appendChild(message);
                
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => message.remove(), 500);
                }, 3000);
            });
            
            // Tout refuser
            rejectAllBtn.addEventListener('click', function() {
                analyticsCheckbox.checked = false;
                preferenceCheckbox.checked = false;
                updateSwitch(analyticsCheckbox);
                updateSwitch(preferenceCheckbox);
                
                const preferences = {
                    analytics: false,
                    preferences: false
                };
                
                localStorage.setItem('cookiePreferences', JSON.stringify(preferences));
                
                const message = document.createElement('div');
                message.style.cssText = `
                    position: fixed;
                    top: 100px;
                    right: 20px;
                    background: var(--success);
                    color: var(--light);
                    padding: 1rem 1.5rem;
                    border-radius: var(--radius-lg);
                    z-index: 10000;
                    box-shadow: var(--shadow-lg);
                `;
                message.innerHTML = '<i class="fas fa-times-circle"></i> Tous les cookies non-essentiels ont été refusés';
                document.body.appendChild(message);
                
                setTimeout(() => {
                    message.style.opacity = '0';
                    message.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => message.remove(), 500);
                }, 3000);
            });
            
            // Gérer les clics sur les switches
            [analyticsCheckbox, preferenceCheckbox].forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSwitch(this);
                });
            });
            
            // Initialiser
            loadPreferences();
        });
    </script>
</body>
</html>