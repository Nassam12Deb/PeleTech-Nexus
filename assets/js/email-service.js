// Fichier: js/email-service.js
// Service d'envoi d'emails avec EmailJS

class EmailService {
    constructor() {
        // Configuration EmailJS
        this.userId = 'CHXxbs1ol_991mdMH';
        this.serviceId = 'service_y1urby9';
        this.templateId = 'template_eqe2y3p';
        
        this.init();
    }
    
    init() {
        // Vérifier si EmailJS est déjà chargé
        if (typeof emailjs === 'undefined') {
            this.loadEmailJSSDK();
        } else {
            this.initEmailJS();
        }
    }
    
    loadEmailJSSDK() {
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js';
        script.onload = () => {
            console.log('✅ EmailJS SDK chargé');
            this.initEmailJS();
        };
        script.onerror = () => {
            console.error('❌ Erreur de chargement EmailJS SDK');
        };
        document.head.appendChild(script);
    }
    
    initEmailJS() {
        if (emailjs && this.userId) {
            emailjs.init(this.userId);
            console.log('✅ EmailJS initialisé');
        }
    }
    
    async sendContactEmail(formData) {
        try {
            // Vérifier si EmailJS est initialisé
            if (!emailjs) {
                throw new Error('EmailJS non initialisé');
            }
            
            // Préparer les données pour EmailJS
            const templateParams = {
                to_name: 'PêlêTech Nexus',
                from_name: formData.name,
                from_email: formData.email,
                company: formData.company || 'Non spécifiée',
                service: this.getServiceLabel(formData.service),
                message: formData.message,
                date: new Date().toLocaleString('fr-FR'),
                page_url: window.location.href,
                user_agent: formData.user_agent || navigator.userAgent,
                privacy_accepted: formData.privacy ? 'Oui' : 'Non'
            };
            
            console.log('📤 Envoi email avec params:', templateParams);
            
            // Envoyer l'email via EmailJS AVEC reply_to
            const response = await emailjs.send(
                this.serviceId,
                this.templateId,
                templateParams
            );
            
            console.log('✅ Email envoyé avec succès:', response);
            return { 
                success: true, 
                message: 'Email envoyé avec succès',
                status: response.status,
                text: response.text
            };
            
        } catch (error) {
            console.error('❌ Erreur lors de l\'envoi de l\'email:', error);
            return { 
                success: false, 
                message: `Erreur technique: ${error.text || error.message || 'Erreur inconnue'}`,
                error: error
            };
        }
    }
    
    getServiceLabel(serviceKey) {
        const services = {
            'web': 'Développement Web',
            'mobile': 'Applications Mobile',
            'design': 'UI/UX Design',
            'accompagnement': 'Accompagnement Digital',
            'autre': 'Autre'
        };
        return services[serviceKey] || serviceKey;
    }
    
    // Méthode alternative avec Formspree (backup)
    async sendViaFormspree(formData) {
        try {
            const response = await fetch('https://formspree.io/f/YOUR_FORM_ID', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: formData.name,
                    email: formData.email,
                    company: formData.company,
                    service: formData.service,
                    message: formData.message,
                    _subject: `Nouveau contact depuis PêlêTech Nexus: ${formData.name}`,
                    _replyto: formData.email
                })
            });
            
            if (response.ok) {
                return { success: true, message: 'Message envoyé via Formspree' };
            } else {
                throw new Error('Erreur Formspree');
            }
        } catch (error) {
            console.error('❌ Erreur Formspree:', error);
            return { success: false, message: 'Erreur avec le service d\'envoi' };
        }
    }
    
    // Validation des données du formulaire
    validateFormData(formData) {
        const errors = [];
        
        if (!formData.name || formData.name.trim().length < 2) {
            errors.push('Le nom doit contenir au moins 2 caractères');
        }
        
        if (!formData.email || !this.validateEmail(formData.email)) {
            errors.push('Veuillez entrer une adresse email valide');
        }
        
        if (!formData.service) {
            errors.push('Veuillez sélectionner un service');
        }
        
        if (!formData.message || formData.message.trim().length < 10) {
            errors.push('Le message doit contenir au moins 10 caractères');
        }
        
        if (!formData.privacy) {
            errors.push('Vous devez accepter la politique de confidentialité');
        }
        
        return {
            isValid: errors.length === 0,
            errors: errors
        };
    }
    
    validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
}

// Initialisation du service
window.emailService = new EmailService();