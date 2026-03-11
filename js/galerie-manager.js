// Fichier: js/galerie-manager.js
// Gestionnaire de galerie pour les modaux des projets
// Version robuste : affiche le titre même en cas d'échec de chargement des fichiers

class GalerieManager {
    constructor() {
        this.currentProjectId = null;
        this.currentProjectData = null;
        this.currentImages = [];
        this.init();
    }

    init() {
        console.log('🎨 Initialisation du gestionnaire de galerie');

        if (typeof window.DriveProjects === 'undefined') {
            console.error('❌ DriveProjects non disponible');
            return;
        }

        this.attachEvents();
    }

    attachEvents() {
        // Clic sur "Voir la galerie"
        document.querySelectorAll('.btn-galerie').forEach(btn => {
            btn.addEventListener('click', (e) => this.openGalerie(e));
        });

        // Fermeture du modal
        const closeBtn = document.querySelector('.galerie-modal-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.closeGalerie());
        }

        // Fermer avec Échap
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') this.closeGalerie();
        });

        // Fermer en cliquant en dehors
        const modal = document.getElementById('galerie-modal');
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target.id === 'galerie-modal') this.closeGalerie();
            });
        }

        // Changement d'onglets
        document.querySelectorAll('.galerie-modal-tab').forEach(tab => {
            tab.addEventListener('click', (e) => this.switchTab(e));
        });

        // Télécharger tous les fichiers
        const downloadBtn = document.getElementById('galerie-download-all');
        if (downloadBtn) {
            downloadBtn.addEventListener('click', () => this.downloadAllFiles());
        }
    }

    async openGalerie(event) {
        const button = event.currentTarget;
        const projectId = button.getAttribute('data-drive-id');
        const projectTitle = button.getAttribute('data-project-title') || 'Projet sans titre';

        if (!projectId) {
            console.error('❌ Aucun ID Drive spécifié');
            return;
        }

        this.currentProjectId = projectId;
        this.showLoading();
        this.openModal();

        try {
            // Tentative de chargement des données
            let projectData = await window.DriveProjects.getProjectMetadata(projectId);

            // Si le chargement échoue, on crée un objet minimal
            if (!projectData) {
                console.warn('⚠️ Chargement impossible, utilisation des données minimales');
                projectData = this.createFallbackProjectData(projectId, projectTitle);
            } else {
                // Sinon, on utilise le titre personnalisé s'il est fourni
                if (projectTitle) {
                    projectData.title = projectTitle;
                }
            }

            this.currentProjectData = projectData;
            this.updateModalInterface();
            this.fillGalerieContent();

        } catch (error) {
            console.error('❌ Erreur lors du chargement de la galerie:', error);
            // En cas d'exception, on crée aussi des données minimales
            const fallbackData = this.createFallbackProjectData(projectId, projectTitle);
            this.currentProjectData = fallbackData;
            this.updateModalInterface();
            this.fillGalerieContent();
            // On peut afficher un message d'erreur dans le contenu si souhaité
            const errorDiv = document.getElementById('galerie-error');
            if (errorDiv) errorDiv.style.display = 'block';
        }
    }

    // Crée un objet projet minimal avec le titre
    createFallbackProjectData(projectId, title) {
        return {
            title: title,
            stats: { imageCount: 0, videoCount: 0, documentCount: 0, totalFiles: 0 },
            files: { images: [], videos: [], documents: [], allFiles: [] },
            folderLink: `https://drive.google.com/drive/folders/${projectId}`,
            client: 'Non spécifié',
            year: new Date().getFullYear(),
            category: 'Non catégorisé',
            technologies: [],
            challenges: 'Information non disponible',
            results: 'Information non disponible',
            features: []
        };
    }

    showLoading() {
        const content = document.getElementById('galerie-content');
        const loading = document.getElementById('galerie-loading');
        const error = document.getElementById('galerie-error');

        if (content) content.style.display = 'none';
        if (loading) loading.style.display = 'block';
        if (error) error.style.display = 'none';
    }

    showError() {
        const content = document.getElementById('galerie-content');
        const loading = document.getElementById('galerie-loading');
        const error = document.getElementById('galerie-error');

        if (content) content.style.display = 'none';
        if (loading) loading.style.display = 'none';
        if (error) error.style.display = 'block';
    }

    showContent() {
        const content = document.getElementById('galerie-content');
        const loading = document.getElementById('galerie-loading');
        const error = document.getElementById('galerie-error');

        if (content) content.style.display = 'block';
        if (loading) loading.style.display = 'none';
        if (error) error.style.display = 'none';
    }

    openModal() {
        const modal = document.getElementById('galerie-modal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    }

    closeGalerie() {
        const modal = document.getElementById('galerie-modal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }
        this.currentProjectId = null;
        this.currentProjectData = null;
    }

    updateModalInterface() {
        if (!this.currentProjectData) return;

        const titleElement = document.getElementById('galerie-modal-title');
        if (titleElement) {
            titleElement.textContent = this.currentProjectData.title;
        }

        const imageCount = document.getElementById('galerie-image-count');
        const videoCount = document.getElementById('galerie-video-count');
        const docCount = document.getElementById('galerie-doc-count');

        if (imageCount) imageCount.textContent = this.currentProjectData.stats.imageCount;
        if (videoCount) videoCount.textContent = this.currentProjectData.stats.videoCount;
        if (docCount) docCount.textContent = this.currentProjectData.stats.documentCount;

        const driveLink = document.getElementById('galerie-folder-link');
        if (driveLink) {
            driveLink.href = this.currentProjectData.folderLink;
        }

        this.showContent();
        this.switchToTab('images');
    }

    fillGalerieContent() {
        if (!this.currentProjectData || !this.currentProjectData.files) return;

        const files = this.currentProjectData.files;

        this.fillImages(files.images);
        this.fillVideos(files.videos);
        this.fillDocuments(files.documents);
        this.fillProjectInfo(); // si vous avez un onglet info
    }

    fillImages(images) {
        const container = document.getElementById('galerie-images');
        if (!container) return;

        if (images.length === 0) {
            container.innerHTML = `
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--light-secondary);">
                    <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Aucune image disponible pour ce projet</p>
                </div>
            `;
            return;
        }

        // Construire les cartes image en JS pur (pas de template literal complexe)
        container.innerHTML = '';
        images.forEach((image) => {
            const item = document.createElement('div');
            item.className = 'galerie-item';
            item.style.cssText = 'cursor:pointer;position:relative;overflow:hidden;border-radius:8px;background:rgba(255,255,255,0.05);';

            const link = document.createElement('a');
            link.href = image.driveViewUrl;
            link.target = '_blank';
            link.rel = 'noopener';
            link.title = 'Ouvrir en grand';
            link.style.cssText = 'display:block;text-decoration:none;';

            // Choisir img ou iframe selon disponibilité du thumbnailLink
            if (image.hasThumbnailLink && image.thumbnail) {
                const img = document.createElement('img');
                img.src = image.thumbnail;
                img.alt = image.name;
                img.loading = 'lazy';
                img.style.cssText = 'width:100%;height:200px;object-fit:cover;display:block;';
                img.onerror = function() {
                    this.onerror = null;
                    // Fallback 1 : URL thumbnail publique
                    this.src = 'https://drive.google.com/thumbnail?id=' + image.id + '&sz=w800';
                    this.onerror = function() {
                        // Fallback 2 : iframe preview
                        this.onerror = null;
                        this.style.display = 'none';
                        const ifr = document.createElement('iframe');
                        ifr.src = 'https://drive.google.com/file/d/' + image.id + '/preview';
                        ifr.style.cssText = 'width:100%;height:200px;border:none;pointer-events:none;';
                        this.parentElement.insertBefore(ifr, this);
                    };
                };
                link.appendChild(img);
            } else {
                // Pas de thumbnailLink : iframe directement
                const ifr = document.createElement('iframe');
                ifr.src = 'https://drive.google.com/file/d/' + image.id + '/preview';
                ifr.style.cssText = 'width:100%;height:200px;border:none;pointer-events:none;';
                ifr.setAttribute('allow', 'autoplay');
                ifr.setAttribute('loading', 'lazy');
                link.appendChild(ifr);
            }

            // Overlay nom de fichier
            const overlay = document.createElement('div');
            overlay.className = 'galerie-overlay';
            overlay.style.cssText = 'position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent,rgba(0,0,0,0.7));padding:0.5rem;opacity:0;transition:opacity 0.2s;';
            overlay.innerHTML = '<small style="color:white;">' + image.name + '</small><i class="fas fa-external-link-alt" style="float:right;color:white;margin-top:2px;"></i>';
            link.appendChild(overlay);

            item.appendChild(link);
            item.addEventListener('mouseenter', () => overlay.style.opacity = '1');
            item.addEventListener('mouseleave', () => overlay.style.opacity = '0');
            container.appendChild(item);
        });
    }

    fillVideos(videos) {
        const container = document.getElementById('galerie-videos');
        if (!container) return;

        if (videos.length === 0) {
            container.innerHTML = `
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--light-secondary);">
                    <i class="fas fa-video-slash" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Aucune vidéo disponible</p>
                </div>
            `;
            return;
        }

        container.innerHTML = videos.map(video => `
            <div class="galerie-video-item">
                <div class="galerie-video-placeholder">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="galerie-video-info">
                    <h4>${video.name}</h4>
                    <a href="${video.url}" class="btn btn-primary" target="_blank">
                        <i class="fas fa-download"></i> Télécharger
                    </a>
                </div>
            </div>
        `).join('');
    }

    fillDocuments(documents) {
        const container = document.getElementById('galerie-documents');
        if (!container) return;

        if (documents.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 3rem; color: var(--light-secondary);">
                    <i class="fas fa-file-alt" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Aucun document disponible</p>
                </div>
            `;
            return;
        }

        container.innerHTML = documents.map(doc => `
            <a href="${doc.url}" class="galerie-document-item" target="_blank" download="${doc.name}">
                <div class="galerie-document-icon">
                    <i class="${doc.icon}"></i>
                </div>
                <div class="galerie-document-info">
                    <div class="galerie-document-name">${doc.name}</div>
                    <div class="galerie-document-size">${doc.size}</div>
                </div>
                <div class="galerie-document-download">
                    <i class="fas fa-download"></i>
                </div>
            </a>
        `).join('');
    }

    fillProjectInfo() {
        // Si vous avez un onglet info, vous pouvez le remplir ici
        // Cette méthode est appelée dans fillGalerieContent mais nous n'avons pas d'onglet info dans ce code.
        // Vous pouvez l'implémenter si nécessaire.
    }

    switchTab(event) {
        const tabName = event.currentTarget.dataset.tab;
        this.switchToTab(tabName);
    }

    switchToTab(tabName) {
        document.querySelectorAll('.galerie-modal-tab').forEach(t => {
            t.classList.remove('active');
        });
        document.querySelectorAll('.galerie-modal-tab-content').forEach(c => {
            c.classList.remove('active');
        });

        const activeTab = document.querySelector(`.galerie-modal-tab[data-tab="${tabName}"]`);
        const activeContent = document.getElementById(`galerie-tab-${tabName}`);

        if (activeTab) activeTab.classList.add('active');
        if (activeContent) activeContent.classList.add('active');
    }

    downloadAllFiles() {
        if (!this.currentProjectData || !this.currentProjectData.files) return;

        const files = this.currentProjectData.files.allFiles;

        if (files.length === 0) {
            alert('Aucun fichier à télécharger.');
            return;
        }

        files.forEach(file => {
            const link = document.createElement('a');
            link.href = file.url;
            link.download = file.name;
            link.target = '_blank';
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });

        alert(`Téléchargement lancé pour ${files.length} fichiers.`);
    }

    retryLoad() {
        if (this.currentProjectId) {
            const fakeEvent = { currentTarget: { getAttribute: (attr) => 
                attr === 'data-drive-id' ? this.currentProjectId : 
                attr === 'data-project-title' ? 'Rechargement' : null
            }};
            this.openGalerie(fakeEvent);
        }
    }
}

// Initialiser au chargement
document.addEventListener('DOMContentLoaded', () => {
    window.galerieManager = new GalerieManager();
    console.log('✅ Gestionnaire de galerie initialisé (version robuste)');
});