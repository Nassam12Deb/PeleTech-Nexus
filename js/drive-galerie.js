// Fichier: js/drive-galerie.js
// Gestion de la galerie Drive

class DriveGalerie {
    constructor() {
        this.projects = [];
        this.filteredProjects = [];
        this.currentProject = null;
        this.currentImageIndex = 0;
        this.projectsPerLoad = 6;
        this.loadedCount = 0;
        
        this.init();
    }
    
    async init() {
        console.log('🎨 Initialisation de la galerie Drive');
        
        // Vérifier si DriveProjects est disponible
        if (typeof window.DriveProjects === 'undefined') {
            console.error('❌ DriveProjects non disponible');
            this.showError('Le système de projets Drive n\'est pas initialisé. Vérifiez que drive-config.js et drive-projects.js sont chargés.');
            return;
        }
        
        // Attacher les événements
        this.attachEvents();
        
        // Charger les projets
        await this.loadProjects();
    }
    
    attachEvents() {
        // Filtres Drive
        document.querySelectorAll('.drive-filter-btn').forEach(btn => {
            btn.addEventListener('click', (e) => this.filterProjects(e));
        });
        
        // Bouton charger plus
        const loadMoreBtn = document.getElementById('drive-load-more');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', () => this.loadMoreProjects());
        }
        
        // Fermeture du modal
        document.querySelector('.drive-modal-close')?.addEventListener('click', () => {
            this.closeModal();
        });
        
        // Fermer avec Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') this.closeModal();
        });
        
        // Fermer en cliquant à l'extérieur
        const modal = document.getElementById('drive-galerie-modal');
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target.id === 'drive-galerie-modal') this.closeModal();
            });
        }
        
        // Onglets du modal
        document.querySelectorAll('.drive-modal-tab').forEach(tab => {
            tab.addEventListener('click', (e) => this.switchTab(e));
        });
        
        // Télécharger tous les fichiers
        const downloadAllBtn = document.getElementById('drive-download-all');
        if (downloadAllBtn) {
            downloadAllBtn.addEventListener('click', () => this.downloadAllFiles());
        }
        
        // Viewer d'images
        this.initImageViewer();
    }
    
    async loadProjects() {
        try {
            // Afficher l'état de chargement
            const container = document.getElementById('drive-projects-container');
            if (container) {
                container.innerHTML = `
                    <div class="drive-project-loading">
                        <div class="drive-spinner"></div>
                        <p>Chargement des projets depuis Google Drive...</p>
                    </div>
                `;
            }
            
            // Charger les projets via DriveProjects
            this.projects = await window.DriveProjects.loadAllProjects();
            
            if (this.projects.length === 0) {
                this.showNoProjects();
                return;
            }
            
            console.log(`✅ ${this.projects.length} projets chargés`);
            
            // Afficher les projets
            this.filterProjects();
            
        } catch (error) {
            console.error('❌ Erreur lors du chargement des projets:', error);
            this.showError('Impossible de charger les projets depuis Google Drive. Vérifiez votre connexion internet et la configuration API.');
        }
    }
    
    filterProjects(event = null) {
        let filter = 'all';
        
        if (event) {
            // Mettre à jour les boutons actifs
            document.querySelectorAll('.drive-filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.currentTarget.classList.add('active');
            filter = event.currentTarget.dataset.driveFilter;
        }
        
        // Filtrer les projets
        if (filter === 'all') {
            this.filteredProjects = [...this.projects];
        } else {
            this.filteredProjects = this.projects.filter(project => 
                project.category.toLowerCase() === filter.toLowerCase() ||
                project.metadata?.category?.toLowerCase() === filter.toLowerCase()
            );
        }
        
        // Réinitialiser le compteur
        this.loadedCount = this.projectsPerLoad;
        
        // Afficher les projets filtrés
        this.displayProjects();
    }
    
    displayProjects() {
        const container = document.getElementById('drive-projects-container');
        if (!container) return;
        
        if (this.filteredProjects.length === 0) {
            container.innerHTML = `
                <div class="drive-no-projects">
                    <i class="fas fa-folder-open"></i>
                    <h3>Aucun projet trouvé</h3>
                    <p>Aucun projet disponible pour cette catégorie.</p>
                </div>
            `;
            
            // Masquer le bouton "Charger plus"
            const loadMoreBtn = document.getElementById('drive-load-more');
            if (loadMoreBtn) loadMoreBtn.style.display = 'none';
            
            return;
        }
        
        // Limiter le nombre affiché
        const projectsToShow = this.filteredProjects.slice(0, this.loadedCount);
        
        // Générer le HTML
        container.innerHTML = projectsToShow.map(project => this.createProjectCard(project)).join('');
        
        // Attacher les événements aux cartes
        this.attachProjectEvents();
        
        // Gérer le bouton "Charger plus"
        this.updateLoadMoreButton();
    }
    
    createProjectCard(project) {
        const coverImage = project.coverImage ? 
            `<img src="${project.coverImage.thumbnail || project.coverImage.url}" alt="${project.title}" class="drive-project-image" onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"400\" height=\"200\" viewBox=\"0 0 400 200\"><rect width=\"400\" height=\"200\" fill=\"%238a6fe8\"/><text x=\"50%\" y=\"50%\" font-family=\"Arial\" font-size=\"24\" fill=\"white\" text-anchor=\"middle\" dy=\".3em\">${project.category.toUpperCase()}</text></svg>'">` :
            `<div class="drive-project-image">
                <i class="fas fa-folder-open"></i>
            </div>`;
        
        const stats = `
            <div class="drive-project-stats">
                <div class="drive-stat-item">
                    <i class="fas fa-images"></i>
                    <span>${project.stats.imageCount}</span>
                </div>
                <div class="drive-stat-item">
                    <i class="fas fa-video"></i>
                    <span>${project.stats.videoCount}</span>
                </div>
                <div class="drive-stat-item">
                    <i class="fas fa-file-alt"></i>
                    <span>${project.stats.documentCount}</span>
                </div>
            </div>
        `;
        
        return `
            <div class="drive-project-card animate-slide-up" data-project-id="${project.id}" data-category="${project.category}">
                ${coverImage}
                <div class="drive-project-content">
                    <div class="drive-project-category">${project.category.toUpperCase()}</div>
                    <h3 class="drive-project-title">${project.title}</h3>
                    <p class="drive-project-description">${project.description}</p>
                    ${stats}
                    <div style="margin-top: 1rem;">
                        <small style="color: var(--light-secondary);">
                            <i class="far fa-calendar"></i> ${new Date(project.createdTime).toLocaleDateString('fr-FR', { year: 'numeric', month: 'short' })}
                        </small>
                    </div>
                </div>
            </div>
        `;
    }
    
    attachProjectEvents() {
        document.querySelectorAll('.drive-project-card').forEach(card => {
            card.addEventListener('click', (e) => {
                const projectId = card.dataset.projectId;
                const project = this.filteredProjects.find(p => p.id === projectId);
                if (project) {
                    this.openProjectModal(project);
                }
            });
        });
    }
    
    openProjectModal(project) {
        this.currentProject = project;
        
        // Mettre à jour le titre
        const titleElement = document.getElementById('drive-modal-project-title');
        if (titleElement) titleElement.textContent = project.title;
        
        // Mettre à jour les compteurs des onglets
        const imageCount = document.getElementById('drive-image-count');
        const videoCount = document.getElementById('drive-video-count');
        const docCount = document.getElementById('drive-doc-count');
        
        if (imageCount) imageCount.textContent = project.stats.imageCount;
        if (videoCount) videoCount.textContent = project.stats.videoCount;
        if (docCount) docCount.textContent = project.stats.documentCount;
        
        // Remplir les contenus
        this.fillGalleryImages(project.images);
        this.fillGalleryVideos(project.videos);
        this.fillGalleryDocuments(project.documents);
        this.fillProjectInfo(project);
        
        // Mettre à jour le lien Drive
        const driveLink = document.getElementById('drive-folder-link');
        if (driveLink) {
            driveLink.href = project.folderLink;
        }
        
        // Ouvrir le modal
        const modal = document.getElementById('drive-galerie-modal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
        
        // Activer le premier onglet
        this.switchToTab('images');
    }
    
    fillGalleryImages(images) {
        const container = document.getElementById('drive-gallery-images');
        if (!container) return;
        
        if (images.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 3rem; color: var(--light-secondary);">
                    <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Aucune image disponible pour ce projet</p>
                </div>
            `;
            return;
        }
        
        container.innerHTML = images.map((image, index) => `
            <div class="drive-gallery-item" data-image-index="${index}">
                <img src="${image.thumbnail || image.url}" 
                     alt="${image.name}" 
                     loading="lazy"
                     onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"300\" height=\"200\" viewBox=\"0 0 300 200\"><rect width=\"300\" height=\"200\" fill=\"%2313151c\"/><text x=\"50%\" y=\"50%\" font-family=\"Arial\" font-size=\"14\" fill=\"%238a6fe8\" text-anchor=\"middle\" dy=\".3em\">${image.name}</text></svg>'">
                <div class="drive-gallery-overlay">
                    <small style="color: white;">${image.name}</small>
                </div>
            </div>
        `).join('');
        
        // Attacher les événements pour le viewer d'images
        container.querySelectorAll('.drive-gallery-item').forEach((item, index) => {
            item.addEventListener('click', () => this.openImageViewer(index));
        });
    }
    
    fillGalleryVideos(videos) {
        const container = document.getElementById('drive-gallery-videos');
        if (!container) return;
        
        if (videos.length === 0) {
            container.innerHTML = `
                <div style="text-align: center; padding: 3rem; color: var(--light-secondary);">
                    <i class="fas fa-video-slash" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>Aucune vidéo disponible pour ce projet</p>
                </div>
            `;
            return;
        }
        
        container.innerHTML = videos.map(video => `
            <div class="drive-video-item">
                <div class="drive-video-placeholder">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div class="drive-video-info">
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
    
    fillGalleryDocuments(documents) {
        const container = document.getElementById('drive-gallery-documents');
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
            <a href="${doc.url}" class="drive-document-item" target="_blank" download="${doc.name}">
                <div class="drive-document-icon">
                    <i class="${doc.icon}"></i>
                </div>
                <div class="drive-document-info">
                    <div class="drive-document-name">${doc.name}</div>
                    <div class="drive-document-size">${doc.size} • ${window.DriveProjects.getFileTypeLabel(doc.mimeType)}</div>
                </div>
                <div class="drive-document-download">
                    <i class="fas fa-download"></i>
                </div>
            </a>
        `).join('');
    }
    
    fillProjectInfo(project) {
        const metadata = project.metadata || {};
        
        // Informations de base
        const clientElement = document.getElementById('drive-info-client');
        const yearElement = document.getElementById('drive-info-year');
        const categoryElement = document.getElementById('drive-info-category');
        const techElement = document.getElementById('drive-info-technologies');
        const challengeElement = document.getElementById('drive-info-challenge');
        const resultsElement = document.getElementById('drive-info-results');
        const featuresElement = document.getElementById('drive-info-features');
        const statsElement = document.getElementById('drive-file-stats');
        
        if (clientElement) clientElement.textContent = metadata.client || 'Non spécifié';
        if (yearElement) yearElement.textContent = metadata.year || 'Non spécifié';
        if (categoryElement) categoryElement.textContent = project.category.toUpperCase();
        
        // Technologies
        if (techElement) {
            if (metadata.technologies && metadata.technologies.length > 0) {
                techElement.innerHTML = metadata.technologies.map(tech => 
                    `<span class="drive-tech-tag">${tech}</span>`
                ).join('');
            } else {
                techElement.innerHTML = '<span class="drive-tech-tag">Non spécifiées</span>';
            }
        }
        
        // Défi
        if (challengeElement) {
            challengeElement.textContent = metadata.challenges || 'Information non disponible';
        }
        
        // Résultats
        if (resultsElement) {
            resultsElement.textContent = metadata.results || 'Information non disponible';
        }
        
        // Fonctionnalités
        if (featuresElement) {
            if (metadata.features && metadata.features.length > 0) {
                featuresElement.innerHTML = metadata.features.map(feature => 
                    `<li>${feature}</li>`
                ).join('');
            } else {
                featuresElement.innerHTML = '<li>Aucune fonctionnalité spécifiée</li>';
            }
        }
        
        // Statistiques des fichiers
        if (statsElement && project.stats) {
            statsElement.innerHTML = `
                <div class="drive-file-stat">
                    <span class="drive-file-stat-number">${project.stats.imageCount}</span>
                    <span class="drive-file-stat-label">Images</span>
                </div>
                <div class="drive-file-stat">
                    <span class="drive-file-stat-number">${project.stats.videoCount}</span>
                    <span class="drive-file-stat-label">Vidéos</span>
                </div>
                <div class="drive-file-stat">
                    <span class="drive-file-stat-number">${project.stats.documentCount}</span>
                    <span class="drive-file-stat-label">Documents</span>
                </div>
                <div class="drive-file-stat">
                    <span class="drive-file-stat-number">${project.stats.totalFiles}</span>
                    <span class="drive-file-stat-label">Total</span>
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
        document.querySelectorAll('.drive-modal-tab').forEach(t => {
            t.classList.remove('active');
        });
        document.querySelectorAll('.drive-modal-tab-content').forEach(c => {
            c.classList.remove('active');
        });
        
        const activeTab = document.querySelector(`.drive-modal-tab[data-tab="${tabName}"]`);
        const activeContent = document.getElementById(`drive-tab-${tabName}`);
        
        if (activeTab) activeTab.classList.add('active');
        if (activeContent) activeContent.classList.add('active');
    }
    
    initImageViewer() {
        // Attacher les événements du viewer
        const viewer = document.getElementById('drive-image-viewer');
        if (!viewer) return;
        
        // Fermeture
        viewer.querySelector('.drive-image-viewer-close').addEventListener('click', () => {
            this.closeImageViewer();
        });
        
        // Navigation
        viewer.querySelector('.drive-image-viewer-nav.prev').addEventListener('click', () => {
            this.navigateImageViewer(-1);
        });
        
        viewer.querySelector('.drive-image-viewer-nav.next').addEventListener('click', () => {
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
        if (!this.currentProject || !this.currentProject.images[index]) return;
        
        this.currentImageIndex = index;
        const image = this.currentProject.images[index];
        
        const viewerImg = document.getElementById('drive-viewer-image');
        if (viewerImg) {
            viewerImg.src = image.url;
            viewerImg.alt = image.name;
        }
        
        const viewer = document.getElementById('drive-image-viewer');
        if (viewer) {
            viewer.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }
    
    closeImageViewer() {
        const viewer = document.getElementById('drive-image-viewer');
        if (viewer) {
            viewer.classList.remove('active');
            document.body.style.overflow = '';
        }
    }
    
    navigateImageViewer(direction) {
        if (!this.currentProject) return;
        
        const images = this.currentProject.images;
        const newIndex = (this.currentImageIndex + direction + images.length) % images.length;
        this.currentImageIndex = newIndex;
        
        const image = images[newIndex];
        const viewerImg = document.getElementById('drive-viewer-image');
        if (viewerImg) {
            viewerImg.src = image.url;
            viewerImg.alt = image.name;
        }
    }
    
    loadMoreProjects() {
        this.loadedCount += this.projectsPerLoad;
        this.displayProjects();
    }
    
    updateLoadMoreButton() {
        const loadMoreBtn = document.getElementById('drive-load-more');
        if (!loadMoreBtn) return;
        
        if (this.loadedCount >= this.filteredProjects.length) {
            loadMoreBtn.style.display = 'none';
        } else {
            loadMoreBtn.style.display = 'inline-flex';
        }
    }
    
    closeModal() {
        const modal = document.getElementById('drive-galerie-modal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }
        this.currentProject = null;
    }
    
    downloadAllFiles() {
        if (!this.currentProject) return;
        
        // Créer un lien pour chaque fichier
        this.currentProject.allFiles.forEach(file => {
            const link = document.createElement('a');
            link.href = file.url;
            link.download = file.name;
            link.target = '_blank';
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
        
        alert(`Téléchargement de ${this.currentProject.allFiles.length} fichiers lancé. Les fichiers vont s'ouvrir dans de nouveaux onglets.`);
    }
    
    showNoProjects() {
        const container = document.getElementById('drive-projects-container');
        if (container) {
            container.innerHTML = `
                <div class="drive-no-projects">
                    <i class="fas fa-folder-open"></i>
                    <h3>Aucun projet disponible</h3>
                    <p>Les projets n'ont pas pu être chargés depuis Google Drive.</p>
                    <button class="btn btn-primary" onclick="location.reload()" style="margin-top: 1rem;">
                        <i class="fas fa-redo"></i> Réessayer
                    </button>
                </div>
            `;
        }
    }
    
    showError(message) {
        const container = document.getElementById('drive-projects-container');
        if (container) {
            container.innerHTML = `
                <div class="drive-no-projects">
                    <i class="fas fa-exclamation-triangle" style="color: #ff6b6b;"></i>
                    <h3>Erreur de chargement</h3>
                    <p>${message}</p>
                    <button class="btn btn-primary" onclick="location.reload()" style="margin-top: 1rem;">
                        <i class="fas fa-redo"></i> Réessayer
                    </button>
                </div>
            `;
        }
    }
}

// Initialiser la galerie quand le DOM est chargé
document.addEventListener('DOMContentLoaded', () => {
    // Vérifier que nous sommes sur la page des réalisations
    if (document.getElementById('drive-galerie')) {
        window.driveGalerie = new DriveGalerie();
    }
});