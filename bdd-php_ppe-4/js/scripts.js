// notif test
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// test valider
document.addEventListener('DOMContentLoaded', function() {
    showNotification('Bienvenue sur notre librairie en ligne!', 'success');

    // effet de survol sur les images de la navbar
    const navLinks = document.querySelectorAll('#navbar a');
    navLinks.forEach(link => {
        link.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.3s ease';
        });
        link.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.connexion-container input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#007bff';
        });
        input.addEventListener('blur', function() {
            this.style.borderColor = '#ccc';
        });
    });
});

// js acceuil 
// Sélection des éléments
const burger = document.querySelector('.burger');
const navLinks = document.querySelector('.nav-links');

// Gestion du clic sur le burger
burger.addEventListener('click', () => {
    // Activation/désactivation du menu
    navLinks.classList.toggle('nav-active');

    // Animation du burger
    burger.classList.toggle('toggle');
});

// Fermer le menu lorsqu'un lien est cliqué 
navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
        navLinks.classList.remove('nav-active');
        burger.classList.remove('toggle');
    });
});