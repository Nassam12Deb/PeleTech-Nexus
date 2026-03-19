// Fichier: js/contact-form.js
// Gestionnaire unique du formulaire de contact
// À charger après main.js et email-service.js

document.addEventListener('DOMContentLoaded', function () {
    // Récupérer l'ancien formulaire
    const oldForm = document.getElementById('contactForm');
    if (!oldForm) return;

    // ÉTAPE CRITIQUE : cloner et remplacer pour supprimer tous les anciens listeners
    const newForm = oldForm.cloneNode(true); // clone profond
    oldForm.parentNode.replaceChild(newForm, oldForm);

    // Travailler sur le nouveau formulaire
    const contactForm = newForm;

    // Éléments du formulaire
    const submitBtn = contactForm.querySelector('#submitBtn');
    const submitText = contactForm.querySelector('#submitText');
    const submitSpinner = contactForm.querySelector('#submitSpinner');
    const formMessage = contactForm.querySelector('#formMessage');

    // Vérification des éléments essentiels
    if (!submitBtn || !submitText || !submitSpinner || !formMessage) {
        console.error('Éléments du formulaire manquants');
        return;
    }

    // Vérification du service email
    if (typeof window.emailService === 'undefined' || !window.emailService) {
        console.error('EmailService non disponible');
        showFormMessage('⚠️ Service d\'envoi temporairement indisponible. Contactez-nous par email.', 'error');
        return;
    }

    // --- Fonctions utilitaires ---
    function resetErrors() {
        contactForm.querySelectorAll('.form-control').forEach(f => {
            f.style.borderColor = '';
            f.style.outline = '';
        });
        contactForm.querySelectorAll('.error-message').forEach(e => e.remove());
        if (formMessage) formMessage.style.display = 'none';
    }

    function highlightErrors(errors) {
        let firstField = null;

        errors.forEach(({ field, message }) => {
            if (field === 'privacy') {
                const el = contactForm.querySelector('#privacy');
                if (!el) return;
                el.style.outline = '2px solid var(--error)';
                const group = el.closest('.form-group');
                if (group && !group.querySelector('.error-message')) {
                    appendError(group, message);
                }
                if (!firstField) firstField = el;
            } else {
                const el = contactForm.querySelector(`#${field}`);
                if (!el) return;
                el.style.borderColor = 'var(--error)';
                appendError(el.parentNode, message);
                if (!firstField) firstField = el;
            }
        });

        if (firstField) firstField.focus();
    }

    function appendError(parent, message) {
        const div = document.createElement('div');
        div.className = 'error-message';
        div.style.cssText = 'color: var(--error); font-size: 0.85rem; margin-top: 0.25rem;';
        div.textContent = message;
        parent.appendChild(div);
    }

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
            formMessage.style.color = '#10b981'; // couleur succès
        } else {
            formMessage.style.backgroundColor = 'rgba(239, 68, 68, 0.1)';
            formMessage.style.border = '1px solid rgba(239, 68, 68, 0.3)';
            formMessage.style.color = '#ef4444'; // couleur erreur
        }
    }

    function validateLocal(data) {
        const errors = [];
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!data.name || data.name.length < 2)
            errors.push({ field: 'name', message: 'Le nom doit contenir au moins 2 caractères' });

        if (!data.email || !emailRegex.test(data.email))
            errors.push({ field: 'email', message: 'Veuillez entrer une adresse email valide' });

        if (!data.service)
            errors.push({ field: 'service', message: 'Veuillez sélectionner un service' });

        if (!data.message || data.message.length < 10)
            errors.push({ field: 'message', message: 'Le message doit contenir au moins 10 caractères' });

        if (!data.privacy)
            errors.push({ field: 'privacy', message: 'Vous devez accepter la politique de confidentialité' });

        return errors;
    }

    // --- Gestionnaire de soumission ---
    contactForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        // Réinitialisation
        resetErrors();
        formMessage.style.display = 'none';

        // Récupération des données
        const formData = {
            name: contactForm.querySelector('#name').value.trim(),
            email: contactForm.querySelector('#email').value.trim(),
            company: contactForm.querySelector('#company').value.trim(),
            service: contactForm.querySelector('#service').value,
            message: contactForm.querySelector('#message').value.trim(),
            privacy: contactForm.querySelector('#privacy').checked
        };

        // Validation locale
        const errors = validateLocal(formData);
        if (errors.length > 0) {
            highlightErrors(errors);
            return;
        }

        // Activation du spinner
        setFormState('loading');

        try {
            // Appel au service email
            const result = await window.emailService.sendContactEmail(formData);

            if (result.success) {
                // Succès
                contactForm.reset();
                setFormState('ready');
                showFormMessage('✅ Message envoyé avec succès ! Nous vous répondrons sous 24h.', 'success');
            } else {
                // Échec signalé par le service
                throw new Error(result.message || 'Erreur lors de l\'envoi');
            }
        } catch (error) {
            console.error('Erreur lors de l\'envoi:', error);
            setFormState('ready');
            showFormMessage(
                '❌ Échec de l\'envoi. Veuillez réessayer ou nous contacter directement à <strong>contact.pelenexus@gmail.com</strong>.',
                'error'
            );
        }
    });
});