/**
 * PêlêTech Nexus - Main JavaScript
 * Version: 2.0 - Optimisé avec la nouvelle palette
 *
 * MODIFICATION :
 * Le bloc "FORM VALIDATION" a été retiré de ce fichier.
 * La gestion du formulaire de contact est dans js/contact-form.js
 */

document.addEventListener('DOMContentLoaded', function() {
    // ============= NAVIGATION MOBILE =============
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');
    
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', navMenu.classList.contains('active'));
            menuToggle.innerHTML = navMenu.classList.contains('active') ? 
                '<span class="icon">✕</span>' : 
                '<span class="icon">☰</span>';
        });
        
        // Fermer le menu en cliquant sur un lien
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.innerHTML = '<span class="icon">☰</span>';
            });
        });
        
        // Fermer le menu en cliquant à l'extérieur
        document.addEventListener('click', (e) => {
            if (!navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                navMenu.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.innerHTML = '<span class="icon">☰</span>';
            }
        });
    }
    
    // ============= SCROLL PROGRESS =============
    const scrollProgress = document.getElementById('scrollProgress');
    
    if (scrollProgress) {
        window.addEventListener('scroll', () => {
            const windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (window.scrollY / windowHeight) * 100;
            scrollProgress.style.width = `${scrolled}%`;
        });
    }
    
    // ============= BACK TO TOP =============
    const backToTop = document.getElementById('backToTop');
    
    if (backToTop) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });
        
        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // ============= NAVBAR SCROLL EFFECT =============
    const navbar = document.querySelector('.navbar');
    
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
    
    // ============= ACTIVE NAV LINK =============
    function setActiveNavLink() {
        const currentPage = window.location.pathname.split('/').pop() || 'index.php';
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
            link.removeAttribute('aria-current');
            
            if (currentPage === '' || currentPage === 'index.php' || currentPage === '/') {
                if (link.getAttribute('href') === 'index.php' || link.getAttribute('href') === './') {
                    link.classList.add('active');
                    link.setAttribute('aria-current', 'page');
                }
            } else if (link.getAttribute('href') === currentPage) {
                link.classList.add('active');
                link.setAttribute('aria-current', 'page');
            }
        });
    }
    
    setActiveNavLink();
    
    // ============= ANIMATIONS ON SCROLL =============
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(el);
    });
    
    const serviceCards = document.querySelectorAll('#services-preview .card');
    serviceCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // ============= ACCESSIBILITY IMPROVEMENTS =============
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });
    
    document.addEventListener('mousedown', () => {
        document.body.classList.remove('keyboard-navigation');
    });
    
    function checkContrast() {
        const textElements = document.querySelectorAll('p, span, li, a:not(.btn, .cta-nav)');
        textElements.forEach(el => {
            const color = window.getComputedStyle(el).color;
            const bgColor = window.getComputedStyle(el.parentElement).backgroundColor;
            if (color.includes('rgb(234, 223, 207)') && bgColor.includes('rgb(11, 16, 32)')) {
                el.style.color = 'var(--light)';
            }
        });
    }
    
    checkContrast();
    
    // ============= PERFORMANCE OPTIMIZATIONS =============
    document.querySelectorAll('img[data-src]').forEach(img => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    img.src = img.getAttribute('data-src');
                    observer.unobserve(img);
                }
            });
        });
        observer.observe(img);
    });
    
    if ('connection' in navigator && navigator.connection.saveData === false) {
        const pages = ['services.php', 'realisations.php', 'contact.php'];
        pages.forEach(page => {
            const link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = page;
            document.head.appendChild(link);
        });
    }
    
    // ============= SMOOTH SCROLLING FOR ANCHORS =============
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                e.preventDefault();
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});

// ============= SERVICE WORKER (OPTIONNEL) =============
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(error => {
            console.log('Service Worker registration failed:', error);
        });
    });
}

// ============= ANALYTICS (OPTIONNEL) =============
// À intégrer avec votre outil d'analytics préféré