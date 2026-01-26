// Fichier: js/drive-projects.js
// Système de gestion des fichiers Google Drive pour projets individuels

console.log('🚀 Drive Projects System pour modaux');

const DRIVE_PROJECTS_CONFIG = DRIVE_CONFIG;
const cache = new Map();

// Fonction pour récupérer les fichiers d'un dossier (récursif)
async function getFolderFiles(folderId) {
    const cacheKey = `files_${folderId}`;
    
    // Vérifier le cache
    if (cache.has(cacheKey)) {
        const cached = cache.get(cacheKey);
        if (Date.now() - cached.timestamp < 300000) { // 5 minutes
            console.log(`🔦 Cache hit: ${folderId}`);
            return cached.data;
        }
    }

    try {
        const url = `https://www.googleapis.com/drive/v3/files?` + 
            new URLSearchParams({
                key: DRIVE_PROJECTS_CONFIG.API_KEY,
                q: `'${folderId}' in parents and trashed = false`,
                fields: 'files(id,name,mimeType,size,webContentLink,thumbnailLink,createdTime,modifiedTime)',
                pageSize: 100
            });

        console.log(`🔍 Récupération des fichiers: ${folderId}`);
        
        const response = await fetch(url);
        
        if (!response.ok) {
            console.error(`❌ Erreur HTTP ${response.status} pour le dossier ${folderId}`);
            return [];
        }

        const data = await response.json();
        const files = data.files || [];

        console.log(`✅ ${files.length} fichiers trouvés`);

        cache.set(cacheKey, {
            data: files,
            timestamp: Date.now()
        });

        return files;

    } catch (error) {
        console.error('❌ Erreur getFolderFiles:', error);
        return [];
    }
}

// Fonction récursive pour récupérer tous les fichiers d'un projet
async function getAllFilesRecursive(folderId, allFiles = []) {
    try {
        const files = await getFolderFiles(folderId);

        for (const file of files) {
            if (file.mimeType === 'application/vnd.google-apps.folder') {
                await getAllFilesRecursive(file.id, allFiles);
            } else {
                allFiles.push(file);
            }
        }

        return allFiles;

    } catch (error) {
        console.error('❌ Erreur getAllFilesRecursive:', error);
        return allFiles;
    }
}

// Extraire les fichiers d'un projet par type
async function extractFilesFromProject(projectFolderId) {
    const images = [];
    const videos = [];
    const documents = [];
    const allFiles = [];

    try {
        const allProjectFiles = await getAllFilesRecursive(projectFolderId);

        allProjectFiles.forEach(file => {
            if (file.mimeType === 'application/vnd.google-apps.folder') {
                return;
            }

            const fileType = getFileType(file.mimeType);
            const fileInfo = {
                id: file.id,
                name: file.name,
                mimeType: file.mimeType,
                type: fileType,
                size: formatFileSize(file.size || 0),
                url: file.webContentLink || `https://drive.google.com/uc?id=${file.id}&export=download`,
                thumbnail: file.mimeType.startsWith('image/') 
                    ? `https://drive.google.com/thumbnail?id=${file.id}&sz=w400`
                    : null,
                icon: getFileIcon(file.mimeType),
                driveViewUrl: `https://drive.google.com/file/d/${file.id}/view`,
                createdTime: file.createdTime,
                modifiedTime: file.modifiedTime
            };

            allFiles.push(fileInfo);

            if (fileType === 'image') {
                images.push(fileInfo);
            } else if (fileType === 'video') {
                videos.push(fileInfo);
            } else {
                documents.push(fileInfo);
            }
        });

        return { images, videos, documents, allFiles };

    } catch (error) {
        console.error('❌ Erreur extractFilesFromProject:', error);
        return { images: [], videos: [], documents: [], allFiles: [] };
    }
}

// Récupérer les métadonnées d'un projet
async function getProjectMetadata(projectId) {
    try {
        // Récupérer les fichiers pour les statistiques
        const files = await extractFilesFromProject(projectId);
        
        // Récupérer les métadonnées depuis la configuration
        const projectDescription = window.projectDescriptions?.[projectId] || {
            title: 'Projet',
            description: 'Projet réalisé avec PêlêTech Nexus.',
            category: 'web',
            year: new Date().getFullYear(),
            client: 'Client confidentiel',
            technologies: [],
            features: [],
            challenges: 'Information non disponible',
            results: 'Information non disponible'
        };

        return {
            id: projectId,
            title: projectDescription.title,
            description: projectDescription.description,
            category: projectDescription.category,
            year: projectDescription.year,
            client: projectDescription.client,
            technologies: projectDescription.technologies || [],
            features: projectDescription.features || [],
            challenges: projectDescription.challenges || 'Information non disponible',
            results: projectDescription.results || 'Information non disponible',
            folderLink: `https://drive.google.com/drive/folders/${projectId}`,
            stats: {
                imageCount: files.images.length,
                videoCount: files.videos.length,
                documentCount: files.documents.length,
                totalFiles: files.allFiles.length
            },
            files: files
        };
        
    } catch (error) {
        console.error(`❌ Erreur getProjectMetadata:`, error);
        return null;
    }
}

// Fonctions utilitaires
function getFileType(mimeType) {
    if (!mimeType) return 'document';
    if (mimeType.startsWith('image/')) return 'image';
    if (mimeType.startsWith('video/') || mimeType.includes('video')) return 'video';
    if (mimeType.includes('pdf')) return 'pdf';
    if (mimeType.includes('spreadsheet') || mimeType.includes('sheet') || mimeType.includes('excel')) return 'spreadsheet';
    if (mimeType.includes('presentation') || mimeType.includes('powerpoint') || mimeType.includes('ppt')) return 'presentation';
    if (mimeType.includes('zip') || mimeType.includes('compressed') || mimeType.includes('archive')) return 'archive';
    if (mimeType.includes('audio/') || mimeType.startsWith('audio/')) return 'audio';
    if (mimeType.includes('text/') || mimeType.includes('javascript') || mimeType.includes('json') || 
        mimeType.includes('xml') || mimeType.includes('html') || mimeType.includes('css')) return 'code';
    return 'document';
}

function getFileIcon(mimeType) {
    if (!mimeType) return 'fas fa-file';
    
    const fileType = getFileType(mimeType);
    
    switch (fileType) {
        case 'image':
            return 'fas fa-image';
        case 'video':
            return 'fas fa-video';
        case 'pdf':
            return 'fas fa-file-pdf';
        case 'spreadsheet':
            return 'fas fa-file-excel';
        case 'presentation':
            return 'fas fa-file-powerpoint';
        case 'archive':
            return 'fas fa-file-archive';
        case 'audio':
            return 'fas fa-file-audio';
        case 'code':
            return 'fas fa-file-code';
        case 'document':
            if (mimeType.includes('word') || mimeType.includes('document')) return 'fas fa-file-word';
            return 'fas fa-file-alt';
        default:
            return 'fas fa-file';
    }
}

function getFileTypeLabel(mimeType) {
    if (!mimeType) return 'Fichier';
    
    const fileType = getFileType(mimeType);
    
    switch (fileType) {
        case 'image':
            return 'Image';
        case 'video':
            return 'Vidéo';
        case 'pdf':
            return 'PDF';
        case 'spreadsheet':
            return 'Tableau';
        case 'presentation':
            return 'Présentation';
        case 'archive':
            return 'Archive';
        case 'audio':
            return 'Audio';
        case 'code':
            return 'Code';
        case 'document':
            if (mimeType.includes('word') || mimeType.includes('document')) return 'Document Word';
            return 'Document';
        default:
            return 'Fichier';
    }
}

function formatFileSize(bytes) {
    if (!bytes || bytes === 0) return '0 B';
    const k = 1024;
    const sizes = ['B', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return (bytes / Math.pow(k, i)).toFixed(1) + ' ' + sizes[i];
}

function clearCache() {
    cache.clear();
    console.log('🧹 Cache vidé');
}

// API publique
window.DriveProjects = {
    getProjectMetadata,
    clearCache,
    getFileIcon,
    getFileTypeLabel,
    formatFileSize
};

console.log('✅ Drive Projects System prêt pour modaux');