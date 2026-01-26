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
    // Exemple - Remplacez les IDs par vos vrais IDs de dossiers Drive
    '1WaTX4zZx3ztPpORmp8qQCNZofyeenioP': {
        title: 'Plateforme e-commerce B2B',
        description: 'Plateforme e-commerce B2B complète avec catalogue produits personnalisé, système de devis automatisé et intégration ERP.',
        category: 'web',
        year: 2023,
        client: 'Fabricant industriel',
        technologies: ['React', 'Node.js', 'PostgreSQL', 'SAP Integration', 'AWS'],
        features: [
            'Catalogue produits personnalisé par client',
            'Système de devis automatisé avec validation en ligne',
            'Intégration complète avec SAP ERP',
            'Tableau de bord analytique pour le suivi des ventes'
        ],
        challenges: 'Digitalisation des ventes en gros avec processus manuel entraînant des erreurs et délais de traitement longs.',
        results: '+40% de ventes en ligne, -70% d\'erreurs de commande, disponibilité 24/7, -60% du temps de traitement.'
    },
    
    '1AltYWMmW_lxwto6qrO5w4eDWBTO-RZ11': {
        title: 'Application de livraison de repas',
        description: 'Application mobile cross-platform de livraison de repas santé avec géolocalisation en temps réel et paiement intégré.',
        category: 'mobile',
        year: 2024,
        client: 'Startup FoodTech',
        technologies: ['React Native', 'Node.js', 'MongoDB', 'Google Maps API', 'Stripe'],
        features: [
            'Application cross-platform (iOS & Android)',
            'Géolocalisation en temps réel pour le suivi des livraisons',
            'Paiement intégré avec validation instantanée',
            'Interface intuitive avec recommandations personnalisées'
        ],
        challenges: 'Développer une application mobile pour concurrencer les leaders du marché avec une expérience utilisateur supérieure.',
        results: '4.8★ note moyenne App Store, +25k téléchargements, +300% de commandes/mois, -40% de délai de développement.'
    },
    
    'FOLDER_ID_3': {
        title: 'Refonte d\'interface SaaS B2B',
        description: 'Refonte complète de l\'interface utilisateur d\'un logiciel SaaS B2B avec audit UX et création d\'un design system.',
        category: 'design',
        year: 2023,
        client: 'Éditeur de logiciel',
        technologies: ['Figma', 'Design System', 'Prototypes interactifs', 'React Components'],
        features: [
            'Audit UX complet avec analyse des parcours utilisateurs',
            'Conception d\'un nouveau système de design cohérent',
            'Simplification des workflows complexes',
            'Tests utilisateurs itératifs pour validation'
        ],
        challenges: 'Taux d\'adoption stagnants malgré des fonctionnalités solides, interface vieillissante et complexe décourageant les nouveaux utilisateurs.',
        results: '+65% de taux de complétion onboarding, -55% de tickets support, +42% de NPS, satisfaction utilisateur de 4.2→4.8.'
    },
    
    'FOLDER_ID_4': {
        title: 'Application de Gestion de Projets',
        description: 'Application web de gestion de projets collaboratifs avec synchronisation en temps réel et export de rapports.',
        category: 'web',
        year: 2024,
        client: 'Startup Tech',
        technologies: ['React', 'TypeScript', 'Firebase', 'Material-UI', 'Chart.js'],
        features: [
            'Tableau de bord personnalisé',
            'Synchronisation en temps réel entre utilisateurs',
            'Système de notifications et rappels automatisés',
            'Export de rapports en PDF et Excel'
        ],
        challenges: 'Gestion de projets collaboratifs en temps réel avec une équipe distribuée dans plusieurs pays.',
        results: '+45% de productivité de l\'équipe, -60% de retards projet, +50 utilisateurs actifs, satisfaction 9.2/10.'
    },
    
    // Ajoutez les autres projets ici...
    'FOLDER_ID_5': {
        title: 'Portail client immobilier',
        description: 'Plateforme de gestion de biens immobiliers avec suivi des locations, paiements en ligne et communication propriétaire-locataire.',
        category: 'web',
        year: 2023,
        client: 'Agence immobilière',
        technologies: ['Vue.js', 'Laravel', 'Stripe'],
        features: [
            'Gestion des biens immobiliers',
            'Suivi des locations et paiements en ligne',
            'Communication propriétaire-locataire',
            'Tableau de bord administrateur'
        ],
        challenges: 'Automatisation des processus manuels de gestion immobilière.',
        results: '+50% d\'automatisation, réduction de 70% du temps de gestion.'
    },
    
    'FOLDER_ID_6': {
        title: 'App de fitness connectée',
        description: 'Application de suivi d\'activité physique avec synchronisation des bracelets connectés et programmes d\'entraînement personnalisés.',
        category: 'mobile',
        year: 2024,
        client: 'Marque de fitness',
        technologies: ['Flutter', 'Firebase', 'API HealthKit'],
        features: [
            'Suivi d\'activité en temps réel',
            'Synchronisation avec wearables',
            'Programmes d\'entraînement personnalisés',
            'Communauté et défis'
        ],
        challenges: 'Compatibilité avec différents modèles de bracelets connectés.',
        results: '4.7★ sur les stores, +100k téléchargements.'
    },
    
    'FOLDER_ID_7': {
        title: 'Site vitrine premium',
        description: 'Design et développement d\'un site vitrine haut de gamme pour une marque de luxe, avec animations subtiles et expérience immersive.',
        category: 'design',
        year: 2023,
        client: 'Marque de luxe',
        technologies: ['Figma', 'GSAP', 'Three.js'],
        features: [
            'Design premium et élégant',
            'Animations subtiles et fluides',
            'Expérience utilisateur immersive',
            'Optimisation pour mobile'
        ],
        challenges: 'Créer une expérience unique qui reflète le positionnement haut de gamme de la marque.',
        results: '+35% de leads qualifiés, temps moyen de session de 5+ minutes.'
    }
};

console.log('✅ Configuration Drive chargée');