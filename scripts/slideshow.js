document.addEventListener('DOMContentLoaded', function () {
    var slidesContainer = document.querySelector('.slides');
    var slides = document.querySelectorAll('.slide');
    var totalSlides = slides.length;
    var currentIndex = 0;
    var timer; // Ajoutez une variable pour stocker le timer

    function showNextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateSlideVisibility();
        resetTimer(); // Réinitialisez le timer à chaque interaction de l'utilisateur
    }

    function showPreviousSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        updateSlideVisibility();
        resetTimer();
    }

    function updateSlideVisibility() {
        slidesContainer.style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
    }

    function resetTimer() {
        clearTimeout(timer); // Effacez le timer existant
        timer = setTimeout(showNextSlide, 5000); // Définissez un nouveau timer pour changer la diapositive après 5 secondes
    }

    document.querySelector('.arrow_left').addEventListener('click', function () {
        showPreviousSlide();
        resetTimer();
    });

    document.querySelector('.arrow_right').addEventListener('click', function () {
        showNextSlide();
        resetTimer();
    });

    // Démarrez le timer initial
    resetTimer();
});
