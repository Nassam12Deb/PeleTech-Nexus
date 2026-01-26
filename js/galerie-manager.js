// Fichier: js/galerie-manager.js
// Gestionnaire de galerie pour les modaux des projets

class GalerieManager {
    constructor() {
        this.currentProjectId = null;
        this.currentProjectData = null;
        this.currentImageIndex = 0;
        this.currentImages = [];
        
        this.init();
    }
    
    init() {
        console.log('🎨 Initialisation du gestionnaire de galerie');
        
        // Vérifier si DriveProjects est disponible
        if (typeof window.DriveProjects === 'undefined') {
            console.error('❌ DriveProjects non disponible');
            return;
        }
        
        // Attacher les événements
        this.attachEvents();
    }
    
    attachEvents() {
        // Boutons "Voir la galerie" sur chaque projet
        document.querySelectorAll('.btn-galerie').forEach(btn => {
            btn.addEventListener('click', (e) => this.openGalerie(e));
        });
        
        // Fermeture du modal
        document.querySelector('.galerie-modal-close')?.addEventListener('click', () => {
            this.closeGalerie();
        });
        
        // Fermer avec Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') this.closeGalerie();
        });
        
        // Fermer en cliquant à l'extérieur
        const modal = document.getElementById('galerie-modal');
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target.id === 'galerie-modal') this.closeGalerie();
            });
        }
        
        // Onglets du modal
        document.querySelectorAll('.galerie-modal-tab').forEach(tab => {
            tab.addEventListener('click', (e) => this.switchTab(e));
        });
        
        // Télécharger tous les fichiers
        const downloadAllBtn = document.getElementById('galerie-download-all');
        if (downloadAllBtn) {
            downloadAllBtn.addEventListener('click', () => this.downloadAllFiles());
        }
        
        // Viewer d'images
        this.initImageViewer();
    }
    
    async openGalerie(event) {
        const button = event.currentTarget;
        const projectId = button.getAttribute('data-drive-id');
        
        if (!projectId) {
            console.error('❌ Aucun ID Drive spécifié');
            return;
        }
        
        this.currentProjectId = projectId;
        
        // Afficher le modal avec état de chargement
        this.showLoading();
        this.openModal();
        
        try {
            // Charger les données du projet
            this.currentProjectData = await window.DriveProjects.getProjectMetadata(projectId);
            
            if (!this.currentProjectData) {
                this.showError();
                return;
            }
            
            // Mettre à jour l'interface
            this.updateModalInterface();
            this.fillGalerieContent();
            
        } catch (error) {
            console.error('❌ Erreur lors du chargement de la galerie:', error);
            this.showError();
        }
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
        
        // Mettre à jour le titre
        const titleElement = document.getElementById('galerie-modal-title');
        if (titleElement) {
            titleElement.textContent = `Galerie : ${this.currentProjectData.title}`;
        }
        
        // Mettre à jour les compteurs
        const imageCount = document.getElementById('galerie-image-count');
        const videoCount = document.getElementById('galerie-video-count');
        const docCount = document.getElementById('galerie-doc-count');
        
        if (imageCount) imageCount.textContent = this.currentProjectData.stats.imageCount;
        if (videoCount) videoCount.textContent = this.currentProjectData.stats.videoCount;
        if (docCount) docCount.textContent = this.currentProjectData.stats.documentCount;
        
        // Mettre à jour le lien Drive
        const driveLink = document.getElementById('galerie-folder-link');
        if (driveLink) {
            driveLink.href = this.currentProjectData.folderLink;
        }
        
        // Afficher le contenu
        this.showContent();
        
        // Activer le premier onglet
        this.switchToTab('images');
    }
    
    fillGalerieContent() {
        if (!this.currentProjectData || !this.currentProjectData.files) return;
        
        const files = this.currentProjectData.files;
        
        // Remplir les images
        this.fillImages(files.images);
        
        // Remplir les vidéos
        this.fillVideos(files.videos);
        
        // Remplir les documents
        this.fillDocuments(files.documents);
        
        // Remplir les informations
        this.fillProjectInfo();
    }
    
    fillImages(images) {
        const container = document.getElementById('galerie-images');
        if (!container) return;
        
        this.currentImages = images;
        
        if (images.length === 0) {
            container.innerHTML = `
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--light-secondary);">
                    <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Aucune image disponible pour ce projet</p>
                </div>
            `;
            return;
        }
        
        container.innerHTML = images.map((image, index) => `
            <div class="galerie-item" data-image-index="${index}">
                <img src="${image.thumbnail || image.url}" 
                     alt="${image.name}" 
                     loading="lazy"
                     onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"300\" height=\"200\" viewBox=\"0 0 300 200\"><rect width=\"300\" height=\"200\" fill=\"%2313151c\"/><text x=\"50%\" y=\"50%\" font-family=\"Arial\" font-size=\"14\" fill=\"%238a6fe8\" text-anchor=\"middle\" dy=\".3em\">${image.name}</text></svg>'">
                <div class="galerie-overlay">
                    <small style="color: white;">${image.name}</small>
                </div>
            </div>
        `).join('');
        
        // Attacher les événements pour le viewer d'images
        container.querySelectorAll('.galerie-item').forEach((item, index) => {
            item.addEventListener('click', () => this.openImageViewer(index));
        });
    }
    
    fillVideos(videos) {
        const container = document.getElementById('galerie-videos');
        if (!container) return;
        
        if (videos.length === 0) {
            container.innerHTML = `
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: var(--light-secondary);">
                    <i class="fas fa-video-slash" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Aucune vidéo disponible pour ce projet</p>
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
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                        <span>${video.size}</span>
                        <a href="${video.url}" 
                           class="btn btn-primary btn-small" 
                           target="_blank" 
                           download="${video.name}">
                            <i class="fas fa-download"></i> Télécharger
                        </a>
                    </div>
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
                    <p>Aucun document disponible pour ce projet</p>
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
                    <div class="galerie-document-size">${doc.size} • ${window.DriveProjects.getFileTypeLabel(doc.mimeType)}</div>
                </div>
                <div class="galerie-document-download">
                    <i class="fas fa-download"></i>
                </div>
            </a>
        `).join('');
    }
    
    fillProjectInfo() {
        if (!this.currentProjectData) return;
        
        const project = this.currentProjectData;
        
        // Informations de base
        const clientElement = document.getElementById('galerie-info-client');
        const yearElement = document.getElementById('galerie-info-year');
        const categoryElement = document.getElementById('galerie-info-category');
        const techElement = document.getElementById('galerie-info-technologies');
        const challengeElement = document.getElementById('galerie-info-challenge');
        const resultsElement = document.getElementById('galerie-info-results');
        const featuresElement = document.getElementById('galerie-info-features');
        const statsElement = document.getElementById('galerie-file-stats');
        
        if (clientElement) clientElement.textContent = project.client || 'Non spécifié';
        if (yearElement) yearElement.textContent = project.year || 'Non spécifié';
        if (categoryElement) categoryElement.textContent = project.category.toUpperCase();
        
        // Technologies
        if (techElement) {
            if (project.technologies && project.technologies.length > 0) {
                techElement.innerHTML = project.technologies.map(tech => 
                    `<span class="galerie-tech-tag">${tech}</span>`
                ).join('');
            } else {
                techElement.innerHTML = '<span class="galerie-tech-tag">Non spécifiées</span>';
            }
        }
        
        // Défi
        if (challengeElement) {
            challengeElement.textContent = project.challenges || 'Information non disponible';
        }
        
        // Résultats
        if (resultsElement) {
            resultsElement.textContent = project.results || 'Information non disponible';
        }
        
        // Fonctionnalités
        if (featuresElement) {
            if (project.features && project.features.length > 0) {
                featuresElement.innerHTML = project.features.map(feature => 
                    `<li>${feature}</li>`
                ).join('');
            } else {
                featuresElement.innerHTML = '<li>Aucune fonctionnalité spécifiée</li>';
            }
        }
        
        // Statistiques des fichiers
        if (statsElement && project.stats) {
            statsElement.innerHTML = `
                <div class="galerie-file-stat">
                    <span class="galerie-file-stat-number">${project.stats.imageCount}</span>
                    <span class="galerie-file-stat-label">Images</span>
                </div>
                <div class="galerie-file-stat">
                    <span class="galerie-file-stat-number">${project.stats.videoCount}</span>
                    <span class="galerie-file-stat-label">Vidéos</span>
                </div>
                <div class="galerie-file-stat">
                    <span class="galerie-file-stat-number">${project.stats.documentCount}</span>
                    <span class="galerie-file-stat-label">Documents</span>
                </div>
                <div class="galerie-file-stat">
                    <span class="galerie-file-stat-number">${project.stats.totalFiles}</span>
                    <span class="galerie-file-stat-label">Total fichiers</span>
                </div>
            `;
        }
    }
    
    switchTab(event) {
        const tab = event.currentTarget.dataset.tab;
        this.switchToTab(tab);
    }
    
    switchToTab(tabName) {
        // Mettre à jour les onglets actifs
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
    
    initImageViewer() {
        // Attacher les événements du viewer
        const viewer = document.getElementById('galerie-image-viewer');
        if (!viewer) return;
        
        // Fermeture
        viewer.querySelector('.galerie-image-viewer-close').addEventListener('click', () => {
            this.closeImageViewer();
        });
        
        // Navigation
        viewer.querySelector('.galerie-image-viewer-nav.prev').addEventListener('click', () => {
            this.navigateImageViewer(-1);
        });
        
        viewer.querySelector('.galerie-image-viewer-nav.next').addEventListener('click', () => {
            this.navigateImageViewer(1);
        });
        
        // Fermer avec Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && viewer.classList.contains('active')) {
                this.closeImageViewer();
            }
        });
    }
    
    openImageViewer(index) {
        if (!this.currentImages || !this.currentImages[index]) return;
        
        this.currentImageIndex = index;
        const image = this.currentImages[index];
        
        const viewerImg = document.getElementById('galerie-viewer-image');
        if (viewerImg) {
            viewerImg.src = image.url;
            viewerImg.alt = image.name;
        }
        
        const viewer = document.getElementById('galerie-image-viewer');
        if (viewer) {
            viewer.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }
    
    closeImageViewer() {
        const viewer = document.getElementById('galerie-image-viewer');
        if (viewer) {
            viewer.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    navigateImageViewer(direction) {
        if (!this.currentImages) return;
        
        const images = this.currentImages;
        const newIndex = (this.currentImageIndex + direction + images.length) % images.length;
        this.currentImageIndex = newIndex;
        
        const image = images[newIndex];
        const viewerImg = document.getElementById('galerie-viewer-image');
        if (viewerImg) {
            viewerImg.src = image.url;
            viewerImg.alt = image.name;
        }
    }
    
    downloadAllFiles() {
        if (!this.currentProjectData || !this.currentProjectData.files) return;
        
        const files = this.currentProjectData.files.allFiles;
        
        if (files.length === 0) {
            alert('Aucun fichier à télécharger.');
            return;
        }
        
        // Créer un lien pour chaque fichier
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
        
        alert(`Téléchargement de ${files.length} fichiers lancé. Les fichiers vont s'ouvrir dans de nouveaux onglets.`);
    }
    
    retryLoad() {
        if (this.currentProjectId) {
            this.openGalerie({ currentTarget: { getAttribute: () => this.currentProjectId } });
        }
    }
}

// Initialiser le gestionnaire quand le DOM est chargé
document.addEventListener('DOMContentLoaded', () => {
    window.galerieManager = new GalerieManager();
    console.log('✅ Gestionnaire de galerie initialisé');
});