// Attend que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    var scrollToTopBtn = document.getElementById('scrollToTop');

    // Affiche ou masque la flèche en fonction du défilement
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            scrollToTopBtn.style.display = 'block';
        } else {
            scrollToTopBtn.style.display = 'none';
        }
    });

    // Fait défiler la page en haut lorsque la flèche est cliquée
    scrollToTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const aboutLink = document.querySelector('.scroll-down a');
    const aboutSection = document.getElementById('about2');

    aboutLink.addEventListener('click', function(event) {
        event.preventDefault();
        const sectionOffset = aboutSection.offsetTop;
        window.scrollTo({
            top: sectionOffset,
            behavior: 'smooth'
        });
    });
});


