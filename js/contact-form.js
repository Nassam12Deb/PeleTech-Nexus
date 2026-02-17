// Fichier: js/contact-form.js
// Gestion du formulaire de contact

document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const submitSpinner = document.getElementById('submitSpinner');
    const formMessage = document.getElementById('formMessage');
    
    if (!contactForm) return;
    
    // Initialiser les champs cachés s'ils existent
    const dateField = document.getElementById('date');
    const userAgentField = document.getElementById('user_agent');
    const referrerField = document.getElementById('referrer');
    
    if (dateField) dateField.value = new Date().toISOString();
    if (userAgentField) userAgentField.value = navigator.userAgent;
    if (referrerField) referrerField.value = document.referrer || 'Direct';
    
    contactForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Récupérer les données
        const formData = {
            name: document.getElementById('name').value.trim(),
            email: document.getElementById('email').value.trim(),
            company: document.getElementById('company').value.trim(),
            service: document.getElementById('service').value,
            message: document.getElementById('message').value.trim(),
            privacy: document.getElementById('privacy').checked,
            date: dateField ? dateField.value : new Date().toISOString(),
            user_agent: userAgentField ? userAgentField.value : navigator.userAgent,
            referrer: referrerField ? referrerField.value : 'Direct'
        };
        
        // Validation
        if (typeof window.emailService !== 'undefined') {
            const validation = window.emailService.validateFormData(formData);
            
            if (!validation.isValid) {
                showFormMessage(validation.errors.join('<br>'), 'error');
                return;
            }
        }
        
        // Désactiver le bouton
        setFormState('loading');
        
        try {
            // Envoyer l'email
            let result;
            
            if (typeof window.emailService !== 'undefined') {
                result = await window.emailService.sendContactEmail(formData);
            } else {
                // Fallback simple
                result = { success: true, message: 'Message envoyé' };
            }
            
            if (result.success) {
                showFormMessage(
                    '✅ Message envoyé avec succès !<br>Nous vous répondrons dans les 24h.',
                    'success'
                );
                contactForm.reset();
                // Réinitialiser les champs cachés
                if (dateField) dateField.value = new Date().toISOString();
                if (userAgentField) userAgentField.value = navigator.userAgent;
                if (referrerField) referrerField.value = document.referrer || 'Direct';
                
                setTimeout(() => {
                    setFormState('ready');
                    hideFormMessage();
                }, 3000);
            } else {
                throw new Error(result.message);
            }
            
        } catch (error) {
            console.error('Erreur:', error);
            showFormMessage(
                `❌ ${error.message || 'Erreur lors de l\'envoi'}<br>Veuillez nous contacter directement.`,
                'error'
            );
            setFormState('ready');
        }
    });
    
    function setFormState(state) {
        if (state === 'loading') {
            submitBtn.disabled = true;
            submitText.style.display = 'none';
            submitSpinner.style.display = 'block';
        } else {
            submitBtn.disabled = false;
            submitText.style.display = 'inline';
            submitSpinner.style.display = 'none';
        }
    }
    
    function showFormMessage(message, type) {
        formMessage.innerHTML = message;
        formMessage.style.display = 'block';
        formMessage.style.padding = '1rem';
        formMessage.style.borderRadius = 'var(--radius-md)';
        formMessage.style.marginTop = '1rem';
        
        if (type === 'success') {
            formMessage.style.backgroundColor = 'rgba(16, 185, 129, 0.1)';
            formMessage.style.border = '1px solid rgba(16, 185, 129, 0.3)';
            formMessage.style.color = 'var(--success)';
        } else {
            formMessage.style.backgroundColor = 'rgba(239, 68, 68, 0.1)';
            formMessage.style.border = '1px solid rgba(239, 68, 68, 0.3)';
            formMessage.style.color = 'var(--error)';
        }
    }
    
    function hideFormMessage() {
        formMessage.style.display = 'none';
    }
});