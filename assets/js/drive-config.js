// Fichier: js/drive-config.js
// Configuration Google Drive API

const DRIVE_CONFIG = {
    API_KEY: 'AIzaSyBVwI81zUHTEQPyINxr6pfXgcBoMIVM0aY',
    
    // Types de fichiers supportés
    FILE_TYPES: {
        image: {
            extensions: ['png', 'jpg', 'jpeg', 'gif', 'webp', 'svg', 'bmp'],
            icon: 'fas fa-image',
            label: 'Image',
            displayable: true,
            thumbnail: true
        },
        video: {
            extensions: ['mp4', 'webm', 'mov', 'avi', 'mkv', 'wmv', 'flv'],
            icon: 'fas fa-video',
            label: 'Vidéo',
            displayable: true,
            thumbnail: false
        },
        pdf: {
            extensions: ['pdf'],
            icon: 'fas fa-file-pdf',
            label: 'PDF',
            displayable: false,
            thumbnail: false
        },
        document: {
            extensions: ['doc', 'docx', 'txt', 'odt', 'rtf'],
            icon: 'fas fa-file-word',
            label: 'Document',
            displayable: false,
            thumbnail: false
        },
        spreadsheet: {
            extensions: ['xls', 'xlsx', 'csv', 'ods'],
            icon: 'fas fa-file-excel',
            label: 'Tableau',
            displayable: false,
            thumbnail: false
        },
        presentation: {
            extensions: ['ppt', 'pptx', 'odp'],
            icon: 'fas fa-file-powerpoint',
            label: 'Présentation',
            displayable: false,
            thumbnail: false
        },
        archive: {
            extensions: ['zip', 'rar', '7z', 'tar', 'gz'],
            icon: 'fas fa-file-archive',
            label: 'Archive',
            displayable: false,
            thumbnail: false
        },
        code: {
            extensions: ['html', 'css', 'js', 'json', 'xml', 'php', 'py', 'java', 'cpp', 'c', 'cs'],
            icon: 'fas fa-file-code',
            label: 'Code',
            displayable: false,
            thumbnail: false
        },
        audio: {
            extensions: ['mp3', 'wav', 'flac', 'm4a', 'aac', 'ogg'],
            icon: 'fas fa-file-audio',
            label: 'Audio',
            displayable: false,
            thumbnail: false
        }
    }
};

// Descriptions des projets (À CONFIGURER AVEC VOS PROPRES DONNÉES)
window.projectDescriptions = {
    // Projet: Site Vitrine - Éclat d'Identité Fashion Style
    '12dksfIsLuGqhOFor8uTJjXf9_f_8pZE5': {
        title: 'Site Vitrine - Éclat d\'Identité Fashion Style',
        client: 'Créatrice & Styliste',
        year: 2025,
        category: 'Web Development',
        technologies: ['HTML5', 'CSS3', 'JavaScript', 'Google Drive API', 'Responsive Design'],
        features: [
            'Site vitrine responsive',
            'Galerie dynamique',
            'Système de devis',
            'Prise de rendez-vous'
        ],
        challenges: 'Créer une présence en ligne professionnelle reflétant l\'excellence du travail artisanal.',
        results: '100% satisfaction client, 20+ créations exposées, mise en ligne 3 jours, disponibilité 24/7'
    }
};

console.log('✅ Configuration Drive chargée');